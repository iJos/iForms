<?php
/**
 * The MIT License
 * Copyright (c) 2015 Jose Luis Jimenez Urbano
 */
namespace iJos\iForms\Fields;

class Select extends Base{

  protected $_attributes = array("type" => "select");
  protected $_options = array();
  protected $_values = array();
  protected $_first_option = "";

  public function __construct( $params = array() ) {
    parent::__construct( $params );
    $this -> _tag_type = "select";

    if( !empty( $params['first_option'] ) ) { $this -> _first_option = $params['first_option']; }
    if( !empty( $params['options'] ) ) { $this-> _options = $params['options']; }
    if( !empty( $params['values'] ) ) { $this-> _values = $params['values']; }
  }

  public function getOptions(){
    return $this -> _options;
  }

  public function getValues(){
    return $this -> _values;
  }

  public function getFirstOption(){
    return $this -> _first_option;
  }

}
?>