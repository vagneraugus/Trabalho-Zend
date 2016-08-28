<?php

class AulaController extends Zend_Controller_Action {

  public function lerAction() {
     $data = date('c');
	 
	 $this ->view ->dataHoje = $data;   //acessa a view e passa informação
  }

}