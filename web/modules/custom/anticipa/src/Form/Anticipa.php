<?php

namespace Drupal\anticipa\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class Anticipa extends FormBase{
  /**
   * {@inheritdoc }
   */
  public function getFormId(){
    return 'anticipa_form';
  }
  /**
   * {@inheritdoc }
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name']=[
      '#type' => 'textfield',
      '#title' => $this->t('Usuario'),
    ];

    $form['submit']=[
      '#type' => 'submit',
      '#value' => $this->t('Enviar'),
    ];

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

      $username = $form_state->getValue('name');

      $connection = \Drupal::database();
      $query = $connection->query("SELECT name FROM {users_field_data} WHERE name ='".$username."'");
      $result = $query->fetchAll();

      if($result) {
         $this->messenger()->addStatus($this->t('El usuario existe'));
       }
       else {
         $this->messenger()->addStatus($this->t('El usuario no existe'));

       }

      }

}
