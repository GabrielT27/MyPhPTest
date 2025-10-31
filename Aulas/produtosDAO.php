<?php

require_once 'Produto.php'; // Importa a classe Produto para uso

class ProdutoDAO { // DAO = "Data Access Object" - Padrão de projeto para acesso a dados

    private $Produtos = []; // Array para armazenar temporariamente os objetos

    private $arquivo = "Produtos.json"; // Nome do arquivo para persistência

        // Construtor: carrega os dados do arquivo JSON ao iniciar a aplicação
    public function __construct() { 
        if (file_exists($this->arquivo)) {
            $conteudo = file_get_contents($this->arquivo);  
            $dados = json_decode($conteudo, true); // Converte JSON em array associativo

            if ($dados) {
                foreach ($dados as $Codigo => $info) {
                    $this->Produtos[$Codigo] = new Produto(
                        $info['Codigo'],
                        $info['Nome'],
                        $info['Preco']
                    );
                }
            }
        }
    }

        // Função privada para salvar os dados no arquivo JSON
    private function salvarEmArquivo() {
        $dados = [];

        foreach ($this->Produtos as $Codigo => $Produto) {
            $dados[$Codigo] = [
                'Codigo' => $Produto->getCodigo(),
                'Nome' => $Produto->getNome(),
                'Preco' => $Produto->getPreco()
            ];
        }

        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
    }

    // CREATE: Adiciona um novo aluno ao sistema
    public function criarAluno(Produto $Produto) {
        $this->Produtos[$Produto->getCodigo()] = $Produto;
        $this->salvarEmArquivo(); // Persiste a alteração no arquivo
    }

    // READ: Retorna todos os Produtos
    public function lerAluno() {
        return $this->Produtos;
    }

    // UPDATE: Atualiza os dados de um aluno existente
    public function atualizarAluno($Codigo, $novoNome, $novoCurso) {
        if (isset($this->Produtos[$Codigo])) {
            $this->Produtos[$Codigo]->setNome($novoNome);
            $this->Produtos[$Codigo]->setCurso($novoCurso);
            $this->salvarEmArquivo(); // Persiste a alteração no arquivo
        }
    }

    // DELETE: Remove um aluno do sistema
    public function excluirAluno($Codigo) {
        if (isset($this->Produtos[$Codigo])) {
            unset($this->Produtos[$Codigo]);
            $this->salvarEmArquivo(); // Persiste a alteração no arquivo
        }
    }
}

?>