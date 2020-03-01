<?php

function idea_menu() {

  /**
   * Configuration page for the admin
   */
  $items['training/admin/config'] = array(
    'title' => 'Global training configuration',
    'description' => 'Adjust the possible values for all training uploads',
    'page callback' => 'drupal_get_form',
    'page arguments' => array('form_config_form'),
    'access callback' => TRUE
  );

  /**
   * Upload links to training material
   */
  $items['training/upload/links'] = array(
    'title' => 'Upload links',
    'description' => 'Form to upload links to training material',
    'page callback' => 'drupal_get_form',
    'page arguments' => array('form_training_link_form'),
    'access callback' => TRUE
  );

  /**
   * Upload links to training material
   */
  $items['training/search'] = array(
    'title' => 'Search',
    'description' => 'Search',
    'page callback' => 'drupal_get_form',
    'page arguments' => array('idea_search_form'),
    'access callback' => TRUE
  );
  return $items;

}
