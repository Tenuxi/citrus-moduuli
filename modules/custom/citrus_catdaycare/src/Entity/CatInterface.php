<?php

namespace Drupal\citrus_catdaycare\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Cat entities.
 *
 * @ingroup citrus_catdaycare
 */
interface CatInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Cat name.
   *
   * @return string
   *   Name of the Cat.
   */
  public function getName();

  /**
   * Sets the Cat name.
   *
   * @param string $name
   *   The Cat name.
   *
   * @return \Drupal\citrus_catdaycare\Entity\CatInterface
   *   The called Cat entity.
   */
  public function setName($name);

  /**
   * Gets the Cat creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Cat.
   */
  public function getCreatedTime();

  /**
   * Sets the Cat creation timestamp.
   *
   * @param int $timestamp
   *   The Cat creation timestamp.
   *
   * @return \Drupal\citrus_catdaycare\Entity\CatInterface
   *   The called Cat entity.
   */
  public function setCreatedTime($timestamp);

}
