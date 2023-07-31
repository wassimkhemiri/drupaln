<?php

namespace Drupal\image_sizes;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Image\ImageFactory;
use Drupal\Core\Template\Attribute;
use Drupal\file\Entity\File;
use Drupal\file\FileInterface;
use Drupal\image\Entity\ImageStyle;
use Drupal\image\Plugin\Field\FieldType\ImageItem;
use Drupal\image_sizes\Entity\ImageSizesPresetEntity;

/**
 * Service for sizing images.
 *
 * @package Drupal\image_sizes
 */
class ImageSizesService {

  /**
   * Image factory.
   *
   * @var \Drupal\Core\Image\ImageFactory
   */
  protected $imageFactory;

  /**
   * Filesystem service.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  protected $fileSystem;

  /**
   * Entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\File\FileSystemInterface $file_system
   *   Service for file system.
   * @param \Drupal\Core\Image\ImageFactory $image_factory
   *   Image factory.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   Entity type manager.
   */
  public function __construct(
    FileSystemInterface $file_system,
    ImageFactory $image_factory,
    EntityTypeManagerInterface $entity_type_manager
  ) {
    $this->fileSystem = $file_system;
    $this->imageFactory = $image_factory;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * Write attributes to image.
   *
   * @param \Drupal\image_sizes\Entity\ImageSizesPresetEntity $preset
   *   Preset to use.
   * @param \Drupal\file\FileInterface $file
   *   File to proccess.
   * @param bool $inline
   *   Should this thumb written as base64 string.
   */
  public function getAttributes(ImageSizesPresetEntity $preset, FileInterface $file, bool $inline = FALSE) {
    $preloadStyle = ImageStyle::load($preset->getPreloadStyle());
    $uri = $this->getFileUri($file);
    $styles = $this->getStyles($uri, $preset);
    $attributes = [
      'data-src' => Json::encode($styles),
      'class' => [
        'image-sizes',
        'pre-load',
      ],
      'data-src-fallback' => $this->getFallBackStyle($uri, $preset),
    ];

    if ($inline === TRUE && $preloadStyle) {
      $attrs = $this->createBase64Attributes($preloadStyle, $file);
      $attributes = array_merge($attributes, $attrs);
      $attributes = new Attribute($attributes);
      return $attributes;
    }

    $attributes['src'] = $this->getPreloadStyle($uri, $preset);
    return $attributes;
  }

  /**
   * Create base64 string for attributes.
   *
   * @param \Drupal\image\Entity\ImageStyle $image_style
   *   Image style to use.
   * @param \Drupal\file\FileInterface $image
   *   Image to process.
   */
  public function createBase64Attributes(ImageStyle $image_style, FileInterface $image): array {
    $attributes = [];
    $image_uri = $image->getFileUri();
    $image_type = $image->getMimeType();
    $derivative_uri = $image_style->buildUri($image_uri);
    if (!file_exists($derivative_uri)) {
      $image_style->createDerivative($image_uri, $derivative_uri);
    }
    $absolute_path = $this->fileSystem->realpath($derivative_uri);
    if ($absolute_path) {
      $image_file = file_get_contents($absolute_path);
      $base_64_image = base64_encode($image_file);
      $image_media = $this->imageFactory->get($absolute_path);
      if ($image_media->isValid()) {
        $attributes['width'] = $image_media->getWidth();
        $attributes['height'] = $image_media->getHeight();
      }
      $attributes['src'] = "data:$image_type;base64,$base_64_image";
    }
    return $attributes;
  }

  /**
   * Get fallback style.
   *
   * @param string $uri
   *   File uri.
   * @param \Drupal\image_sizes\Entity\ImageSizesPresetEntity $preset
   *   ImageSizesPreset entity.
   *
   * @return string
   *   Get url for fallback style.
   */
  protected static function getFallBackStyle($uri, ImageSizesPresetEntity $preset) {
    if ($preset->getFallbackStyle() == 'original') {
      return \Drupal::service('file_url_generator')->generateAbsoluteString($uri);
    }

    $style = ImageStyle::load($preset->getFallbackStyle());
    if (!$style) {
      return \Drupal::service('file_url_generator')->generateAbsoluteString($uri);
    }

    return $style->buildUrl($uri);
  }

  /**
   * Get fallback style.
   *
   * @param string $uri
   *   File uri.
   * @param \Drupal\image_sizes\Entity\ImageSizesPresetEntity $preset
   *   ImageSizesPreset entity.
   *
   * @return string
   *   Get url for fallback style.
   */
  protected static function getPreloadStyle($uri, ImageSizesPresetEntity $preset) {
    $style = ImageStyle::load($preset->getPreloadStyle());
    if (!$style) {
      return \Drupal::service('file_url_generator')->generateAbsoluteString($uri);
    }

    return $style->buildUrl($uri);
  }

  /**
   * Get file uri.
   *
   * @param mixed $item
   *   File item.
   *
   * @return string
   *   File uri.
   */
  public static function getFileUri($item) {
    if ($item instanceof File) {
      return $item->getFileUri();
    }
    if ($item instanceof ImageItem) {
      if ($item->isEmpty()) {
        return FALSE;
      };
      return $item->entity->getFileUri();
    }
    $field = $item->getSource()
      ->getSourceFieldDefinition($item->bundle->entity);
    if ($item->get($field->getName())->isEmpty()) {
      return FALSE;
    }
    return $item->get($field->getName())->first()->entity->getFileUri();
  }

  /**
   * Get all styles for a preset.
   *
   * @param string $uri
   *   File uri.
   * @param \Drupal\image_sizes\Entity\ImageSizesPresetEntity $preset
   *   ImageSizesPreset entity.
   *
   * @return array
   *   Array of styles.
   */
  protected static function getStyles($uri, ImageSizesPresetEntity $preset): array {
    $image_styles = ImageStyle::loadMultiple($preset->getStyles());
    $styles = [];
    foreach ($image_styles as $style) {
      $effects = $style->getEffects();
      foreach ($effects as $effect) {
        if (is_a($effect, 'Drupal\image\Plugin\ImageEffect\ResizeImageEffect')) {
          $width = $effect->getConfiguration()['data']['width'];
          if ($width !== NULL && $width > 0) {
            $styles[$width] = $style->buildUrl($uri);
          }
        }
      }
    }
    ksort($styles);
    return $styles;
  }

}
