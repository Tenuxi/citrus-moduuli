<?php

namespace Drupal\citrus_catdaycare\Plugin\Block;

use Drupal;
use Drupal\citrus_catdaycare\Entity\CatInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'OwnKittensBlock' block.
 *
 * @Block(
 *  id = "own_kittens_block",
 *  admin_label = @Translation("Own kittens block"),
 * )
 */
class OwnKittensBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Entity\EntityTypeManagerInterface definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Drupal\Core\Logger\LoggerChannelFactoryInterface definition.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $loggerFactory;

  /**
   * Drupal\Core\Session\AccountProxyInterface definition.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->loggerFactory = $container->get('logger.factory');
    $instance->currentUser = $container->get('current_user');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['own_kittens_block'] = $this->getOwnKittens();
    $build['#cache'] = [
      'max-age' => 0
    ];

    return $build;
  }

  /**
   * @return array|\Drupal\citrus_catdaycare\Plugin\Block\a
   */
  protected function getOwnKittens() {
    $render = [];
    $entity_typeManager = Drupal::service('entity_type.manager');
    $storage = $entity_typeManager->getStorage('cat');
    $daycare_storage = $entity_typeManager->getStorage('daycare');
    $kittens = $storage->loadByProperties(['user_id' => $this->currentUser->id()]);

    // Koodia vähän rivitetty uudelleen koska oli todella vaikea lukuista.

    if (!empty($kittens)) {

      foreach ($kittens as $kitten) {

        // DIV JA CLASS kaiken ympärille

        if ($kitten instanceof CatInterface) {

          $render[$kitten->id()] = [
            'cat' => array(
              '#prefix' => '<div class=cat>',
              '#suffix' => '</div>',
              '#markup' => $kitten->label(),
            ),
          ];

          $kittendaycares = $this->getKittenDaycare($kitten);

          if (isset($kittendaycares)) {
          
            if (is_array($kittendaycares)) {
          
              foreach ($kittendaycares as $kittendaycare) {
          
                if ($kittendaycare instanceof Drupal\citrus_catdaycare\Entity\CatDaycareInterface) {
          
                  $daycare = $kittendaycare->daycare;

                  // Tälle muuttujalle voisi tehdä jotain? (Tarvitseeko käyttää $kittendaycare muuttujaa montaa kertaa)
                  if (!empty($kittendaycare->daycare)) {
                    $daycare = $daycare_storage->load($kittendaycare->daycare->getValue()[0]['target_id']);
                  }
          
                  if (!empty($kittendaycare->cat)) {
                    $cat = $storage->load($kittendaycare->cat->getValue()[0]['target_id']);
                  }
          
                  if (!empty($kittendaycare->date)) {
                    $date = $kittendaycare->date->getValue();
                  }
                }
          
                if (!empty($daycare) && !empty($cat) && !empty($date)) {

                  //Lisätty Div ja Class
                  $render[$kitten->id()]['daycares'][] = [
                    '#type' => 'item',
                    '#markup' => sprintf('<div class="daycare"> %s from date %s </div>', $daycare->label(), $date[0]['value'])
                  ];
                  
                }
          
                else {
                  continue;
                }
              }
            }
          }
        }
      }
      return $render;
    }
  }

  /**
   * Get kittens daycare status.
   *
   * @param \Drupal\citrus_catdaycare\Entity\CatInterface $kitten
   *
   * @return \Drupal\Core\Entity\EntityInterface[]
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function getKittenDaycare(CatInterface $kitten) {
    $entity_typeManager = \Drupal::entityTypeManager();
    $daycare_storage = $entity_typeManager->getStorage('cat_daycare');
    $result = $daycare_storage->getQuery()
      ->condition('cat', $kitten->id())
      ->execute();
    return $daycare_storage->loadMultiple($result);
  }
}
