<?php

namespace Drupal\webform_test\Plugin\WebformHandler;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\WebformHandlerBase;
use Drupal\webform\WebformInterface;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Webform submission test handler.
 *
 * @WebformHandler(
 *   id = "test",
 *   label = @Translation("Test"),
 *   category = @Translation("Testing"),
 *   description = @Translation("Tests webform submission handler behaviors."),
 *   cardinality = \Drupal\webform\WebformHandlerInterface::CARDINALITY_SINGLE,
 *   results = \Drupal\webform\WebformHandlerInterface::RESULTS_IGNORED,
 * )
 */
class TestWebformHandler extends WebformHandlerBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'message' => 'One two one two this is just a test',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Message'),
      '#default_value' => $this->configuration['message'],
      '#required' => TRUE,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['message'] = $form_state->getValue('message');
  }

  /**
   * {@inheritdoc}
   */
  public function alterElements(array &$elements, WebformInterface $webform) {
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function alterForm(array &$form, FormStateInterface $form_state, WebformSubmissionInterface $webform_submission) {
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state, WebformSubmissionInterface $webform_submission) {
    $this->displayMessage(__FUNCTION__);
    if ($value = $form_state->getValue('element')) {
      $form_state->setErrorByName('element', $this->t('The element must be empty. You entered %value.', ['%value' => $value]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state, WebformSubmissionInterface $webform_submission) {
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function confirmForm(array &$form, FormStateInterface $form_state, WebformSubmissionInterface $webform_submission) {
    drupal_set_message($this->configuration['message'], 'status', TRUE);
    \Drupal::logger('webform.test')->notice($this->configuration['message']);
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function preCreate(array $values) {
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function postCreate(WebformSubmissionInterface $webform_submission) {
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function postLoad(WebformSubmissionInterface $webform_submission) {
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function preDelete(WebformSubmissionInterface $webform_submission) {
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function postDelete(WebformSubmissionInterface $webform_submission) {
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function preSave(WebformSubmissionInterface $webform_submission) {
    $this->displayMessage(__FUNCTION__);
  }

  /**
   * {@inheritdoc}
   */
  public function postSave(WebformSubmissionInterface $webform_submission, $update = TRUE) {
    $this->displayMessage(__FUNCTION__, $update ? 'update' : 'insert');
  }

  /**
   * Display the invoked plugin method to end user.
   *
   * @param string $method_name
   *   The invoked method name.
   * @param string $context1
   *   Additional parameter passed to the invoked method name.
   */
  protected function displayMessage($method_name, $context1 = NULL) {
    if (PHP_SAPI != 'cli') {
      $t_args = ['@class_name' => get_class($this), '@method_name' => $method_name, '@context1' => $context1];
      drupal_set_message($this->t('Invoked: @class_name:@method_name @context1', $t_args), 'status', TRUE);
      \Drupal::logger('webform.test')->notice('Invoked: @class_name:@method_name @context1', $t_args);
    }
  }

}
