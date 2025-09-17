<?php 
interface Calculadora {
    public function somar();
}

class twonumber implements Calculadora {

    public $number1;
    public $number2;

    

    public function somar() {
        echo "{$this->number1} + {$this->number2} = ".$this->number1 + $this->number2;
    }

}

$twonumber = new twonumber();
$twonumber->number1 = "10";

$twonumber = new twonumber();
$twonumber->number2 = "30";

?>