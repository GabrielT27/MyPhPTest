<?php 

Class AlunoDAO {

    private $alunos = [];

    public function criarAluno(Aluno $aluno)
    {
        $this->alunos[$aluno->getId()]=$aluno;

        
    }

     public function lerAluno(){
        return $this->alunos;
    
 

        
    }
     public function atualizarAluno()
            // Faltou fazer atualizarAluno (prox. aluno);
    
    {

        
    }

     public function excluirAluno()
    
    {

        
    }


    
}



?>