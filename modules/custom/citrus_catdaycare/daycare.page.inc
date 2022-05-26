<?php

/**
 * @file
 * Contains daycare.page.inc.
 *
 * Page callback for Daycare entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Daycare templates.
 *
 * Default template: daycare.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_daycare(array &$variables) {
  // Fetch Daycare Entity Object.
  $daycare = $variables['elements']['#daycare'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
