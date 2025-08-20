<<?php

for ($i = 1; $i <= 5; $i++) {
    echo "\nMENU:\n";
    echo "1 - Olá\n";
    echo "2 - Data Atual\n";
    echo "3 - Sair\n";

    $opcao = readline("Escolha uma opção: ");

    switch ($opcao) {
        case 1:
            echo "Olá!\n";
            break;

        case 2:
            echo "Data Atual: " . date("d/m/Y") . "\n";
            break;

        case 3:
            echo "Saindo do programa...\n";
            break;

        default:
            echo "Opção inválida.\n";
    }

    // Se o usuário escolher sair, encerramos o laço com break
    if ($opcao == 3) {
        break;
    }
}

?>
