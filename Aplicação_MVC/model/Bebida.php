<?php
namespace Model; 
// Define o namespace (pacote lógico). 
// Isso organiza o código e evita conflitos de nomes com outras classes.
// Aqui estamos dentro da camada "Model" do padrão MVC (Model-View-Controller).

class Bebida {
    // 🔒 Atributos privados — só podem ser acessados de dentro da própria classe.
    // Isso é um exemplo de ENCAPSULAMENTO.
    private $nome;
    private $categoria;
    private $volume;
    private $valor;
    private $qtde;

    // 🏗️ Construtor — executado automaticamente quando criamos um novo objeto Bebida.
    // Ele recebe os dados da bebida e armazena dentro dos atributos privados.
    public function __construct($nome, $categoria, $volume, $valor, $qtde){
        $this->nome = $nome;           // Nome da bebida (ex: Coca-Cola)
        $this->categoria = $categoria; // Tipo (ex: Refrigerante, Suco, etc.)
        $this->volume = $volume;       // Tamanho (ex: 350ml)
        $this->valor = $valor;         // Preço (ex: 4.50)
        $this->qtde = $qtde;           // Quantidade em estoque
    }

      // ⚙️ Métodos SET — usados para definir (alterar) valores

      public function setNome($nome) {
        $this->nome=$nome;
      }

      public function setCategoria($categoria) {
        $this->categoria=$categoria;
      }

      public function setVolume($volume) {
        $this->volume=$volume;
      }

      public function setValor($valor) {
        $this->valor=$valor;
      }

      public function setQtde($qtde) {
        $this->qtde=$qtde;
      }

    // ⚙️ Métodos GET — usados para acessar (ler) os valores dos atributos.
    // São a forma "segura" de pegar os dados sem expor diretamente as variáveis privadas.
    public function getNome(){ return $this->nome; }
    public function getCategoria(){ return $this->categoria; }
    public function getVolume(){ return $this->volume; }
    public function getValor(){ return $this->valor; }
    public function getQtde(){ return $this->qtde; }
}
