<?php


function idea_search_form($form, &$form_state) {

  $form['query'] = array(
    '#type' => 'textfield',
    '#title' => 'Search description and title',
    '#size' => 30,
    '#maxlength' => 30,
    '#required' => FALSE,
  );

  $form['language'] = array(
    '#type' => 'select',
    '#title' => 'Select a language',
    '#options' => as_options_array(get_available_languages()),
    '#required' => FALSE,
  );

  $form['level'] = array(
    '#type' => 'select',
    '#title' => 'Select a level',
    '#options' => as_options_array(get_available_levels()),
    '#required' => FALSE,
  );

  $form['audience'] = array(
    '#type' => 'select',
    '#title' => 'Select a audience',
    '#options' => as_options_array(get_available_audiences()),
    '#required' => FALSE,
  );

  $form['category'] = array(
    '#type' => 'select',
    '#title' => 'Select a category',
    '#options' => as_options_array(get_possible_categories()),
    '#required' => FALSE,
  );

  $form['result'] = array(
    '#markup' =>  get_query_result($form_state),
  );

  $form['submit_button'] = array(
    '#type' => 'submit',
    '#value' => t('Search'),
  );


  return $form;
}

function idea_search_form_submit($form, &$form_state) {
  $form_state['rebuild'] = TRUE;
}


function idea_search_form_validate($form, &$form_state) {
}


function get_query_result($form_state) {

  $content = "";
  $query = get_form_value($form_state, "query");
  if (is_null($query)) {
    return $content;
  }
  $content .= "<br><h1>Results</h1><hr>";
  $content .= "<p>". get_form_value($form_state, "query") ."</p>";
  return $content;

}
