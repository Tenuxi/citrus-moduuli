<?php

namespace Drupal\citrus_catdaycare;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Daycare entities.
 *
 * @ingroup citrus_catdaycare
 */
class DaycareListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Daycare ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\citrus_catdaycare\Entity\Daycare $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.daycare.edit_form',
      ['daycare' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
