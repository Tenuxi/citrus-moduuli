<?php

namespace Drupal\citrus_catdaycare\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Cat daycare entities.
 */
class CatDaycareViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
