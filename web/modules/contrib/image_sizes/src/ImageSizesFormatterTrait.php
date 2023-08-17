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
   * Helper function for get image field from media.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   Media item for extract field.
   *
   * @return \Drupal\Core\Field\FieldItemInterface|bool
   *   Return field if exists.
   */
  protected static function getFieldItemFromMedia(FieldItemInterface $item) {
    $field = $item->entity->getSource()
      ->getSourceFieldDefinition($item->entity->bundle->entity);
    if ($item->entity->get($field->getName())->isEmpty()) {
      return FALSE;
    }
    return $item->entity->get($field->getName());
  }

  /**
   * Helper function get get attributes.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   Fielditem to check.
   *
   * @return array
   *   Attributes for render.
   */
  protected static function getAttributes(FieldItemInterface $item) {
    if ($item->getFieldDefinition()->getType() == 'image') {
      if ($item->isEmpty()) {
        return [];
      };
      /** @var \Drupal\image\Plugin\Field\FieldType\ImageItem */
      return $item->getValue();
    }
    $field = static::getFieldItemFromMedia($item);
    return $item->entity->get($field->getName())->first()->getValue();
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
    $field = static::getFieldItemFromMedia($item);
    if (!$field) {
      return FALSE;
    }
    return $item->entity->get($field->getName())->first()->entity->getFileUri();
  }

}
