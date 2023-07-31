<?php

namespace Drupal\image_sizes\Commands;

use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\image_sizes\Entity\ImageSizesPresetEntity;
use Symfony\Component\Console\Output\OutputInterface;
use Drush\Commands\DrushCommands;

/**
 * Drush command for helping generate styls.
 */
class GenerateImageSizeCommand extends DrushCommands {

  /**
   * Ratio for image style.
   *
   * @var string
   */
  protected $ratio = FALSE;

  /**
   * Drush options.
   *
   * @var array
   */
  protected $options = [];

  /**
   * Use focal point.
   *
   * @var bool
   */
  protected $useFocalPoint = FALSE;

  /**
   * Entity type manager service.
   *
   * @var Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Module handler service.
   *
   * @var Drupal\Core\Extension\ModuleHandle
   */
  protected $moduleHandler;

  /**
   * DeleteCommand constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   Entity type manager.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   Module Handler.
   */
  public function __construct(
    EntityTypeManagerInterface $entityTypeManager,
    ModuleHandlerInterface $module_handler
  ) {
    $this->entityTypeManager = $entityTypeManager;
    $this->moduleHandler = $module_handler;
    parent::__construct();
  }

  /**
   * Generate image sizes presets.
   *
   * @param string $name
   *   Name.
   * @param string $min
   *   Min width.
   * @param string $max
   *   Max width.
   * @param string $steps
   *   Steps for each image style.
   * @param array $options
   *   Options for command.
   *
   * @command image-sizes:generate
   *
   * @aliases isg
   *
   * @option ratio
   *   Add a ratio with format WIDTHxHEIGHT.
   *
   * @option use-focal-point
   *   Use focal point scale and crop. Only works with ratio.
   *
   * @option format
   *   Convert image to given format.
   *
   * @option generate-thumbnail
   *   Only works if image effects module is enabled. Add a blurred thumbnail.
   *
   * @usage image-sizes:generate 4x3 50 1600 50 --ratio=4x3
   * @usage image-sizes:generate 4x3 50 1600 50 --ratio=4x3 --generate-thumbnail
   */
  public function generate($name, $min, $max, $steps, array $options = [
    'ratio' => NULL,
    'use-focal-point' => FALSE,
    'format' => 'webp',
    'generate-thumbnail' => FALSE,
  ]) {
    if ($options['use-focal-point'] && !$this->moduleHandler->moduleExists('focal_point')) {
      $this->io()->error('focal_point module is missing.');
      return;
    }
    $this->options = [
      'name' => $name,
      'min' => $min,
      'max' => $max,
      'steps' => $steps,
      'options' => $options,
    ];
    $this->execute($this->output());
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(OutputInterface $output) {
    $ratio = $this->options['options']['ratio'];
    $name = $this->options['name'];
    $min = $this->options['min'];
    $max = $this->options['max'];
    $steps = $this->options['steps'];
    $useFocalPoint = $this->options['options']['use-focal-point'];
    $ratios = ['x' => 0, 'y' => 0];
    $preloadStyle = $this->options['options']['generate-thumbnail'];
    $format = $this->options['options']['format'];
    if ($format && !in_array($format, ['gif', 'jpeg', 'jpg', 'webp'])) {
      $this->io()->error('No style');
      return;
    }
    $smallesStyle = FALSE;
    $ratios = FALSE;

    $style = ImageStyle::load($name);
    if ($style) {
      $output->writeln('Already exists');
      return;
    }
    if ($ratio != NULL) {
      $reg = '/^(\d+)x(\d+)$/';
      $matches = [];
      preg_match_all($reg, $ratio, $matches, PREG_SET_ORDER, 0);
      if (empty($matches)) {
        $output->writeln('Not correct ratio');
        return;
      }
      $ratios = ['x' => $matches[0][1], 'y' => $matches[0][2]];
    }

    $preset = ImageSizesPresetEntity::create([
      'label' => "$name",
      'id' => self::machineName($name),
    ]);

    $effects = [];
    $styles = [];

    for ($i = $max; $i >= ($min) || $i >= 15; $i = $i - $steps) {
      $effects = [];
      $style_name = $name . '_' . $i;
      $x = $i;

      $label = "$name $x";

      $style = ImageStyle::create([
        'name' => $style_name,
        'label' => $label,
      ]);
      $configuration = [
        'uuid' => NULL,
        'id' => 'image_scale',
        'data' => [
          'width' => $x,
        ],
      ];
      if ($ratios !== FALSE) {
        $m = floor($i / $ratios['x']);
        $x = $ratios['x'] * $m;
        $y = $ratios['y'] * $m;
        $label = "${name} (${x}x${y})";
        $style = ImageStyle::create([
          'name' => $style_name,
          'label' => $label,
        ]);
        $configuration = [
          'uuid' => NULL,
          'id' => ($useFocalPoint) ? 'focal_point_scale_and_crop' : 'image_scale_and_crop',
          'data' => [
            'width' => $x,
            'height' => $y,
          ],
        ];
      }

      $effects[] = \Drupal::service('plugin.manager.image.effect')->createInstance($configuration['id'], $configuration);
      if ($format) {
        $effects[] = \Drupal::service('plugin.manager.image.effect')->createInstance('image_convert', [
          'data' => [
            'extension' => $format,
          ],
        ]);
      }
      array_walk($effects, function ($effect) use ($style) {
        $style->addImageEffect($effect->getConfiguration());
      });
      $style->save();
      $styles[] = $style;
      $output->writeln("Generate Style ${style_name}");
    }
    array_walk($styles, function ($style) use ($preset) {
      $preset->addStyle($style->id());
    });
    if ($preloadStyle) {
      $thumb = $this->generateThumbnail($ratios);
      $preset->setPreloadStyle($thumb->id());
    }
    else {
      $style = array_pop($styles);
      $preset->setPreloadStyle($style->id());
    }
    $preset->setFallbackStyle('original');
    $preset->save();
  }

  /**
   * Helper for generate machinable names.
   *
   * @param string $value
   *   Name to convert.
   *
   * @return string
   *   Return machinable name.
   */
  public static function machineName($value) {
    $new_value = \Drupal::service('transliteration')->transliterate($value, LanguageInterface::LANGCODE_DEFAULT, '_');
    $new_value = strtolower($new_value);
    $new_value = preg_replace('/[^a-z0-9_]+/', '_', $new_value);
    return preg_replace('/_+/', '_', $new_value);
  }

  /**
   * Generate thumbnail.
   *
   * @param array|bool $ratios
   *   Ratios.
   */
  public function generateThumbnail(array|bool $ratios): ImageStyle {
    $useFocalPoint = $this->options['options']['use-focal-point'];
    $format = $this->options['options']['format'];
    $name = $this->options['name'];
    $x = 15;
    $style = ImageStyle::create([
      'name' => $name . '_preload',
      'label' => "$name Preload",
    ]);
    if ($ratios !== FALSE) {
      $m = floor($x / $ratios['x']);
      $x = $ratios['x'] * $m;
      $y = $ratios['y'] * $m;
      $configuration = [
        'uuid' => NULL,
        'id' => ($useFocalPoint) ? 'focal_point_scale_and_crop' : 'image_scale_and_crop',
        'data' => [
          'width' => $x,
          'height' => $y,
        ],
      ];
    }
    else {
      $configuration = [
        'uuid' => NULL,
        'id' => 'image_scale',
        'data' => [
          'width' => $x,
        ],
      ];
    }
    $effects = [];
    $effects[] = \Drupal::service('plugin.manager.image.effect')->createInstance($configuration['id'], $configuration);
    if ($this->moduleHandler->moduleExists('image_effects')) {
      $this->io()->writeln('Add blur effect');
      $effects[] = \Drupal::service('plugin.manager.image.effect')->createInstance('image_effects_gaussian_blur', [
        'uuid' => NULL,
        'id' => 'image_effects_gaussian_blur',
        'date' => [
          'radius' => 5,
          'sigma' => 2,
        ],
      ]);
    }
    if ($format) {
      $effects[] = \Drupal::service('plugin.manager.image.effect')->createInstance('image_convert', [
        'data' => [
          'extension' => $format,
        ],
      ]);
    }
    array_walk($effects, function ($effect) use ($style) {
      $this->io()->writeln('Add ' . $effect->getPluginId());
      $style->addImageEffect($effect->getConfiguration());
    });
    $style->save();
    return $style;
  }

}
