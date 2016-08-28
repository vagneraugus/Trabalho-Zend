<?php

class PratoController extends Blog_Controller_Action {

    public function indexAction() {

      $tab = new Application_Model_DbTable_Prato();
       $consulta = $tab->getAdapter()->select();
       $consulta->from(array(
           "p"=>"prato"
       ), array(
           "idprato", "nomePrato", "preco"
       ));
       $consulta->joinInner(array(
           "c"=>"categoria"
       ), "c.idcategoria = p.idcategoria", array(
           "categoria"
       ));
       $consulta->where("p.idcategoria > ?", "0", Zend_Db::INT_TYPE);
      
       $consultaBd = $consulta->query()->fetchAll();
       $this->view->posts = $consultaBd;
       $this->view->podeApagar = $this ->aclIsAllowed('prato', 'delete');
        
    }
    //teste

    public function createAction() {

        $frm = new Application_Form_Prato();   //instancia o formulário de post

        if($this ->getRequest() ->isPost())
        {
            $params = $this ->getAllParams();

            if($frm ->isValid($params))
            {
                $params = $frm ->getValues();   

                $prato = new Application_Model_Vo_Prato();
                $prato ->setIdcategoria($params['idcategoria']);
                $prato ->setIdadmin($params['idadmin']);
                $prato ->setnomePrato($params['nomePrato']);
                $prato ->setPreco($params['preco']);

                $model = new Application_Model_Prato();  
                $model ->salvar($prato);    

                $flashMessenger = $this ->_helper ->FlashMessenger;  
                $flashMessenger ->addMessage("O prato foi salvo");   

                $this ->_helper ->Redirector ->gotoSimpleAndExit('index'); 
            }
        }

        $this ->view ->frm = $frm;   //passa para a view
        
    }

    public function deleteAction() {

    	$idprato = (int) $this ->getParam('idprato', 0);  

        $model = new Application_Model_Prato();   
        $model ->apagar($idprato);   

        $flashMessenger = $this ->_helper ->FlashMessenger;   
        $flashMessenger ->addMessage("Registro apagado");     

        $this ->_helper ->Redirector ->gotoSimpleAndExit('index');
        
    }

    public function updateAction() {

    $idprato = (int) $this ->getParam('idprato', 0);  
    
    $tabela = new Application_Model_DbTable_Prato();   
    $linha = $tabela ->fetchRow('idprato = ' . $idprato);  

    if($linha === null)  
    {
        echo 'prato inexistente';
        exit;
    } 

    $frm = new Application_Form_Prato();  

        if($this ->getRequest() ->isPost())  
        {
            $params = $this ->getAllParams();  //pega os dados do usuário   

            if($frm ->isValid($params))  //vai atribuir os valores para cada elemento e validar
            {
                $params = $frm ->getValues();   //pega os dados do formulário

                $prato = new Application_Model_Vo_Prato();
                $prato ->setIdcategoria($params['idcategoria']);
                $prato ->setIdadmin($params['idadmin']);
                $prato ->setnomePrato($params['nomePrato']);
                $prato ->setPreco($params['preco']);
                $prato ->setIdprato($idprato);

                $model = new Application_Model_Prato();  
                $model ->atualizar($prato);    

                $flashMessenger = $this ->_helper ->FlashMessenger;  
                $flashMessenger ->addMessage("O prato foi salvo.");   

                $this ->_helper ->Redirector ->gotoSimpleAndExit('index');   
            }        
        
    } else {   //se não veio por post pega os dados do banco

         $frm ->populate(array(    //passar informações para a tela do usuário

            'idcategoria' => $linha ->idcategoria,
            'idadmin'     => $linha ->idadmin,
            'nomePrato'   => $linha ->nomePrato,
            'preco'       => $linha ->preco
            ));    
    }

    $this ->view ->frm = $frm;
        
    }

}
