<?php
$dia = readline("Digite o numero de 1 a 7 e vera o dia da semana: ");

switch($dia) {
    case "1":
        echo "Segunda.";
        break;
    case "2":
        echo "Terça-Feira";
        break;
    case "3":
        echo "Quarta-Feira";
        break;
    case "4":
        echo "Quinta-Feira";
        break;
    case "5":
        echo "Sexta-Feira";
        break;
    case "6":
        echo "Sabado";
        break;
    case "7":
        echo "Domingo";
        break;
    default: 
        echo "Dia não existente";
}


?>