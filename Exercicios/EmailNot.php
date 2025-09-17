<?php 
interface Notificacoes {
    public function enviar();
}

class email implements Notificacoes {
    public function enviar(){
    echo "Enviando email";

}
}

class sms implements Notificacoes {
    public function enviar() {
        echo "Enviando SmS";
    }
}





?>