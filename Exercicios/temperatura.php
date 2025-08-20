<?php
$temperatura = readline("Insira ums temperatura");

if ($temperatura <=15) {
    echo "Frio";
} elseif ($temperatura >=16 && $temperatura <=25) {
    echo "Agradável";
} else {
    echo "Quente";
}
?>
