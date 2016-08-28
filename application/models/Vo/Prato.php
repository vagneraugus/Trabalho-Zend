<?php

class Application_Model_Vo_Prato {

    private $idprato;
    private $idcategoria;
    private $idadmin;
    private $nomePrato;
    private $preco;

    function getIdprato() {
        return $this->idprato;
    }

    function getIdcategoria() {
        return $this->idcategoria;
    }

    function getIdadmin() {
        return $this->idadmin;
    }

    function getnomePrato() {
        return $this->nomePrato;
    }

    function getPreco() {
        return $this->preco;
    }

    function setIdprato($idprato) {
        $this->idprato = $idprato;
    }

    function setIdcategoria($idcategoria) {
        $this->idcategoria = $idcategoria;
    }

    function setIdadmin($idadmin) {
        $this->idadmin = $idadmin;
    }

    function setnomePrato($nomePrato) {
        $this->nomePrato = $nomePrato;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

}
