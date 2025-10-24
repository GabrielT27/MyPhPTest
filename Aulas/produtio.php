<?php

// Crie uma classe 'produtos' com os atributos: codigo, nome e preço. Após isso faça a ProdutosDAO para a utilizaçãodos métodos CRUD. Por último faça um index.php para testar a criação e manipulação dos objetos. Implemente e persistencia de dados com o arquivo 'produtos.json'

class Produto {
    private $codigo;
    private $nome;
    private $preco;


public function __construct($codigo, $nome, $preco){
    $this->codigo = $codigo;
    $this->nome = $nome;
    $this->preco = $preco;
}

public function setCodigo($codigo){
    $this->codigo=$codigo;
}

public function getCodigo(){
    return $this->codigo;
}

public function setNome($nome){
    $this->nome=$nome;
}

public function getNome(){
    return $this->nome;
}

public function setPreco($preco){
    $this->preco=$preco;
}

public function getPreco(){
    return $this->preco;
}

}