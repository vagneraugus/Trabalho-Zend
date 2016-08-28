<?php

class Application_Model_Prato {

    public function apagar($idprato) {

    	$tab = new Application_Model_DbTable_Prato();
        $tab ->delete("idprato = $idprato");   

        return true;
        
    }

    public function atualizar(Application_Model_Vo_Prato $prato) {

        $tab = new Application_Model_DbTable_Prato();  
        $tab ->update(array('idprato' => $prato ->getIdprato(),
            'idcategoria' => $prato ->getIdcategoria(),
//            'idadmin'     => $prato ->getIdadmin(),
            'nomePrato'   => $prato ->getnomePrato(),
            'preco'       => $prato ->getPreco(),
        ), 'idprato = ' . $prato ->getIdprato());
        
    }

    public function salvar(Application_Model_Vo_Prato $prato) {

    	$tab = new Application_Model_DbTable_Prato();
    	$tab ->insert(array(  
    		  'idcategoria' => $prato ->getIdcategoria(),
//    		  'idadmin'     => $prato ->getIdadmin(),
    		  'nomePrato'   => $prato ->getnomePrato(),
    		  'preco'       => $prato ->getPreco()
    		));

    	$id = $tab ->getAdapter() ->lastInsertId();  
    	$prato ->setIdprato($id);   

    	return true;
        
    }

}
