<?php

namespace Drupal\citrus_catdaycare;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Cat entities.
 *
 * @ingroup citrus_catdaycare
 */
class CatListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Cat ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\citrus_catdaycare\Entity\Cat $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.cat.edit_form',
      ['cat' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
