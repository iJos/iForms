<?php
/**
 * The MIT License
 * Copyright (c) 2015 Jose Luis Jimenez Urbano
 */
namespace iJos\iForms;

class iForm {

  private $form_fields;
  private $use_bootstrap;
  private $form_method;
  private $form_action;

  private $constants;

  function __construct() {
    $this -> form_fields = array();
    $this -> use_bootstrap = false;
    $this -> bootstrap_form_orientation = "horizontal";
    $this -> form_method = "POST";
    $this -> form_action = "";

    $this -> constants = Constants::getInstance();
  }

  public function addField( $params = array() ) {

    if( $this -> isUsingBootstrap() ){
      if( $params['type'] != "submit"){
        $params['params']['class'] = $params['params']['class'] . " form-control";
      }else{
        $params['params']['class'] = $params['params']['class'] . " btn btn-default";
      }
    }

    $this -> addFormField($params['type'], $params);
  }

  /**
   * Add a Field to the curent form
   *
   * @param string $type
   * @param array $params
   */
  public function addFormField($type, $params = array()) {
    $namespace = "\\iJos\\iForms\\Fields\\" . ucfirst($type);
    $field = new $namespace( $params );
    array_push($this -> form_fields, $field);
  }

  // Set if we should use bootstrap
  public function useBootstrap( $value ) {
    $this -> use_bootstrap = $value;
  }

  // Checks if form is using bootstrap
  private function isUsingBootstrap() {
    return $this -> use_bootstrap;
  }

  public function setBootstrapOrientation( $orientation ){
    $this -> bootstrap_form_orientation = $orientation;
  }

  // Sets the form method
  public function setMethod( $method ){
    $this -> form_method = $method;
  }

  // Sets the form action
  public function setAction( $action ){
    $this -> form_action = $action;
  }

  /**
   * Render the main "Form" (All the Fields)
   */
  private function form() {

    // Iterate through all the fields, rendering them
    foreach ( $this -> form_fields as $form_field ) {
      // Get Tag Type (input, select, option, button...)
      $tag_type = $form_field -> getTagType();
      $html_field = "";

      if( $this -> isUsingBootstrap() ){
        $html_field .= "<div class='form-group'>";
      }

      echo $form_field -> getFieldPreHTML();

      $html_field .= "<" . $tag_type . " ";
      $attributes = $form_field -> getAttributes();

      foreach ( $attributes as $att => $val ) {
        $html_field .= $att . "='" . $val . "' ";
      }
      // Remove last whitespace
      $html_field = rtrim($html_field);
      $html_field .= ">";

      if ( $tag_type == "button" || $tag_type == "a" || $tag_type == "select" ){
        if( $tag_type == "select" ){
          $options = $form_field -> getOptions();
          $values = $form_field -> getValues();
          // First option (Disabled)
          $html_field .= "<option value='' disabled='disabled' selected='true'>" . $form_field -> getFirstOption() . "</option>";
          foreach ($options as $option_key => $option_value ) {
            $html_field .= "<option value='" . $values[$option_key] . "'>" . $option_value . "</option>";
          }
          $html_field .= "</" . $tag_type . ">";
        }else{
          $html_field .= $form_field -> getInnerText();
          $html_field .= "</" . $tag_type . ">";
        }
      }

      if( $this -> isUsingBootstrap() ){
        $html_field .= "</div>";
      }

      echo $html_field;
    }

    echo $form_field -> getFieldPostHTML();
  }

  // Here we should print <form> tag with his methods
  private function beforeForm() {
    // Add Bootstrap CSS if is enabled
    $form_class = "";
    if ( $this -> isUsingBootstrap() ) {
      echo $this -> constants -> getBootstrapCSS();
      if( $this -> bootstrap_form_orientation == "horizontal" ){
        $form_class = "form-horizontal";
      }else if( $this -> bootstrap_form_orientation = "inline" ){
        $form_class = "form-inline";
      }
    }

    // Render form header
    echo "<form method='" . $this -> form_method . "' action='" . $this -> form_action . "' class='" . $form_class . "'>";
  }

  // Here we sould print other things like hidden fields, js...
  private function afterForm() {
    // Render submit button

    // Ends form
    echo "</form>";
  }

  public function render() {
    // Print before form
    $this -> beforeForm();

    // Print form fields
    $this -> form();

    //Print after form
    $this -> afterForm();
  }


  public function debug() {
    echo "<pre>",  print_r( $this, true ), "</pre>";
  }

}
?>