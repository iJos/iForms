<?php
/**
 * The MIT License
 * Copyright (c) 2015 Jose Luis Jimenez Urbano
 */
namespace iJos\iForms\Fields;

class Text extends Base{

  protected $_attributes = array("type" => "text");

  public function __construct( $params = array() ) {
    parent::__construct( $params );
  }

}
?>