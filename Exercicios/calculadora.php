<?php 

$num1 = (int)readline("Digite o primeiro numero: ");

$num2 = (int) readline("Digite o segundo numero: ");

$operacao = readline("Digite a operação: ");


switch($operacao) {
    case "Adição":
        echo "Resultado:  " . ($num1 + $num2);
        break;
    case "Subtração":
        echo "Resultado:  " . ($num1 - $num2);
        break;
    case "Divisão":
        echo "Resultado:  " . ($num1 / $num2);
        break;
    case "Multiplicação":
        echo "Resultado:  " . ($num1 * $num2);
        break;
    default:
        echo "Digite uma operação válida!";
    
}






?>