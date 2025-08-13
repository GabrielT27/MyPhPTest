<?php
$num = (int) readline("Digite um número para ver sua tabuada: ");

for ($i = 1; $i <= 10; $i++) {
    $resultado = $num * $i;
    echo "$num x $i = $resultado\n";
}
?>
