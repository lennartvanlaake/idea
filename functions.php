<?php

function get_available_languages() {

  $results = db_query("SELECT * from {languages}");
  $languages = array(get_any_choice_value());
  foreach ($results as $result) {
    array_push($languages, $result -> language);
  }
  return $languages;

}

function get_available_levels() {

  $results = db_query("SELECT * from {levels}");
  $output = array(get_any_choice_value());
  foreach ($results as $result) {
    array_push($output, $result -> level);
  }
  return $output;

}

function get_available_audiences() {

  $results = db_query("SELECT * from {audiences}");
  $output = array(get_any_choice_value());
  foreach ($results as $result) {
    array_push($output, $result -> audience);
  }
  return $output;

}

function get_possible_categories() {
  return array(get_any_choice_value(), "Training", "Debate", "Pedagogy");
}

function get_possible_link_types() {
  return array(get_any_choice_value(), "Video", "Other");
}

function get_possible_content_types() {
  return array(get_any_choice_value(), get_link_value(), get_upload_value());
}

function get_link_value() {
  return "LINK";
}

function get_upload_value() {
  return "UPLOAD";
}


function get_all_training_links() {
  return db_query("SELECT * FROM training_material} JOIN {training_links} ON training_material.title = training_links.title")
    -> fetchAll();
}

function as_options_array($input_array) {

  $output = array();
  foreach ($input_array as $entry) {
    array_push($output, t($entry));
  }
  return drupal_map_assoc($output);

}

function get_form_value($form, $string) {
  if (form_has_value($form, $string)) {
    return $form['values'][$string];
  } else {
    return NULL;
  }
}

function get_any_choice_value() {
  return "Any/Other";
}

function form_has_value($form, $string) {
  if (!array_key_exists('values', $form)) {
    return FALSE;
  }
  $values = $form['values'];
  return array_key_exists($string,  $values) &&  $values[$string] != "";
}

function contains_substring($string, $substring) {
  return strpos($string, $substring) !== false;
}
