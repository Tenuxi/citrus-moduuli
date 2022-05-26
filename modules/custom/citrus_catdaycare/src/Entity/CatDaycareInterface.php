<?php

namespace Drupal\citrus_catdaycare\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Cat daycare entities.
 *
 * @ingroup citrus_catdaycare
 */
interface CatDaycareInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Cat daycare name.
   *
   * @return string
   *   Name of the Cat daycare.
   */
  public function getName();

  /**
   * Sets the Cat daycare name.
   *
   * @param string $name
   *   The Cat daycare name.
   *
   * @return \Drupal\citrus_catdaycare\Entity\CatDaycareInterface
   *   The called Cat daycare entity.
   */
  public function setName($name);

  /**
   * Gets the Cat daycare creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Cat daycare.
   */
  public function getCreatedTime();

  /**
   * Sets the Cat daycare creation timestamp.
   *
   * @param int $timestamp
   *   The Cat daycare creation timestamp.
   *
   * @return \Drupal\citrus_catdaycare\Entity\CatDaycareInterface
   *   The called Cat daycare entity.
   */
  public function setCreatedTime($timestamp);

}
