<?php
namespace Aula_14;

use produto;

class produtoDAO {

    private $produtos = [];

    private $arquivo = "produtos.json";

    public function __construct() {
        if (file_exists(filename: $this->arquivo)) {
            $conteudo = file_get_contents(filename: $this->arquivo);
            $dados = json_decode(json: $conteudo, associative: true);
            if ($dados) {
                foreach($dados as $codigo => $info) {
                    $this->produtos[$codigo] = new produto($info['codigo'], $info['nome'], $info['preco']);
                }
                
            }
        }
    }

    private function salvarEmArquivo() {
        $dados = [];

        foreach ($this->produtos as $codigo => $produto) {
            $dados[$codigo] = [
                'codigo' => $produto->getCodigo(),
                'nome' => $produto->getNome(),
                'preco' => $produto->getPreco(),
            ];
        }

        file_put_contents(filename: $this->arquivo, data: json_encode(value: $dados, flags: JSON_PRETTY_PRINT));
    }

    public function criarProduto(produto $produto) {
        $this->produtos[$produto->getCodigo()] = $produto;
        $this->salvarEmArquivo();
    }

    public function lerProduto(){
        return $this->produtos;
    }

    public function atualizarProduto($codigo, $novoNome, $novoPreco){
        if(isset($this->produtos[$codigo])) {
            $this->produtos[$codigo]->setNome($novoNome);
            $this->produtos[$codigo]->setPreco($novoPreco);
        }
    }

    public function excluirProduto($codigo){
        unset($this->produtos[$codigo]);
        $this->salvarEmArquivo();
    }
}