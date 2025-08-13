<?php

$nota = readline("Digite sua nota: ");

if ($nota >= 9) {
    echo "Excelente";
} elseif ($nota >= 7 && $nota <=8 ) {
    echo "Bom";
} else {
    echo "Reprovado";
}
?>