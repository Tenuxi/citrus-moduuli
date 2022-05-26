<?php

namespace Drupal\citrus_catdaycare\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Daycare entities.
 *
 * @ingroup citrus_catdaycare
 */
interface DaycareInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Daycare name.
   *
   * @return string
   *   Name of the Daycare.
   */
  public function getName();

  /**
   * Sets the Daycare name.
   *
   * @param string $name
   *   The Daycare name.
   *
   * @return \Drupal\citrus_catdaycare\Entity\DaycareInterface
   *   The called Daycare entity.
   */
  public function setName($name);

  /**
   * Gets the Daycare creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Daycare.
   */
  public function getCreatedTime();

  /**
   * Sets the Daycare creation timestamp.
   *
   * @param int $timestamp
   *   The Daycare creation timestamp.
   *
   * @return \Drupal\citrus_catdaycare\Entity\DaycareInterface
   *   The called Daycare entity.
   */
  public function setCreatedTime($timestamp);

}
