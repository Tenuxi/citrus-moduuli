<?php

/**
 * @file
 * Contains cat.page.inc.
 *
 * Page callback for Cat entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Cat templates.
 *
 * Default template: cat.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_cat(array &$variables) {
  // Fetch Cat Entity Object.
  $cat = $variables['elements']['#cat'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
