<?php 

require_once "CRUD.php";
require_once "AlunoDAO.php"; // Inlcui outros arquivos php


// Objeto da classe AlunoDAO para gerenciar os métodos do CRUD 

$dao = new AlunoDAO();


// CREATE  

$dao-> criarAluno(new Aluno( 1, "Maria", "Design"));

$dao-> criarAluno (new Aluno(2, "Gabriel", "Moda"));

$dao-> criarAluno (new Aluno(3, "Eduardo", "Manicure"));


// READ 

echo "\nListagem Inicial: \n";
foreach ($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()}\n";
    
}


// UPDATE 

$dao->atualizarAluno(3, "Viviane", "Eletricista");

echo "\nApós Atualização: \n";
foreach ($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} - {$aluno->getNome()} - {$aluno->getCurso()} \n";
}

// DELETE 

$dao->excluirAluno(2);

echo "\nApós exclusão\n";
foreach ($dao->lerAluno() as $aluno) {
    echo "{$aluno->getId()} = {$aluno->getNome()} - {$aluno->getCurso()} \n";
}
