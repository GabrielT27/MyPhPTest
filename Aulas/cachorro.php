<?php 

class Cachorro {
    public $nome;
    public $idade;
    public $raca;
    public $castrado;
    public $sexo;

    function __construct($nome, $idade, $raca, $castrado, $sexo){
        $this-> nome = $nome;
        $this-> idade = $idade;
        $this-> raca = $raca;
        $this-> castrado = $castrado;
        $this-> sexo = $sexo;



    }
}

$cachorro1 = new Cachorro("Henrique", 2, "Pincher", true, "M");
$cachorro2 = new Cachorro("Luna", 3, "Poodle", false, "F");
$cachorro3 = new Cachorro("Thor", 5, "Labrador", true, "M");
$cachorro4 = new Cachorro("Mel", 1, "Shih Tzu", false, "F");
$cachorro5 = new Cachorro("Rex", 4, "Pastor Alemão", true, "M");
$cachorro6 = new Cachorro("Nina", 2, "Bulldog", false, "F");
$cachorro7 = new Cachorro("Bob", 6, "Beagle", true, "M");
$cachorro8 = new Cachorro("Bella", 3, "Golden Retriever", false, "F");
$cachorro9 = new Cachorro("Max", 7, "Boxer", true, "M");
$cachorro10 = new Cachorro("Julie", 2, "Yorkshire", false, "F");


?>