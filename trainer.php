<?php

function trainers_homepage() {
  return t("<p>This is the trainerdb homepage<p>");
}

function trainer_search_form($form, &$form_state) {

  $choice_type = "select";

  $form['query'] = array(
    '#type' => 'textfield',
    '#title' => 'Search bio, name and experience',
    '#size' => 30,
    '#maxlength' => 30,
    '#required' => FALSE,
  );

  $form['country'] = array(
    '#type' => $choice_type,
    '#title' => 'Select a country',
    '#options' => as_options_array(get_any_choice_value(), get_available_countries()),
    '#required' => FALSE,
  );

  $form['result'] = array(
    '#markup' =>  get_trainer_query_result($form_state),
  );

  $form['submit_button'] = array(
    '#type' => 'submit',
    '#value' => t('Search'),
  );


  return $form;
}

function trainer_search_form_submit($form, &$form_state) {
  $form_state['rebuild'] = TRUE;
}


function trainer_search_form_validate($form, &$form_state) {
}


function get_trainer_query_result($form_state) {

  if (!array_key_exists("values", $form_state)) {
    return "";
  }
  $content = "<br><h1>Results</h1>";
   $links = get_all_trainers();
   $filtered_links = apply_all_trainer_filters($links, $form_state);
   $content .= generate_trainer_result_html($filtered_links);
  return $content;

}

function apply_all_trainer_filters($results, $form_state) {
  $filter_1 = apply_trainer_filter($results, $form_state, "country");
  return apply_trainer_query($filter_1, $form_state);
}

function apply_trainer_query($results, $form_state) {
  $query_value = get_form_value($form_state, "query");
  if (is_null($query_value)) {
    return $results;
  }
  $filtered_results = array();
  foreach ($results as $result) {
    $bio = $result -> bio;
    $name = $result -> name;
    $experience = $result -> experience;
    if (contains_substring($bio, $query_value) || contains_substring($name, $query_value) || contains_substring($experience, $query_value)) {
      $filtered_results[] = $result;
    }
  }
  return $filtered_results;
}

function apply_trainer_filter($results, $form_state, $property) {
  $filter_value = get_form_value($form_state, $property);
  if (is_null($filter_value) || $filter_value == get_any_choice_value()) {
    return $results;
  }
  $filtered_results = array();
  foreach ($results as &$entry) {
    if (strcasecmp($entry -> $property, $filter_value) == 0) {
      $filtered_results[] = $entry;
    }
  }
  return $filtered_results;
}

function generate_trainer_result_html($trainer_results) {
  $output = "";
  foreach ($trainer_results as $trainer) {
    $output .= "<h2> " . $trainer -> name . "</h2>";
    $output .= "<ul>";
    $output .= "<li> location: " . $trainer -> city . ", " . $trainer -> country . "</li>";
    $output .= "<li> bio: " . $trainer -> bio . "</li>";
    $output .= "</ul></br>";

  }
  return $output;
}
