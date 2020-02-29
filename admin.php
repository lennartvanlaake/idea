<?php

function form_config_form($form, &$form_state) {

  $form['delete_language'] = array(
    '#type' => 'select',
    '#title' => 'Delete language',
    '#options' => get_available_languages(),
    '#required' => FALSE,
  );

  $form['new_language'] = array(
    '#type' => 'textfield',
    '#title' => 'New language',
    '#size' => 10,
    '#maxlength' => 10,
    '#required' => FALSE,
  );

  $form['delete_level'] = array(
    '#type' => 'radios',
    '#title' => 'Delete level',
    '#options' => get_available_levels(),
    '#required' => FALSE,
  );

  $form['new_level'] = array(
    '#type' => 'textfield',
    '#title' => 'New level',
    '#size' => 20,
    '#maxlength' => 20,
    '#required' => FALSE,
  );

  $form['delete_audience'] = array(
    '#type' => 'radios',
    '#title' => 'Delete audience',
    '#options' => get_available_audiences(),
    '#required' => FALSE,
  );

  $form['new_audience'] = array(
    '#type' => 'textfield',
    '#title' => 'New audience',
    '#size' => 20,
    '#maxlength' => 20,
    '#required' => FALSE,
  );

  $form['submit_button'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );

  return $form;
}

function form_config_form_submit($form, &$form_state) {

  $language_to_delete = get_form_value($form_state, "delete_language");
  if (!is_null($language_to_delete)) {
    db_delete('languages')
      -> condition("language",  $language_to_delete)
      -> execute();
  }

  $language_to_insert = get_form_value($form_state, "new_language");
  if (!is_null($language_to_insert)) {
    db_insert('languages')
    ->fields(array(
      'language' => $form_state['values']['new_language']
    ))->execute();
  }

  $audience_to_insert = get_form_value($form_state, "new_audience");
  if (!is_null($audience_to_insert)) {
    db_insert('audiences')
      ->fields(array(
        'audience' => get_form_value($form_state, "new_audience")
      ))->execute();
  }

  $level_to_insert = get_form_value($form_state, "new_level");
  if (!is_null($level_to_insert)) {
    db_insert('levels')
      ->fields(array(
        'level' => get_form_value($form_state, "new_level")
      ))->execute();
  }

}


