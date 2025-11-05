<?php 

require_once 'bebidasCRUD.php'; // Importa a classe BEBIDAS para uso

class BebidasDAO { 
    private $Bebidas = [];
    private $arquivo = "Bebidas.json";

    public function __construct() {
        if (file_exists($this->arquivo)) {
            $conteudo = file_get_contents($this->arquivo);
            $dados = json_decode($conteudo, true);

            if ($dados) {
                foreach ($dados as $codigo => $info) {
                    $this->Bebidas[$codigo] = new Bebidas(
                        $info["Nome"],
                        $info["Categoria"],
                        $info["Volume"],
                        $info["Valor"],
                        $info["Qtde"]
                    );
                }
            }
        }
    }

    // FUNÇÕES PRIVADA PARA SALVAR OS DADOS NO ARQUIVO JSON 
    private function salvarEmArquivo() {
        $dados = [];

        foreach ($this->Bebidas as $codigo => $bebida) {
            $dados[$codigo] = [
                'Nome' => $bebida->getNome(),
                'Categoria' => $bebida->getCategoria(),
                'Volume' => $bebida->getVolume(),
                'Valor' => $bebida->getValor(),
                'Qtde' => $bebida->getQtde()
            ];
        }

        $json = json_encode($dados, JSON_PRETTY_PRINT);
        file_put_contents($this->arquivo, $json);
    }

    // CREATE - Criar uma nova bebida
    public function criarBebida($codigo, $nome, $categoria, $volume, $valor, $qtde) {
        if (!isset($this->Bebidas[$codigo])) {
            $this->Bebidas[$codigo] = new Bebidas($nome, $categoria, $volume, $valor, $qtde);
            $this->salvarEmArquivo();
            return true;
        }
        return false;
    }

    // READ - Ler uma bebida específica
    public function ler($codigo) {
        return isset($this->Bebidas[$codigo]) ? $this->Bebidas[$codigo] : null;
    }

    // READ ALL - Ler todas as bebidas
    public function lerTodos() {
        return $this->Bebidas;
    }

    // UPDATE - Atualizar uma bebida
    public function atualizar($codigo, $nome, $categoria, $volume, $valor, $qtde) {
        if (isset($this->Bebidas[$codigo])) {
            $bebida = $this->Bebidas[$codigo];
            $bebida->setNome($nome);
            $bebida->setCategoria($categoria);
            $bebida->setVolume($volume);
            $bebida->setValor($valor);
            $bebida->setQtde($qtde);
            $this->salvarEmArquivo();
            return true;
        }
        return false;
    }

    // DELETE - Excluir uma bebida
    public function excluir($codigo) {
        if (isset($this->Bebidas[$codigo])) {
            unset($this->Bebidas[$codigo]);
            $this->salvarEmArquivo();
            return true;
        }
        return false;
    }

    // Método para buscar bebidas por categoria
    public function buscarPorCategoria($categoria) {
        $resultado = [];
        foreach ($this->Bebidas as $codigo => $bebida) {
            if ($bebida->getCategoria() === $categoria) {
                $resultado[$codigo] = $bebida;
            }
        }
        return $resultado;
    }

    // Método para verificar estoque
    public function verificarEstoque($codigo) {
        if (isset($this->Bebidas[$codigo])) {
            return $this->Bebidas[$codigo]->getQtde();
        }
        return 0;
    }

    // Método para atualizar quantidade em estoque
    public function atualizarEstoque($codigo, $novaQtde) {
        if (isset($this->Bebidas[$codigo])) {
            $this->Bebidas[$codigo]->setQtde($novaQtde);
            $this->salvarEmArquivo();
            return true;
        }
        return false;
    }
}