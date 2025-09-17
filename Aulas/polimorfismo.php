<?php 
namespace Aulas;
// Polimorfismo:
// O termo Polimorfismo significa "várias formas". Associando isso a Programação Orientada a Objetos, o conceito se trata de várias classes e suas instâncias (objetos) respondendo a um mesmo método de formas diferentes. No exemplo do Interface da Aula_09, temos um método CalcularArea() que responde de forma diferente á classe Quadrado, á classe Pentágono e a classe círculo. Isso quer dizer que a função é a mesma  - calcular a área da forma geométrica - mas a operação muda de acordo com a figura.

// Crie um método chamado "mover()", aonde ele responde de varias formas diferentes, para as sub-classes: Carro, Avião, Barco e Elevador, Dica: utilize Interfaces.

interface veiculo {
    
    public function mover();
}

class carro implements veiculo{
    public $nome;
    public function mover() {
    echo "O carro {$this->nome} está andando";
    }
}

class aviao implements veiculo {
    public $nome;
    public function mover() {
        echo "O avião {$this->nome} está voando";
    }
}

class barco implements veiculo {
    public $nome;
    public function mover() {
        echo "O barco {$this->nome} está navegando";
    }
}

class elevador implements veiculo {
    public $nome;

    public function mover() {
        echo "O {$this->nome} está se movendo.";
    }
}

// crie ao menos 2 objetos para testar cada classe

$carro1 = new Carro ();
$carro1->nome = "Civic";

$carro2 = new Carro ();
$carro2->nome = "Corolla";

// ========================================

$aviao1 = new Aviao ();
$aviao1->nome = "F-22 RAPTOR";

$aviao2 = new Aviao ();
$aviao2->nome = "F-16 GENERAL";

//==============================================

$barco1 = new Barco ();
$barco1->nome = "Cruzeiro do Neymar";

$barco2 = new Barco ();
$barco2-> nome = "Slice of Live";

// ==============================================

$elevador1 = new Elevador ();
$elevador->nome = "Elevador de Emergência";

$elevador2 = new Elevador ();
$elevador->nome =  "Elevador de Trabalho";





?>