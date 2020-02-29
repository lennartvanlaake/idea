<?php

function get_available_languages() {

  $results = db_query("SELECT * from {languages}");
  $languages = array();
  foreach ($results as $result) {
    array_push($languages, $result -> language);
  }
  return $languages;

}

function get_available_levels() {

  $results = db_query("SELECT * from {levels}");
  $output = array();
  foreach ($results as $result) {
    array_push($output, $result -> level);
  }
  return $output;

}

function get_available_audiences() {

  $results = db_query("SELECT * from {audiences}");
  $output = array();
  foreach ($results as $result) {
    array_push($output, $result -> audience);
  }
  return $output;

}

function get_form_value($form, $string) {
  if (form_has_value($form, $string)) {
    return $form['values'][$string];
  } else {
    return NULL;
  }
}


function form_has_value($form, $string) {
  return TRUE;
}


function form_has_value2($form, $string) {
  return key_exists($string, $form) && $form[$string] != "";
}
