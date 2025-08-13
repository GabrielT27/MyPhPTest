<?php

$inicio = (int) readline("Digite um número para ver os pares a partir dele até 40: ");

for ($i = $inicio; $i <= 40; $i++) {
    if ($i % 2 == 0) {
        echo "$i\n";
    }
}
?>