<?php


function idea_search_form($form, &$form_state) {

  $choice_type = "select";

  $form['query'] = array(
    '#type' => 'textfield',
    '#title' => 'Search description and title',
    '#size' => 30,
    '#maxlength' => 30,
    '#required' => FALSE,
  );

  $form['language'] = array(
    '#type' => $choice_type,
    '#title' => 'Select a language',
    '#options' => as_options_array(get_any_choice_value(), get_available_languages()),
    '#required' => FALSE,
  );

  $form['level'] = array(
    '#type' => $choice_type,
    '#title' => 'Select a level',
    '#options' => as_options_array(get_any_choice_value(), get_available_levels()),
    '#required' => FALSE,
  );

  $form['audience'] = array(
    '#type' => $choice_type,
    '#title' => 'Select a audience',
    '#options' => as_options_array(get_any_choice_value(), get_available_audiences()),
    '#required' => FALSE,
  );

  $form['category'] = array(
    '#type' => $choice_type,
    '#title' => 'Select a category',
    '#options' => as_options_array(get_any_choice_value(), get_possible_categories()),
    '#required' => FALSE,
  );

  $form['content_type'] = array(
    '#type' => $choice_type,
    '#title' => 'Select the type of content you want',
    '#options' => as_options_array(get_any_choice_value(), get_possible_content_types()),
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

  if (!array_key_exists("values", $form_state)) {
    return "";
  }
  $content = "<br><h1>Results</h1><hr>";
  $type = get_form_value($form_state, "content_type");
  if (is_null($type) || $type == get_link_value() || $type == get_any_choice_value()) {
    $links = get_all_training_links();
    $filtered_links = apply_all_filters($links, $form_state);
    $content .= generate_link_result_html($filtered_links);
  }
  return $content;

}

function apply_all_filters($results, $form_state) {
  $filter_1 = apply_filter($results, $form_state, "language");
  $filter_2 = apply_filter($filter_1, $form_state, "level");
  $filter_3 = apply_filter($filter_2, $form_state, "audience");
  $filter_4 = apply_filter($filter_3, $form_state, "category");
  return apply_query($filter_4, $form_state);
}

function apply_query($results, $form_state) {
  $query_value = get_form_value($form_state, "query");
  if (is_null($query_value)) {
    return $results;
  }
  $filtered_results = array();
  foreach ($results as $result) {
    $title = $result -> title;
    $description = $result -> description;
    if (contains_substring($title, $query_value) || contains_substring($description, $query_value)) {
      $filtered_results[] = $result;
    }
  }
  return $filtered_results;
}

function apply_filter($results, $form_state, $property) {
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

function generate_link_result_html($link_results) {
  $output = "";
  foreach ($link_results as $link) {
    $output .= "<h2> title: " . $link -> title . "</h2>";
    $output .= "<ul>";
    $output .= "<li> description: " . $link -> description . "</li>";
    $output .= "<li> url: <a href =" . $link -> url . ">".  $link -> url  ."</a></li>";
    $output .= "<li> language: " . $link -> language . "</li>";
    $output .= "<li> level: " . $link -> level . "</li>";
    $output .= "<li> audience: " . $link -> level . "</li>";
    $output .= "</ul></br>";

  }

  return $output;

}
