<?php
/**
 * @file
 * Contains \Drupal\just_test\Form\AjaxDemoForm.
 */
namespace Drupal\multi_step_registration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

class RegistrationStep extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'demo_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['customer_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Customer Name:'),
    );
    $form['customer_dob'] = array(
      '#type' => 'date',
      '#title' => t('Custome DOB:'),
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {

    }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $uid = \Drupal::request()->query->get('user');
    $user = \Drupal\user\Entity\User::load($uid);
    // Set the field value new value.
    $user->set('field_first_name', $form_state->getValue('customer_name'));
    $user->save();
    drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
  }
}