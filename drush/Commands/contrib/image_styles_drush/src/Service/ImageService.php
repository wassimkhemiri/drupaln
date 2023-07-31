<?php

namespace Drupal\image_styles_drush\Service;

use Drupal\image\ImageEffectManager;

/**
 * Provides additional functionality.
 */
class ImageService {

  /**
   * The image effect manager.
   *
   * @var \Drupal\image\ImageEffectManager
   */
  protected $effectManager;

  /**
   * ImageService constructor.
   *
   * @param \Drupal\image\ImageEffectManager $effect_manager
   *   The image effect manager.
   */
  public function __construct(ImageEffectManager $effect_manager) {
    $this->effectManager = $effect_manager;
  }

  /**
   * Gets image effect parameters.
   *
   * @param string $image_effect_id
   *   Image effect plugin id.
   * @param bool $pretty
   *   Pretty-print JSON.
   *
   * @return array
   *   Array with the parameters
   */
  public function getImageEffectParams(string $image_effect_id, bool $pretty) {
    $params = [];
    $config = $this->getImageEffectConfig($image_effect_id);

    if (!empty($config)) {
      if ($pretty) {
        $params = json_encode($config, JSON_PRETTY_PRINT);
      }
      else {
        $params = json_encode($config);
      }
    }

    return $params;
  }

  /**
   * Gets image effect default configuration.
   *
   * @param string $image_effect_id
   *   Image effect plugin id.
   *
   * @return array
   *   Default configuration array
   */
  public function getImageEffectConfig(string $image_effect_id) {
    $config = [];

    if ($this->effectManager->hasDefinition($image_effect_id)) {
      $instance = $this->effectManager->createInstance($image_effect_id);
      $config = $instance->defaultConfiguration();
    }

    return $config;
  }

}
