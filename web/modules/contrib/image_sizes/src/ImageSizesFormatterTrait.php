<?php

namespace Drupal\image_sizes;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldDefinitionInterface;

/**
 * Formatter trait.
 */
trait ImageSizesFormatterTrait {

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(FieldDefinitionInterface $field_definition) {
    if ($field_definition->getType() == 'entity_reference') {
      if ($field_definition->getSetting('target_type') == 'media') {
        return TRUE;
      }
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public static function getFileUri(FieldItemInterface $item) {
    if ($item->getFieldDefinition()->getType() == 'image') {
      if ($item->isEmpty()) {
        return FALSE;
      };
      return $item->entity->getFileUri();
    }
    if ($item->isEmpty() || !$item->entity) {
      return FALSE;
    }
    $field = $item->entity->getSource()
      ->getSourceFieldDefinition($item->entity->bundle->entity);
    if ($item->entity->get($field->getName())->isEmpty()) {
      return FALSE;
    }
    if ($field->getType() != 'image') {
      return $item->entity->get('thumbnail')->first()->entity->getFileUri();
    }
    return $item->entity->get($field->getName())->first()->entity->getFileUri();
  }

}
