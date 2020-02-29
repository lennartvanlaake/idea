<?php

function idea_menu() {

  $items['training/admin/config'] = array( //this creates a URL that will call this form at "examples/form-example"
    'title' => 'Global training configuration', //page title
    'description' => 'Adjust the possible values for all training uploads',
    'page callback' => 'drupal_get_form', //this is the function that will be called when the page is accessed.  for a form, use drupal_get_form
    'page arguments' => array('form_config_form'), //put the name of the form here
    'access callback' => TRUE
  );
  return $items;

}
