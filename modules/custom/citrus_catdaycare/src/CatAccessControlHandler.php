<?php

namespace Drupal\citrus_catdaycare;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Cat entity.
 *
 * @see \Drupal\citrus_catdaycare\Entity\Cat.
 */
class CatAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\citrus_catdaycare\Entity\CatInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished cat entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published cat entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit cat entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete cat entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add cat entities');
  }


}
