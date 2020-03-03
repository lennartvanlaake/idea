<?php

function idea_menu() {

  /**
   * projectpagina
   */
  $items['project'] = array(
    'title' => 'Project pagina',
    'description' => 'project landing page',
    'page callback' => 'trainers_homepage',
    'access arguments' => array('access content'),
    'type' => MENU_NORMAL_ITEM,
  );

  /**
   * Configuration page for the admin
   */
  $items['project/training/admin/config'] = array(
    'title' => 'Global training configuration',
    'description' => 'Adjust the possible values for all training uploads',
    'page callback' => 'drupal_get_form',
    'page arguments' => array('form_config_form'),
    'access arguments' => array('access content'),
    'type' => MENU_NORMAL_ITEM,
  );

  /**
   * Upload links to training material
   */
  $items['project/training/upload/links'] = array(
    'title' => 'Upload links',
    'description' => 'Form to upload links to training material',
    'page callback' => 'drupal_get_form',
    'page arguments' => array('form_training_link_form'),
    'access arguments' => array('access content'),
    'type' => MENU_NORMAL_ITEM,
  );

  /**
   * search training database
   */
  $items['project/training/search'] = array(
    'title' => 'Search',
    'description' => 'Search',
    'page callback' => 'drupal_get_form',
    'page arguments' => array('idea_search_form'),
    'access arguments' => array('access content'),
    'type' => MENU_NORMAL_ITEM,
  );

  /**
   * Add trainer
   */
  $items['project/trainers/add'] = array(
    'title' => 'Add trainer',
    'description' => 'Add trainer to trainer database',
    'page callback' => 'drupal_get_form',
    'page arguments' => array('insert_trainer_form'),
    'type' => MENU_NORMAL_ITEM,
    'access arguments' => array('access content'),
  );

  /**
   * search trainer database
   */
  $items['project/trainers'] = array(
    'title' => 'Trainer Database',
    'description' => 'trainerdb landing page',
    'page callback' => 'trainers_homepage',
    'file' => 'idea.inc',
    'type' => MENU_NORMAL_ITEM,
    'access arguments' => array('access content'),
  );

  return $items;

}
