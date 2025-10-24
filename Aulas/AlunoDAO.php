<?php 

Class AlunoDAO {   // "DAO --> "Data Acess Object"

    private $alunos = [];  // Array para armazenamento temporário dos objetos e seus atributos, antes de mandar para o banco de dados. Foi criado incialmente vazio [];

    private $arquivo = "alunos.json"; // Cria o arquivo de json para que os dados sejam armazenados


    // Construtor alunoDAO --> carrega os dados do arquivo ao iniciar a aplicação 

    public function __construct() {
        if (file_exists($this->arquivo)){
            // Lê o conteúdo do arquivo caso ele já existe
            $conteudo = file_get_contents
            ($this->arquivo); // Atribui as informações do arquivo existente á variavel $conteudo


            $dados = json_decode( $conteudo, true); // Converte um JSON em array associativo 

            if ($dados) {
                foreach ($dados as $id => $info) {
                    $this->alunos[$id] = new Aluno(
                        $info['id'],
                        $info ['nome'],
                        $info['curso']
                    );
                }
            }
        }
    }


    // Método Auxiliar -> salva o array de alunos no arquivo 

    private function salvarEmArquivo() {
        $dados = [];
    }

    


    public function criarAluno(Aluno $aluno) // Método CREATE --> para criar um novo objeto
    {
        $this->alunos[$aluno->getId()]=$aluno;

        
    }

     public function lerAluno(){ // Método READ --> para ler informações de um objeto já existente;
        return $this->alunos;
    }
     public function atualizarAluno($id, $novoNome, $novoCurso)
            
    { // Método update --> para atualizar informações de um objeto já existente;
        if (isset($this->alunos[$id]))  {
            $this->alunos[$id]->setNome($novoNome);
            $this->alunos[$id]->setCurso($novoCurso); 
        }

        
    }

     public function excluirAluno($id) {// método Delete --> para excluir um objeto

        unset($this->alunos[$id]);
    
     }

    


    
}



?>