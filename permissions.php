<?php



/**
 * Implements hook_permission().
 */
function idea_permission()
{
  return array(
    'upload material' => array(
      'title' => t('Upload training material'),
      'description' => t('Perform uploads of training material.'),
    ),
    'steering committee' => array(
      'title' => t('Steering committee for this site'),
      'description' => t('Perform steering committee management tasks')
    )
  );
}
