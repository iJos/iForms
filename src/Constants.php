<?php
/**
 * The MIT License
 * Copyright (c) 2015 Jose Luis Jimenez Urbano
 */
namespace iJos\iForms;

class Constants{

  private $bootstrapCSS = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">';

   private static $instance;
   private $contador;


   private function __construct(){

   }

   public static function getInstance(){
      if (  !self::$instance instanceof self){
         self::$instance = new self;
      }
      return self::$instance;
   }

  public function getBootstrapCSS(){
    return $this -> bootstrapCSS;
  }

}
?>