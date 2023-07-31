<?php

namespace Drupal\dxpr_builder\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\block_content\Entity\BlockContent as BlockContentEntity;

/**
 * Description.
 */
class BlockContent extends BlockContentEntity {

  /**
   * Add an empty string to any field that would otherwise be completely empty.
   *
   * Without this code, the frontend editor has nothing to attach to.
   *
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::presave($storage);

    \Drupal::service('dxpr_builder.service')->setEmptyStringToDxprFieldsOnEntity($this);
  }

}
