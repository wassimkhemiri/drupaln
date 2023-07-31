<?php

namespace Drupal\image_sizes\Entity;

use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Image sizes preset entity entity.
 *
 * @ConfigEntityType(
 *   id = "image_sizes_preset_entity",
 *   label = @Translation("Image sizes preset"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\image_sizes\ImageSizesPresetEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\image_sizes\Form\ImageSizesPresetEntityForm",
 *       "edit" = "Drupal\image_sizes\Form\ImageSizesPresetEntityForm",
 *       "delete" = "Drupal\image_sizes\Form\ImageSizesPresetEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\image_sizes\ImageSizesPresetEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "image_sizes_preset_entity",
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *     "fallback",
 *     "styles",
 *     "preload"
 *   },
 *   admin_permission = "administer image sizes",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/media/image_sizes_preset_entity/{image_sizes_preset_entity}",
 *     "add-form" = "/admin/config/media/image_sizes_preset_entity/add",
 *     "edit-form" = "/admin/config/media/image_sizes_preset_entity/{image_sizes_preset_entity}/edit",
 *     "delete-form" = "/admin/config/media/image_sizes_preset_entity/{image_sizes_preset_entity}/delete",
 *     "collection" = "/admin/config/media/image_sizes_preset_entity"
 *   }
 * )
 */
class ImageSizesPresetEntity extends ConfigEntityBase implements ImageSizesPresetEntityInterface {

  /**
   * The Image sizes preset entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Image sizes preset entity label.
   *
   * @var string
   */
  protected $label;

  /**
   * The Image fallback style.
   *
   * @var string[]
   */
  protected $fallback;

  /**
   * The Image styles.
   *
   * @var string[]
   */
  protected $styles = [];

  /**
   * The Image preload styles.
   *
   * @var string[]
   */
  protected $preload;

  /**
   * Setter fallback style.
   *
   * @param string $fallback
   *   Fallback style name.
   */
  public function setFallbackStyle($fallback) {
    $this->fallback = $fallback;
  }

  /**
   * Get fallback style.
   *
   * @return string
   *   Fallback style name.
   */
  public function getFallbackStyle() {
    return $this->fallback;
  }

  /**
   * Setter preload style.
   *
   * @param string $preload
   *   Preload style name.
   */
  public function setPreloadStyle($preload) {
    $this->preload = $preload;
  }

  /**
   * Get preload style.
   *
   * @return string
   *   Preload style name.
   */
  public function getPreloadStyle() {
    return $this->preload;
  }

  /**
   * Set styles.
   *
   * @param string[] $styles
   *   Fallback style name.
   */
  public function setStyles(array $styles) {
    $this->styles = $styles;
  }

  /**
   * Get styles.
   *
   * @return string[]
   *   All styles.
   */
  public function getStyles() {
    return $this->styles;
  }

  /**
   * Add a new style.
   *
   * @param string $style
   *   Style name to add.
   */
  public function addStyle($style) {
    if (!in_array($style, $this->styles)) {
      $this->styles[$style] = $style;
    }
  }

  /**
   * Remove a style.
   *
   * @param string $style
   *   Style name to remove.
   */
  public function removeStyle($style) {
    if (in_array($style, $this->styles)) {
      unset($this->styles[array_search($style, $this->styles)]);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies() {
    parent::calculateDependencies();
    $styles = $this->styles;
    if ($this->fallback) {
      $styles[] = $this->fallback;
    }
    if ($this->preload) {
      $styles[] = $this->preload;
    }

    parent::calculateDependencies();

    $styles = ImageStyle::loadMultiple($styles);
    array_walk($styles, function ($style) {
      $this->addDependency('config', $style->getConfigDependencyName());
    });
    return $this;
  }

}
