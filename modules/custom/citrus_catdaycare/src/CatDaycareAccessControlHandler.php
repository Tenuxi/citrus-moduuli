<?php

namespace Drupal\citrus_catdaycare;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Cat daycare entity.
 *
 * @see \Drupal\citrus_catdaycare\Entity\CatDaycare.
 */
class CatDaycareAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\citrus_catdaycare\Entity\CatDaycareInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished cat daycare entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published cat daycare entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit cat daycare entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete cat daycare entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add cat daycare entities');
  }


}
