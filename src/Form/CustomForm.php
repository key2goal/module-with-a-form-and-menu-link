<?php

/** 
 * @file
 * Contains \Drupal\menu_link_with_form\Form\CustomForm
 */
namespace Drupal\menu_link_with_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
      return 'custom_form';
    }

     /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['user_name'] = array(
        '#type' => 'textfield',
        '#title' => t('User Name:'),
        '#required' => TRUE,
        );
        $form['user_mail'] = array(
        '#type' => 'email',
        '#title' => t('Email ID:'),
        '#required' => TRUE,
        );
        $form['phone_number'] = array (
        '#type' => 'tel',
        '#title' => t('Phone no'),
        '#description' => t('phone number not less then 10 digits'),
        );
        $form['user_dob'] = array (
        '#type' => 'date',
        '#title' => t('DOB'),
        '#required' => TRUE,
        );
        $form['user_gender'] = array (
        '#type' => 'select',
        '#title' => ('Gender'),
        '#options' => array(
            'Female' => t('Female'),
            'male' => t('Male'),
            'other' => t('Other'),
        ),
        );
        $form['user_info'] = array (
        '#type' => 'radios',
        '#title' => ('Are you developer?'),
        '#options' => array(
            'Yes' =>t('Yes'),
            'No' =>t('No')
        ),
        );
        $form['terms'] = array(
        '#type' => 'checkbox',
        '#title' => t('I accept terms and conditions.'),
        '#required' => TRUE,
        );
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
        '#type' => 'submit',
        '#value' => $this->t('Save'),
        '#button_type' => 'primary',
        );
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {

        if (strlen($form_state->getValue('phone_number')) < 10) {
            $form_state->setErrorByName('phone_number', $this->t('Phone number should not less then 10 digits.'));
        }

        if(!is_numeric($form_state->getValue('phone_number'))){
            $form_state->setErrorByName('phone_number', $this->t('I think your are out the universe, your Phone number should be numeric in this world.'));
        }

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        // get single value by $form_state->getValue('candidate_name');
        foreach ($form_state->getValues() as $key => $value) {
        drupal_set_message($key . ': ' . $value);
        }
    }
}