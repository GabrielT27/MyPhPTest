<?php
// CRUD

class Produto {
    private $Codigo;
    private $Nome;
    private $Preco;

    public function __construct($Codigo, $Nome, $Preco) {
        $this-> Codigo = $Codigo;
        $this-> Nome = $Nome;
        $this-> Preco = $Preco;
    }

     // SETTERS

    public function setCodigo($Codigo) { 
        $this->Codigo = $Codigo;
    }

    public function setNome($Nome) {
        $this->Nome = $Nome;
    }

    public function setPreco($Preco) {
        $this->Preco = $Preco;
    }
    // GETTERS
    public function getCodigo() {
        return $this->Codigo;
    }

    public function getNome() {
        return $this->Nome;
    }

    public function getPreco() {
        return $this->Preco;
    }
}

?>

?>