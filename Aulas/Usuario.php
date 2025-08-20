<?php



class Usuario {
    public $nome;
    public $cpf;
    public $sexo;
    public $email;
    public $estado_civil;
    public $cidade;
    public $estado;
    public $endereco;
    public $cep;

    function __construct($nome, $cpf, $sexo, $email, $estado_civil, $cidade, $estado, $endereco, $cep) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->sexo = $sexo;
        $this->email = $email;
        $this->estado_civil = $estado_civil;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->endereco = $endereco;
        $this->cep = $cep;
    }
}

$usuario1 = new Usuario(
    "Gabriel Marques Terra",
    49856178819,
    "M",
    "joao.silva@email.com",
    "Solteiro",
    "São Paulo",
    "SP",
    "Rua das Flores, 100",
    "01000-000"
);

$usuario2 = new Usuario(
    "Maria Oliveira",
    "987.654.321-11",
    "F",
    "maria.oliveira@email.com",
    "Casada",
    "Rio de Janeiro",
    "RJ",
    "Avenida Brasil, 200",
    "20000-000"
);

$usuario3 = new Usuario(
    "Carlos Souza",
    "456.789.123-22",
    "M",
    "carlos.souza@email.com",
    "Divorciado",
    "Belo Horizonte",
    "MG",
    "Praça da Liberdade, 300",
    "30000-000"
);

?>
