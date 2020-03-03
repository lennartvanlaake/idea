<?php

function insert_trainer_form($form, &$form_state){
  $form['name'] = array(
    '#type' => 'textfield',
    '#title' => t('trainer name'),
    '#size' => 32,
    '#maxlength' => 32,
    '#required' => TRUE,
    '#description' => t('please enter the name of the trainer'),
  );


  $form['age'] = array(
    '#type' => 'textfield',
    '#title' => t('trainer age'),
    '#size' => 3,
    '#maxlength' => 3,
    '#required' => TRUE,
    '#description' => t('please enter the age of the trainer'),
  );
  $form['country'] = array(
    '#type' => 'textfield',
    '#title' => t('trainer country'),
    '#size' => 30,
    '#maxlength' => 30,
    '#required' => TRUE,
    '#description' => t('please enter the country of the trainer'),
  );
  $form['city'] = array(
    '#type' => 'textfield',
    '#title' => t('trainer city'),
    '#size' => 32,
    '#maxlength' => 32,
    '#required' => TRUE,
    '#description' => t('please enter the city of the trainer'),
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('add trainer.'),
  );

  return $form;
}

function insert_trainer_form_submit($form, &$form_state) {

  $name = get_form_value($form_state, "name");
  $age = get_form_value($form_state, "age");
  $country = get_form_value($form_state, "country");
  $city = get_form_value($form_state, "city");


  db_insert('trainer')
    ->fields(array(
      'trainer_id' => $GLOBALS['user']->uid,
      'name' => $name,
      'age' => $age,
      'country' => $country,
      'city' => $city,
    ))->execute();
  drupal_set_message("Trainer added");
}