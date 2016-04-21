<?php
/**
 * The MIT License
 * Copyright (c) 2015 Jose Luis Jimenez Urbano
 */
namespace iJos\iForms\Fields;

class Submit extends Base{
  protected $_inner_text;
  protected $_attributes = array("type" => "submit");

  public function __construct( $params = array() ) {
    parent::__construct( $params );
    $this -> _tag_type = "button";

    // If tag "inner_text" exists
    if ( !empty($params['inner_text']) ){ $this -> _inner_text = $params['inner_text']; }
  }

  public function getInnerText(){ return $this -> _inner_text; }

}
?>