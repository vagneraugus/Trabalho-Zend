<?php

class AulaController extends Zend_Controller_Action {

	public function indexAction() {

	}

	//http://127.0.0.1:8887/zf1-blog/public/aula/param/id/1/nome/unipar  -> acessar pelo zend
	//http://127.0.0.1:8887/zf1-blog/public/aula/param?id=1&nome=unipar  -> acessar por get

	public function paramAction() {

		$params = $this ->getAllParams();   //pega todos os paramentros - extendido do zend_controller_action

		//print_r($params);

		$id = $this ->getParam('id', 5);  //pega o id que foi passado na url, passa um valor padrão caso não tenha no id da url
		$nome = $this ->getParam('nome');

		//echo "id=$id nome=$nome";

		//exit;

		$this ->view ->codigo = $id;   //passa os paramentros p/ view - acessa a instancia pela propriedade view e passa o valor do paramentro e o que ele recebe
		$this ->view ->nome = $nome;
	}

	public function valnumerosAction() {

		$val = new Zend_Validate_Digits();   //instancia o validador

		$valor = 'abc';    //passa o valor

		if(!$val ->isValid($valor))  //valida de acordo com o tipo de validador
		{
			echo "Houve erros: ";
			print_r($val ->getMessages());  //mostra o erro que deu
		}

		exit;
	}

	public function valemailAction() {   //valida email

		$val = new Zend_Validate_EmailAddress();

		$valor = 'unipar';

		if(!$val ->isValid($valor)) 
		{
			echo "Houve erros: ";
			print_r($val ->getMessages());
		}

		exit;
	}

	public function valalfabeticoAction() {  //teste se são caracteres alfabéticos

		$val = new Zend_Validate_Alpha();

		$valor = 123;

		if(!$val ->isValid($valor)) 
		{
			echo "Houve erros: ";
			print_r($val ->getMessages());
		}

		exit;
	}
	
}