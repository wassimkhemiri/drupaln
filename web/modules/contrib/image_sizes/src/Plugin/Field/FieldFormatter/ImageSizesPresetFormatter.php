<?php

namespace Drupal\image_sizes\Plugin\Field\FieldFormatter;

use Drupal\file\FileInterface;
use Drupal\image_sizes\ImageSizesFormatterTrait;
use Drupal\image_sizes\Entity\ImageSizesPresetEntity;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FieldItemInterface;

/**
 * Plugin implementation of the 'image_sizes_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "image_sizes_preset_formatter",
 *   label = @Translation("Image sizes presets"),
 *   field_types = {
 *     "image",
 *     "entity_reference"
 *   }
 * )
 */
class ImageSizesPresetFormatter extends FormatterBase {

  use ImageSizesFormatterTrait;

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
      'preset' => FALSE,
      'load_invisible' => FALSE,
    ] + parent::defaultSettings();
  }

  /**
   * Helper function forloading preset.
   */
  private function getPreset() {
    return \Drupal::entityTypeManager()
      ->getStorage('image_sizes_preset_entity')
      ->load($this->getSetting('preset'));
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
      'load_invisible' => [
        '#type' => 'checkbox',
        '#default_value' => $this->getSetting('load_invisible'),
        '#title' => $this->t('Load this image even is not visible'),
      ],
      'preset' => [
        '#type' => 'select',
        '#required' => TRUE,
        '#title' => $this->t('Placeholder image style.'),
        '#options' => $this->getOptions(),
        '#default_value' => $this->getSetting('preset'),
      ],
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.
    $preset = $this->getPreset();
    if ($preset) {
      $summary['#markup'] = $preset->label();
    }

    return $summary;
  }

  /**
   * Get all options for select a style.
   */
  protected function getOptions() {
    $presets = \Drupal::entityQuery('image_sizes_preset_entity')
      ->execute();
    $options = [];
    foreach ($presets as $preset) {
      if ($preset = ImageSizesPresetEntity::load($preset)) {
        $options[$preset->id()] = $preset->label();
      }
    }
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies() {
    $dependencies = parent::calculateDependencies();
    $preset = $this->getPreset();

    if ($preset) {
      $dependencies[$preset->getConfigDependencyKey()][] = $preset->getConfigDependencyName();
    }

    return $dependencies;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {
    $uri = $this->getFileUri($item);
    $entity = ($item->entity instanceof FileInterface) ? $item->entity : \Drupal::service('file.repository')->loadByUri($uri);
    if (!$uri) {
      return [];
    }

    $allowed_properties = ['alt', 'title'];

    $attributes = $this->getAttributes($item);

    $attributes = array_filter($attributes,
      function ($key) use ($allowed_properties, $attributes) {
        return in_array($key, $allowed_properties) && !empty($attributes[$key]);
      }, ARRAY_FILTER_USE_KEY
    );

    if ($this->getSetting('load_invisible')) {
      $attributes['class'] = ['load-always'];
    }

    $preset = $this->getPreset();
    $render = [
      '#theme' => 'image_sizes',
      '#style' => $preset,
      '#entity' => $entity,
      '#attributes' => $attributes,
      '#lazy' => FALSE,
    ];

    return $render;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = $this->viewValue($item);
    }
    return $elements;
  }

}
