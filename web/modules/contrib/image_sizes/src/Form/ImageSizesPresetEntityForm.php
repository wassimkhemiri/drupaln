<?php

namespace Drupal\image_sizes\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\image\Entity\ImageStyle;

/**
 * Class ImageSizesPresetEntityForm provide Form for Entity.
 */
class ImageSizesPresetEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    /** @var \Drupal\image_sizes\Entity\ImageSizesPresetEntity */
    $image_sizes_preset_entity = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $image_sizes_preset_entity->label(),
      '#description' => $this->t("Label for the Image sizes preset entity."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $image_sizes_preset_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\image_sizes\Entity\ImageSizesPresetEntity::load',
      ],
      '#disabled' => !$image_sizes_preset_entity->isNew(),
    ];

    $form['preload'] = [
      '#type' => 'select',
      '#default_value' => $image_sizes_preset_entity->getPreloadStyle(),
      '#options' => image_style_options(FALSE),
      '#title' => $this->t('Preload style'),
      '#required' => TRUE,
    ];

    $form['styles'] = [
      '#type' => 'checkboxes',
      '#multiple' => TRUE,
      '#default_value' => $image_sizes_preset_entity->getStyles(),
      '#options' => $this->getOptions(),
      '#title' => $this->t('Styles'),
      '#required' => TRUE,
    ];

    $form['fallback'] = [
      '#type' => 'select',
      '#default_value' => $image_sizes_preset_entity->getFallbackStyle(),
      '#options' => array_merge(
        ['original' => $this->t('Original')],
        image_style_options(FALSE),
      ),
      '#title' => $this->t('Fallback style'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * Get all options for select a style.
   */
  protected function getOptions() {
    $image_styles = \Drupal::entityQuery('image_style')
      ->execute();
    $styles = [];
    foreach ($image_styles as $style_name) {
      $style = ImageStyle::load($style_name);
      $effects = $style->getEffects();
      foreach ($effects as $effect) {
        if (is_a($effect, 'Drupal\image\Plugin\ImageEffect\ResizeImageEffect')) {
          $width = $effect->getConfiguration()['data']['width'];
          if ($width !== NULL && $width > 0) {
            $link = \Drupal::linkGenerator()->generate(t('More'), Url::fromRoute(
              'entity.image_style.edit_form',
              ['image_style' => $style_name]
            ))->__toString();

            $styles[$style_name] = $style->label() . " - " . $link;
          }
        }
      }
    }
    return $styles;
  }

  /**
   * {@inheritdoc}
   */
  protected function copyFormValuesToEntity(EntityInterface $entity, array $form, FormStateInterface $form_state) {
    /** @var \Drupal\image_sizes\Entity\ImageSizesPresetEntity $entity */
    parent::copyFormValuesToEntity($entity, $form, $form_state);
    $styles = array_filter($entity->getStyles(), function ($v) {
      return $v !== 0;
    });
    $styles = array_keys($styles);
    $entity->setStyles($styles);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $image_sizes_preset_entity = $this->entity;
    $status = $image_sizes_preset_entity->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('Created the %label Image sizes preset entity.', [
          '%label' => $image_sizes_preset_entity->label(),
        ]));
        break;

      default:
        $this->messenger()->addStatus($this->t('Saved the %label Image sizes preset entity.', [
          '%label' => $image_sizes_preset_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($image_sizes_preset_entity->toUrl('collection'));
  }

}
