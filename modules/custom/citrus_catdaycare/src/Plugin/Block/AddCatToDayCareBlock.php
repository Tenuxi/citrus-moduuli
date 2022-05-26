<?php

namespace Drupal\citrus_catdaycare\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Render\Element\Form;

/**
 * Provides a 'AddCatToDayCareBlock' block.
 *
 * @Block(
 *  id = "add_cat_to_day_care_block",
 *  admin_label = @Translation("Add cat to day care block"),
 * )
 */
class AddCatToDayCareBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'add_cat_to_day_care_block';
    $build['add_cat_to_day_care_block'] = [];

    $build['add_cat_to_day_care_block'] = \Drupal::formBuilder()->getForm('Drupal\citrus_catdaycare\Form\AddCatToDaycareForm');
    $build['#cache'] = [];
    return $build;
  }

}
