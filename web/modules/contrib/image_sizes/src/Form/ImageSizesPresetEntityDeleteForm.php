<?php

namespace Drupal\image_sizes\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityConfirmFormBase;

/**
 * Builds the form to delete Image sizes preset entity entities.
 */
class ImageSizesPresetEntityDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %name?', ['%name' => $this->entity->label()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.image_sizes_preset_entity.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();

    $this->messenger()->addStatus(
      $this->t('content @type: deleted @label.',
        [
          '@type' => $this->entity->bundle(),
          '@label' => $this->entity->label(),
        ]
      )
    );
    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}
