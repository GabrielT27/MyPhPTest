<?php
require_once __DIR__ . '/livrosDAO.php';
require_once __DIR__ . '/livros.php';


class LivrosController {
    private $dao;

    public function __construct() {
        $this->dao = new LivrosDAO();
    }

    // READ - listar todos os livros
    public function ler() {
        return $this->dao->lerLivros();
    }

    // CREATE - criar novo livro
    public function criar($nome, $descricao, $qntde, $local, $autor, $ano, $genero) {
        // id_livro = null porque será gerado automaticamente pelo banco
        $livro = new Livro(null, $nome, $descricao, $qntde, $local, $autor, $ano, $genero);
        $this->dao->criarLivros($livro);
    }

    // UPDATE - atualizar livro existente
    public function atualizar($id_livro, $novoNome, $novaDescricao, $novaQntde, $novoLocal, $novoAutor, $novoAno, $novoGenero) {
        $this->dao->atualizarLivros($id_livro, $novoNome, $novaDescricao, $novaQntde, $novoLocal, $novoAutor, $novoAno, $novoGenero);
    }

    // DELETE - excluir livro
    public function excluir($id_livro) {
        $this->dao->excluirLivros($id_livro);
    }

    // BUSCAR - buscar livro por nome
    public function buscarPorNome($nome_livro) {
        return $this->dao->buscarPorNome($nome_livro);
    }
}
?>