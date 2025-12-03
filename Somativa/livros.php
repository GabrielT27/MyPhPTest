<?php

class livro{
    private $id_livro = null;
    private $nome_livro;
    private $descricao_livro;
    private $qntde;
    private $local;
    private $autor;
    private $ano;
    private $genero;


    public function __construct($id_livro,$nome_livro, $descricao_livro, $qntde, $local, $autor, $ano, $genero){
        $this->setIdLivro($id_livro);
        $this->setNomeLivro($nome_livro);
        $this->setDescricaoLivro($descricao_livro);
        $this->setQntde($qntde);
        $this->setLocal($local);
        $this->setAutor($autor);
        $this->setAno($ano);
        $this->setGenero($genero);
    }
 
    public function getIdLivro()
    {
        return $this->id_livro;
    }

    public function setIdLivro($id_livro)
    {
        $this->id_livro = $id_livro;

        return $this;
    }

    public function getNomeLivro()
    {
        return $this->nome_livro;
    }

    public function setNomeLivro($nome_livro)
    {
        $this->nome_livro = $nome_livro;

        return $this;
    }
    public function getDescricaoLivro()
    {
        return $this->descricao_livro;
    }
    public function setDescricaoLivro($descricao_livro)
    {
        $this->descricao_livro = $descricao_livro;

        return $this;
    }

    public function getQntde()
    {
        return $this->qntde;
    }
    public function setQntde($qntde)
    {
        $this->qntde = $qntde;

        return $this;
    }

    public function getLocal()
    {
        return $this->local;
    }

    public function setLocal($local)
    {
        $this->local = $local;

        return $this;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    public function getAno()
    {
        return $this->ano;
    }

    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }
}

?>