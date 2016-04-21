<?php
/**
 * The MIT License
 * Copyright (c) 2015 Jose Luis Jimenez Urbano
 */
namespace iJos\iForms\Fields;

abstract class Base {

  protected $_tag_type = "input";
  protected $_attributes = array();
  protected $_preHTML = "";
  protected $_postHTML = "";

  public function __construct( $params = array() ) {
    /*
     * Set all the parameters
     */
    foreach ( $params['params'] as $attribute => $value ) {
      $this -> setFieldAttribute( $attribute, $value );
    }

    $this -> tag_type = "input";

    if( !empty($params['pre_html']) ) $this -> setFieldPreHTML( $params['pre_html'] );
    if( !empty($params['post_html']) ) $this -> setFieldPostHTML( $params['post_html'] );

  }

  private function setFieldPreHTML( $html = "" ){
    $this -> _preHTML = $html;
  }

  private function setFieldPostHTML( $html = "" ){
    $this -> _postHTML = $html;
  }

  public function getFieldPreHTML(){ return $this -> _preHTML; }

  public function getFieldPostHTML(){ return $this -> _postHTML; }

  public function getTagType(){ return $this -> _tag_type; }

  private function setFieldAttribute( $attribute, $value ){
    $this -> _attributes[$attribute] = $value;
  }

  public function debug() {
    echo "<pre>", print_r($this, true), "</pre>";
  }

  public function getAttributes(){ return $this -> _attributes; }

}
?>