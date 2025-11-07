<?php
namespace Model; 
// Define que esta classe pertence ao namespace Model (camada de dados no MVC).

require_once __DIR__ . '/Bebida.php'; 
// Importa a classe Bebida, pois o DAO cria e manipula objetos Bebida.

use Model\Bebida; 
// Facilita o uso da classe sem precisar escrever Model\Bebida toda hora.

// ======================================================================
// 🧩 CLASSE BebidaDAO: Responsável por salvar, ler, atualizar e excluir bebidas
// ======================================================================
class BebidaDAO {
    private $bebidas = [];   // Array que guarda os objetos Bebida na memória.
    private $arquivo;        // Caminho do arquivo JSON onde os dados são salvos.

    // 🏗️ Construtor - executa automaticamente ao criar um BebidaDAO.
    // Ele carrega o conteúdo do arquivo JSON e transforma em objetos Bebida.
    public function __construct(?string $arquivo = null) {
        // Se não for passado um arquivo, usa o padrão "../bebidas.json"
        $this->arquivo = $arquivo ?? __DIR__ . '/../bebidas.json';

        // Atualiza o cache de informações sobre o arquivo, evitando erros antigos
        clearstatcache(true, $this->arquivo);

        // 🔧 Garante que o diretório onde o arquivo será salvo exista
        $dir = dirname($this->arquivo);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true); // Cria diretórios faltantes, se necessário
        }

        // 🔧 Garante que o arquivo JSON exista
        if (!file_exists($this->arquivo)) {
            // Cria um arquivo JSON vazio com um array []
            @file_put_contents($this->arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        // Lê o conteúdo do arquivo JSON
        $conteudo = @file_get_contents($this->arquivo);
        $dados = json_decode($conteudo, true); // Decodifica JSON → array PHP

        // Se o JSON for válido e for um array, cria objetos Bebida com os dados
        if (json_last_error() === JSON_ERROR_NONE && is_array($dados)) {
            foreach ($dados as $nome => $info) {
                $this->bebidas[$nome] = new Bebida(
                    $info['nome'] ?? $nome,
                    $info['categoria'] ?? '',
                    $info['volume'] ?? '',
                    isset($info['valor']) ? (float)$info['valor'] : 0.0,
                    isset($info['qtde']) ? (int)$info['qtde'] : 0
                );
            }
        }
    }

    // ===========================================================
    // 💾 SALVAR: grava as bebidas no arquivo JSON
    // ===========================================================
    private function salvarEmArquivo(): bool {
        $dados = [];

        // Converte cada objeto Bebida em um array associativo simples
        foreach ($this->bebidas as $nome => $bebida) {
            $dados[$nome] = [
                'nome' => $bebida->getNome(),
                'categoria' => $bebida->getCategoria(),
                'volume' => $bebida->getVolume(),
                'valor' => $bebida->getValor(),
                'qtde' => $bebida->getQtde(),
            ];
        }

        // Transforma o array em texto JSON formatado
        $json = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // Se der erro ao converter para JSON, retorna false
        if ($json === false) {
            return false;
        }

        // Escreve o JSON no arquivo (com trava de escrita)
        $result = @file_put_contents($this->arquivo, $json, LOCK_EX);

        // Retorna true se conseguiu salvar, false se falhou
        return $result !== false;
    }

    // ===========================================================
    // ➕ CRIAR: adiciona (ou substitui) uma bebida
    // ===========================================================
    public function criarBebida(Bebida $bebida): bool {
        $chave = $bebida->getNome(); // Usa o nome como chave única
        $this->bebidas[$chave] = $bebida; // Adiciona ao array de bebidas
        return $this->salvarEmArquivo(); // Salva no JSON
    }

    // ===========================================================
    // 📖 LER: retorna todas as bebidas (em forma de objetos)
    // ===========================================================
    public function lerBebidas(): array {
        return $this->bebidas;
    }


    // ===========================================================
    // ❌ EXCLUIR: remove uma bebida do arquivo
    // ===========================================================
    public function excluirBebida($nome): bool {
        if (!isset($this->bebidas[$nome])) {
            return false; // Não existe, então não tem o que excluir
        }

        unset($this->bebidas[$nome]); // Remove do array
        return $this->salvarEmArquivo(); // Atualiza o arquivo JSON
    }


     // ===========================================================
    // ✏️ ATUALIZAR: muda o valor e quantidade de uma bebida existente
    // ===========================================================
   
    public function editarBebida($nome, $categoria, $volume, $valor, $qtde):bool {
        if (isset($this->bebidas[$nome])) {
            $this->bebidas[$nome]->setNome($nome);
            $this->bebidas[$categoria]->setCategoria($categoria);
            $this->bebidas[$volume]->setVolume($volume);
            $this->bebidas[$valor]->setValor($valor);
            $this->bebidas[$qtde]->setQtde($qtde);
            return true; // Não existe, então não tem o que editar
        }

        
    return $this->salvarEmArquivo(); // Atualiza o arquivo JSON
    
        
    }
}


