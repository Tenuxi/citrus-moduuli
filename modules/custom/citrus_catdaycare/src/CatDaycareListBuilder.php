<?php

namespace Drupal\citrus_catdaycare;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Cat daycare entities.
 *
 * @ingroup citrus_catdaycare
 */
class CatDaycareListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Cat daycare ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\citrus_catdaycare\Entity\CatDaycare $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.cat_daycare.edit_form',
      ['cat_daycare' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
