<?php
namespace Controller; // Define o namespace (organiza o código por "pacotes" lógicos)
                      // Aqui estamos dentro da camada de controle (Controller)

// Importa os arquivos necessários da pasta "model"
// __DIR__ retorna o caminho completo até o diretório atual deste arquivo
// Os caminhos são relativos (sobem um nível e entram em "model")
require_once __DIR__ . '/../model/bebidasDAO.php';
require_once __DIR__ . '/../model/Bebida.php';

// Importa as classes BebidaDAO e Bebida, para poder usá-las aqui
use model\BebidaDAO;
use model\Bebida;

class BebidaController {
    private $dao; // Propriedade que vai guardar o objeto de acesso aos dados (DAO)

    // Construtor: é chamado automaticamente quando criamos um novo BebidaController
    public function __construct() {
        // Instancia o DAO — responsável por salvar, ler e excluir dados das bebidas
        $this->dao = new BebidaDAO();
    }

    // Método que lê todas as bebidas cadastradas
    public function ler() {
        // Apenas repassa a chamada para o DAO
        // Retorna uma lista (array) de objetos Bebida
        return $this->dao->lerBebidas();
    }

    // Método para criar uma nova bebida
    public function criar($nome, $categoria, $volume, $valor, $qtde) {
        // Cria um novo objeto da classe Bebida com os dados recebidos
        $bebida = new Bebida($nome, $categoria, $volume, $valor, $qtde);

        // Chama o DAO para salvar essa nova bebida (ex: em um arquivo JSON)
        $this->dao->criarBebida($bebida);
    }

    // Método para deletar uma bebida existente
    public function deletar($nome) {
        // Pede ao DAO para excluir a bebida com o nome informado
        $this->dao->excluirBebida($nome);
    }

    // Método para editar uma bebida existente
    public function editar ($nome, $categoria, $volume, $valor, $qtde ) {
        // PEDE ao DAO para editar a bebida com o nome informado
        $this->dao->editarBebida($nome, $categoria, $volume, $valor, $qtde );
    } 
}
