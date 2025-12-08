
<?php
require_once 'Livros.php';
require_once 'connection.php';

class LivrosDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();

        // Cria a tabela se não existir
        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS Livros (
                id_livro INT AUTO_INCREMENT PRIMARY KEY,
                nome_livro VARCHAR(100) NOT NULL UNIQUE,
                descricao_livro VARCHAR(255) NOT NULL,
                qntde INT NOT NULL,
                local CHAR(10) NOT NULL,
                autor VARCHAR(100) NOT NULL,
                ano DATE NOT NULL,
                genero VARCHAR(100) NOT NULL
            )
        ");
    }
    
    // CREATE
    public function criarLivros(Livro $livro) {
        $stmt = $this->conn->prepare("
            INSERT INTO Livros (nome_livro, descricao_livro, qntde, local, ano, autor, genero)
            VALUES (:nome, :descricao, :qntde, :local, :ano, :autor, :genero)
        ");
        $stmt->execute([
            ':nome'      => $livro->getNomeLivro(),
            ':descricao' => $livro->getDescricaoLivro(),
            ':qntde'     => $livro->getQntde(),
            ':local'     => $livro->getLocal(),
            ':ano'       => $livro->getAno(),
            ':autor'     => $livro->getAutor(),
            ':genero'    => $livro->getGenero(),
        ]);
    }

    // READ
    public function lerLivros() {
        $stmt = $this->conn->query("SELECT * FROM Livros ORDER BY nome_livro");
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Livro(
                $row['id_livro'],
                $row['nome_livro'],
                $row['descricao_livro'],
                $row['qntde'],
                $row['local'],
                $row['autor'],
                $row['ano'],
                $row['genero']
            );
        }
        return $result;
    }

    // UPDATE
    public function atualizarLivros($id_livro, $novoNome, $novaDescricao, $novaQtnde, $novoLocal, $novoAutor, $novoAno, $novoGenero) {
        $stmt = $this->conn->prepare("
            UPDATE Livros
            SET nome_livro = :novoNome, 
                descricao_livro = :novaDescricao, 
                qntde = :novaQtnde, 
                local = :novoLocal, 
                autor = :novoAutor, 
                ano = :novoAno, 
                genero = :novoGenero
            WHERE id_livro = :id_livro
        ");
        $stmt->execute([
            ':novoNome'     => $novoNome,
            ':novaDescricao'=> $novaDescricao,
            ':novaQtnde'    => $novaQtnde,
            ':novoLocal'    => $novoLocal,
            ':novoAutor'    => $novoAutor,
            ':novoAno'      => $novoAno,
            ':novoGenero'   => $novoGenero,
            ':id_livro'     => $id_livro
        ]);
    }

    // DELETE
    public function excluirLivros($id_livro) {
        $stmt = $this->conn->prepare("DELETE FROM Livros WHERE id_livro = :id_livro");
        $stmt->execute([':id_livro' => $id_livro]);
    }

    // BUSCAR POR NOME
    public function buscarPorNome($nome_livro) {
        $stmt = $this->conn->prepare("SELECT * FROM Livros WHERE nome_livro LIKE :nome_livro");
        $stmt->execute([':nome_livro' => "%$nome_livro%"]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Livro(
                $row['id_livro'],
                $row['nome_livro'],
                $row['descricao_livro'],
                $row['qntde'],
                $row['local'],
                $row['autor'],
                $row['ano'],
                $row['genero']
            );
        }
        return null;
    }
}