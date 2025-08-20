<?php
class Carro {
    public $marca;
    public $modelo;
    public $ano;
    public $revisao;

    public $N_Donos;
    
    public function __construct ($marca, $modelo, $ano, $revisao, $N_Donos) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->ano = $ano;
        $this->revisao = $revisao;
        $this->N_Donos = $N_Donos;
    }  
} 

$carro1 = new Carro("Porshe", "911", 2022, false, 3);
$carro2 = new Carro("Mitsubishi", "Lancer", 1945, true, 1);
$carro3 = new Carro("Toyota", "Corolla", 2010, true, 1);
$carro4 = new Carro("Ford", "Mustang", 2005, true,4);
$carro5 = new Carro("Audi", "RS7", 2010, false, 3);
$carro6 = new Carro("Camaro", "Chevrolet", 2025, true, 3);



?>