<?php

/**
* @file
* A form to collect an email address for RSVP details.
*/

namespace Drupal\rsvplist\Form;

use Drupal\Core\Form\FormBase;
use  Drupal\Core\Form\FormStateInterface;

class RSVPForm extends FormBase {

  /**
   * {@inheritDoc}
   */
  public function getFormId():string {
    return 'rsvplist_email_form';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state):array {

    // SERVICIO QUE TRAE LOS PARÁMETROS DEL NODO
    $node = \Drupal::routeMatch()->getParameter('node');

    // COMPRUEBA SI EXISTE EL NODO Y LE ASGINA LOS VALORES CORRESPONDIENTES
    if (!(is_null($node))) {
      $nid = $node->id();
    }
    else {
      $nid = 0;
    }
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => t('Email address'),
      '#size' => 25,
      '#description' => t("We will send updates to the email adress you provide."),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('RSVP'),
    ];
    $form['nid'] = [
      '#type' => 'hidden',
      '#value' => $nid,
    ];
    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function  validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $value = $form_state->getValue('email');
    if (!(\Drupal::service('email.validator')-> isValid($value))) {
      $form_state->setErrorByName('email',
      $this->t('It appears that %mail is not a valid email. Please try again',
      ['%mail' => $value]));
    }
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $submitted_email = $form_state->getValue('email');
    $this->messenger()->addMessage(t("The form is working! You entered @entry.", ['@entry'=> $submitted_email]));
  }

}

