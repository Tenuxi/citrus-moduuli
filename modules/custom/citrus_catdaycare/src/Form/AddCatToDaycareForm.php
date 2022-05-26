<?php

namespace Drupal\citrus_catdaycare\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AddCatToDaycareForm.
 */
class AddCatToDaycareForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'add_cat_to_daycare_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = array(
      'cat' => array(
        '#type' => 'select',
        '#label' => 'Cats name',
        '#options' => $this->getOwnCats()
      ),
      'daycare' => array(
        '#type' => 'select',
        '#label' => 'Select day care',
        '#options' => $this->getDaycares()
      ),
      'date' => array(
        '#type' => 'date',
        '#label' => 'Date'
      )
    );
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $storage = \Drupal::entityTypeManager()->getStorage('cat_daycare');
    // Display result.
    $entity = $storage->create([
      'name' => sprintf('Cat %s in daycare %s at date %s', $form_state->getValue('cat'), $form_state->getValue('daycare'), $form_state->getValue('date')),
      'cat' => $form_state->getValue('cat'),
      'daycare' => $form_state->getValue('daycare'),
      'date' => $form_state->getValue('date')
    ]);
    $entity->save();
    \Drupal::messenger()->addMessage('Cat sent to daycare');
  }

  public function getOwnCats() {
    $user_id = \Drupal::currentUser()->id();

    // Show admin every cat.
    if ($user_id = 1) {
      $query = \Drupal::database()->query('select * from cat;');
    }
    else {
      $query = \Drupal::database()->query('select * from cat where user_id=' . \Drupal::currentUser()->id() . ';');
    }
    $array = array();
    foreach ($query->fetchAll() as $result) {
      $array[$result->id] = $result->name;
    }
    return $array;
  }

  public function getDaycares() {
    $array = array();
    $query = \Drupal::database()->query('select * from daycare;');
    $result = $query->execute();
    foreach ($query->fetchAll() as $result) {
      $array[$result->id] = $result->name;
    }
    return $array;
  }
}
