<?php

namespace Drupal\citrus_catdaycare;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Daycare entity.
 *
 * @see \Drupal\citrus_catdaycare\Entity\Daycare.
 */
class DaycareAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\citrus_catdaycare\Entity\DaycareInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished daycare entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published daycare entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit daycare entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete daycare entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add daycare entities');
  }


}
