<?php

function form_training_file_form($form, &$form_state) {

  $form['file'] = array(
    '#type' => 'file',
    '#title' => 'Upload the document here'
  );

  $form['language'] = array(
    '#type' => 'select',
    '#title' => 'Select a language',
    '#options' => as_options_array(get_other_choice_value(), get_available_languages()),
    '#required' => TRUE,
  );

  $form['level'] = array(
    '#type' => 'select',
    '#title' => 'Select a level',
    '#options' => as_options_array(get_other_choice_value(), get_available_levels()),
    '#required' => TRUE,
  );

  $form['audience'] = array(
    '#type' => 'select',
    '#title' => 'Select a audience',
    '#options' => as_options_array(get_other_choice_value(), get_available_audiences()),
    '#required' => TRUE,
  );

  $form['category'] = array(
    '#type' => 'select',
    '#title' => 'Select a category',
    '#options' => as_options_array(get_other_choice_value(), get_possible_categories()),
    '#required' => TRUE,
  );

  $form['title'] = array(
    '#type' => 'textfield',
    '#title' => 'Title of the document',
    '#size' => 30,
    '#maxlength' => 30,
    '#required' => TRUE,
  );


  $form['description'] = array(
    '#type' => 'textarea',
    '#title' => 'Description of the document',
    '#size' => 300,
    '#maxlength' => 300,
    '#required' => TRUE,
  );

  $form['submit_button'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );

  return $form;
}

function form_training_file_form_submit($form, &$form_state) {

  $validators = array(
    'file_validate_size' => array('2048'),
    'file_validate_extensions' => array('pdf doc docx ppt pptx txt')
  );

  $location = "public://";

  $upload_check = file_save_upload('file', $validators, $location);

  if ($upload_check) {
    $link = file_create_url($upload_check -> uri);
    $language = get_form_value($form_state, "language");
    $level = get_form_value($form_state, "level");
    $audience = get_form_value($form_state, "audience");
    $category = get_form_value($form_state, "category");
    $title = get_form_value($form_state, "title");
    $url = get_form_value($form_state, "url");
    $description = get_form_value($form_state, "description");

    db_insert('training_material')
      ->fields(array(
        'title' => $title,
        'description' => $description,
        'language' => $language,
        'level' => $level,
        'audience' => $audience,
        'content_type' => get_link_value(),
        'category' => $category
      ))->execute();

    db_insert('training_uploads')
      ->fields(array(
        'title' => $title,
        'url' => $link
      ))->execute();
    drupal_set_message("Thank you for the upload!");
  } else {
    drupal_set_message("Sadly the upload failed");
  }


}


function form_training_link_form($form, &$form_state) {

  $form['language'] = array(
    '#type' => 'select',
    '#title' => 'Select a language',
    '#options' => as_options_array(get_other_choice_value(), get_available_languages()),
    '#required' => TRUE,
  );

  $form['level'] = array(
    '#type' => 'select',
    '#title' => 'Select a level',
    '#options' => as_options_array(get_other_choice_value(), get_available_levels()),
    '#required' => TRUE,
  );

  $form['audience'] = array(
    '#type' => 'select',
    '#title' => 'Select a audience',
    '#options' => as_options_array(get_other_choice_value(), get_available_audiences()),
    '#required' => TRUE,
  );

  $form['category'] = array(
    '#type' => 'select',
    '#title' => 'Select a category',
    '#options' => as_options_array(get_other_choice_value(), get_possible_categories()),
    '#required' => TRUE,
  );

  $form['title'] = array(
    '#type' => 'textfield',
    '#title' => 'Title of the link',
    '#size' => 30,
    '#maxlength' => 30,
    '#required' => TRUE,
  );

  $form['url'] = array(
    '#type' => 'textfield',
    '#title' => 'Link url',
    '#size' => 30,
    '#maxlength' => 50,
    '#required' => TRUE,
  );

  $form['description'] = array(
    '#type' => 'textarea',
    '#title' => 'Description of the link',
    '#size' => 300,
    '#maxlength' => 300,
    '#required' => TRUE,
  );

  $form['submit_button'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );

  return $form;
}

function form_training_link_form_submit($form, &$form_state) {

  $language = get_form_value($form_state, "language");
  $level = get_form_value($form_state, "level");
  $audience = get_form_value($form_state, "audience");
  $category = get_form_value($form_state, "category");
  $title = get_form_value($form_state, "title");
  $url = get_form_value($form_state, "url");
  $description = get_form_value($form_state, "description");

  db_insert('training_material')
    ->fields(array(
      'title' => $title,
      'description' => $description,
      'language' => $language,
      'level' => $level,
      'audience' => $audience,
      'content_type' => get_link_value(),
      'category' => $category
    ))->execute();

  db_insert('training_links')
    ->fields(array(
      'title' => $title,
      'url' => $url
    ))->execute();

}
