<?php

namespace Drupal\image_styles_drush\Commands;

use Consolidation\AnnotatedCommand\CommandError;
use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\image_styles_drush\Service\ImageService;
use Drupal\image\ImageEffectManager;
use Drupal\image\ImageStyleInterface;
use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class ImageCommands extends DrushCommands {

  /**
   * The image effect manager.
   *
   * @var \Drupal\image\ImageEffectManager
   */
  protected $effectManager;

  /**
   * The image style entity storage handler.
   *
   * @var \Drupal\image\ImageStyleStorageInterface
   */
  protected $imageStyleStorage;

  /**
   * The custom image service.
   *
   * @var \Drupal\image_styles_drush\Service\ImageService
   */
  protected $customImageService;

  /**
   * ImageCommands constructor.
   *
   * @param \Drupal\image\ImageEffectManager $effect_manager
   *   The image effect manager.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\image_styles_drush\Service\ImageService $custom_image_service
   *   The custom image service.
   */
  public function __construct(ImageEffectManager $effect_manager, EntityTypeManagerInterface $entity_type_manager, ImageService $custom_image_service) {
    parent::__construct();
    $this->effectManager = $effect_manager;
    $this->imageStyleStorage = $entity_type_manager->getStorage('image_style');
    $this->customImageService = $custom_image_service;
  }

  /**
   * Displays an image styles list.
   *
   * @usage drush isl
   *   - Displays an image styles list.
   *
   * @command image-styles:list
   * @aliases isl
   */
  public function imageStylesList() {
    $image_styles = $this->imageStyleStorage->loadMultiple();
    if (!empty($image_styles)) {
      $rows = [];
      foreach ($image_styles as $image_style) {
        $rows[] = [
          'id' => $image_style->id(),
          'label' => $image_style->label(),
        ];
      }
      return new RowsOfFields($rows);
    }
    else {
      $this->logger()->success(dt('No image styles.'));
    }
  }

  /**
   * Displays an image effects list.
   *
   * @usage drush ise
   *   - Displays an image effects list.
   *
   * @command image-styles:effects
   * @aliases ise
   */
  public function imageEffectsList() {
    $definitions = $this->effectManager->getDefinitions();
    if (!empty($definitions)) {
      $rows = [];
      foreach ($definitions as $image_effect) {
        $rows[] = [
          'id' => $image_effect['id'],
          'label' => $image_effect['label'],
        ];
      }
      return new RowsOfFields($rows);
    }
    else {
      $this->logger()->success(dt('No image effects.'));
    }
  }

  /**
   * Displays an image effect parameters list.
   *
   * @param string $image_effect_id
   *   Image effect plugin id.
   * @param array $options
   *   An associative array of options whose values come from cli,
   *   aliases, config, etc.
   *
   * @option pretty
   *   Pretty-print JSON.
   *
   * @usage drush isp image_effect_id --pretty
   *   - Displays an image effect parameters list (in JSON format).
   *
   * @command image-styles:params
   * @aliases isp
   */
  public function displayImageEffectParams(string $image_effect_id, array $options = [
    'pretty' => FALSE,
  ]) {
    if ($this->effectManager->hasDefinition($image_effect_id)) {
      $params = $this->customImageService->getImageEffectParams($image_effect_id, $options['pretty']);
      if (!empty($params)) {
        $this->logger()->success(dt($params));
      }
      else {
        $this->logger()->success(dt("The image effect doesn't have params."));
      }
    }
    else {
      $this->logger()->success(dt('The image effect ID is wrong.'));
    }
  }

  /**
   * Creates an image style.
   *
   * @param string $label
   *   Image style label.
   * @param string $machine_name
   *   Image style machine name (id). Generated from the label if it is omitted.
   *
   * @usage drush isc "Some label" [machine_name]
   *   - Creates an image style.
   *
   * @command image-styles:create "Some label" machine_name
   * @aliases isc
   */
  public function createImageStyle(string $label, string $machine_name = '') {
    $machine_name_pattern = '@[^a-z0-9_.]+@';
    if (!empty($machine_name)) {
      $machine_name = preg_replace($machine_name_pattern, '_', strtolower($machine_name));
    }
    if (empty($machine_name)) {
      $machine_name = preg_replace($machine_name_pattern, '_', strtolower($label));
    }
    $data = [
      'id' => $machine_name,
      'name' => $machine_name,
      'label' => $label,
    ];
    if ($image_style = $this->imageStyleStorage->create($data)) {
      $image_style->save();
      $this->logger()
        ->success(dt('Created a new image style with id !id', ['!id' => $image_style->id()]));
    }
    else {
      return new CommandError("Could not create a new image style with the id " . $machine_name . ".");
    }
  }

  /**
   * Deletes the image style.
   *
   * @param string $machine_name
   *   Image style machine name (id).
   *
   * @usage drush isd machine_name
   *   - Deletes the image style.
   *
   * @command image-styles:delete some_name
   * @aliases isd
   */
  public function deleteImageStyle(string $machine_name) {
    $image_style = $this->imageStyleStorage->load($machine_name);
    if ($image_style instanceof ImageStyleInterface) {
      $image_style->flush();
      $image_style->delete();
      $this->logger()
        ->success(dt('The image style with id !id was deleted', ['!id' => $image_style->id()]));
    }
    else {
      return new CommandError("The image style doesn't exist.");
    }
  }

  /**
   * Adds the image effect to the image style.
   *
   * @param string $image_style_id
   *   Image style machine name (id).
   * @param string $image_effect_id
   *   Image effect machine name (plugin id).
   * @param array $options
   *   An associative array of options whose values come from cli,
   *   aliases, config, etc.
   *
   * @option weight
   *   Weight of the image effect.
   * @option params
   *   Parameters in JSON format (see "drush isp" for the structure).
   *
   * @usage drush isae image_style_id image_effect_id --weight=6 --params='JSON
   *   string'
   *   - Adds the image effect to the image style.
   *
   * @command image-styles:add-effect image_style_id image_effect_id
   * @aliases isae
   */
  public function addImageEffect(string $image_style_id, string $image_effect_id, array $options = [
    'weight' => '',
    'params' => '',
  ]) {
    if (!$this->effectManager->hasDefinition($image_effect_id)) {
      return new CommandError("The image effect doesn't exist.");
    }
    $image_style = $this->imageStyleStorage->load($image_style_id);
    if ($image_style instanceof ImageStyleInterface) {
      $default_config = $this->customImageService->getImageEffectConfig($image_effect_id);
      $configuration = [];
      if (!empty($default_config)) {
        if (!empty($options['params'])) {
          $configuration = json_decode($options['params'], TRUE);
        }
        else {
          $this->io()->text(dt('Enter params of the image effect:'));
          foreach ($default_config as $param_name => $default_value) {
            if (empty($default_value)) {
              $configuration[$param_name] = $this->io()
                ->askRequired(dt($param_name));
            }
            else {
              if (is_array($default_value)) {
                foreach ($default_value as $subparam_name => $subdefault_value) {
                  if (empty($subdefault_value)) {
                    $configuration[$param_name][$subparam_name] = $this->io()
                      ->askRequired(dt($subparam_name));
                  }
                  else {
                    $configuration[$param_name][$subparam_name] = $this->io()
                      ->ask(dt($subparam_name), $subdefault_value);
                  }
                }
              }
              else {
                $configuration[$param_name] = $this->io()
                  ->ask(dt($param_name), $default_value);
              }
            }
          }
        }
      }
      $configuration['data'] = $configuration;
      $configuration['weight'] = $options['weight'];
      $configuration['id'] = $image_effect_id;
      $image_style->flush();
      $image_style->addImageEffect($configuration);
      $image_style->save();
      $this->logger()->success(dt('The image effect !effect was added to !id',
        [
          '!effect' => $image_effect_id,
          '!id' => $image_style->id(),
        ]));
    }
    else {
      return new CommandError("The image style doesn't exist.");
    }
  }

  /**
   * Deletes the image effect from the image style.
   *
   * @param string $image_style_id
   *   Image style machine name (id).
   * @param int $effect_index
   *   Effect index.
   *
   * @usage drush isde image_style_id [effect_index]
   *   - Deletes an image effect from the image style.
   *
   * @command image-styles:delete-effect image_style_id [effect_index]
   * @aliases isde
   */
  public function deleteImageEffect(string $image_style_id, int $effect_index = -1) {
    $image_style = $this->imageStyleStorage->load($image_style_id);
    if ($image_style instanceof ImageStyleInterface) {
      $effects = $image_style->getEffects();
      if ($effects->count() == 0) {
        $this->logger()
          ->success(dt('The image style !id has no effects', ['!id' => $image_style->id()]));
        return;
      }
      $configurations = $effects->getConfiguration();
      if ($effect_index >= 0) {
        $keys = array_keys($configurations);
        $image_effect_id = $keys[$effect_index];
      }
      else {
        // Show choice list.
        foreach ($configurations as $key => $config) {
          $choices[$key] = 'uuid:' . $config['uuid'] . '; ' . 'plugin_id: ' . $config['id'] . '; ' . 'weight: ' . $config['weight'];
        }
        $image_effect_id = $this->io()
          ->choice(dt('Choose an image effect'), $choices);
      }
      $image_style->deleteImageEffect($effects->get($image_effect_id));
      $image_style->flush();
      $image_style->save();
      $this->logger()
        ->success(dt('The image effect !effect was deleted from !id',
          [
            '!effect' => $image_effect_id,
            '!id' => $image_style->id(),
          ]));
    }
    else {
      return new CommandError("The image style doesn't exist.");
    }
  }

}
