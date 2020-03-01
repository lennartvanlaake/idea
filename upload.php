<?php

function form_training_link_form($form, &$form_state) {

  $form['language'] = array(
    '#type' => 'select',
    '#title' => 'Select a language',
    '#options' => as_options_array(get_available_languages()),
    '#required' => TRUE,
  );

  $form['level'] = array(
    '#type' => 'select',
    '#title' => 'Select a level',
    '#options' => as_options_array(get_available_levels()),
    '#required' => TRUE,
  );

  $form['audience'] = array(
    '#type' => 'select',
    '#title' => 'Select a audience',
    '#options' => as_options_array(get_available_audiences()),
    '#required' => TRUE,
  );

  $form['category'] = array(
    '#type' => 'select',
    '#title' => 'Select a category',
    '#options' => as_options_array(get_possible_categories()),
    '#required' => TRUE,
  );

  $form['link_type'] = array(
    '#type' => 'select',
    '#title' => 'Select the type of link this is',
    '#options' => as_options_array(get_possible_link_types()),
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
  $link_type = get_form_value($form_state, "link_type");
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
      'link_type' => $link_type,
      'url' => $url
    ))->execute();

}
