<?php
// Importa o arquivo do controller que contém a lógica de controle
require_once __DIR__ . '/../controller/bebidaController.php';

// Usa o namespace correto do controller
use Controller\BebidaController;

// Cria uma instância do controller para manipular as bebidas
$controller = new BebidaController();

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se a ação for "criar", chama o método de criação no controller
    if ($_POST['acao'] === 'criar') {
        $controller->criar($_POST['nome'], $_POST['categoria'], $_POST['volume'], $_POST['valor'], $_POST['qtde']);
    } 
    
    elseif ($_POST['acao'] === 'editar') {
        $controller->editar($_POST['nome'], $_POST['categoria'], $_POST['volume'], $_POST['valor'], $_POST['qtde']);
    }

    // Se a ação for "deletar", chama o método de exclusão no controller
    elseif ($_POST['acao'] === 'deletar') {
        $controller->deletar($_POST['nome']);
    }
}

// Obtém a lista atualizada de bebidas do controller
$lista = $controller->ler();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Bebidas</title>
</head>
<body>
<header>🍾 Sistema de Gerenciamento de Bebidas</header>

<main>
    <!-- Formulário de cadastro de nova bebida -->
    <h2>Cadastrar nova bebida</h2>
    <form method="POST">
        <!-- Campo oculto que define a ação como "criar" -->
        <input type="hidden" name="acao" value="criar">

        <!-- Campos do formulário -->
        <input type="text" name="nome" placeholder="Nome da bebida" required>

        <select name="categoria" required>
            <option value="">Categoria</option>
            <option value="Refrigerante">Refrigerante</option>
            <option value="Cerveja">Cerveja</option>
            <option value="Vinho">Vinho</option>
            <option value="Destilado">Destilado</option>
            <option value="Água">Água</option>
            <option value="Suco">Suco</option>
            <option value="Energético">Energético</option>
        </select>

        <input type="text" name="volume" placeholder="Volume (ex: 350ml)" required>
        <input type="number" step="0.01" name="valor" placeholder="Valor (R$)" required>
        <input type="number" name="qtde" placeholder="Quantidade" required>

        <!-- Botão de envio -->
        <button type="submit">Cadastrar</button>
    </form>

    <!-- Tabela de bebidas cadastradas -->
    <h2>Bebidas cadastradas</h2>
    <!-- Corrigido: o atributo border estava errado -->
    <table border."1" cellpadding="5">
        <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Volume</th>
            <th>Valor (R$)</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>

        <!-- Se não houver bebidas, mostra mensagem -->
        <?php if (empty($lista)): ?>
            <tr><td colspan="6">Nenhuma bebida cadastrada ainda.</td></tr>

        <?php else: ?>
            <!-- Percorre a lista de bebidas -->
            <?php foreach ($lista as $bebida): ?>
                <tr>
                    <!-- Exibe cada dado da bebida -->
                    <td><?= htmlspecialchars($bebida->getNome()) ?></td>
                    <td><?= htmlspecialchars($bebida->getCategoria()) ?></td>
                    <td><?= htmlspecialchars($bebida->getVolume()) ?></td>
                    <td><?= number_format($bebida->getValor(), 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($bebida->getQtde()) ?></td>

                    <td>
                        <!-- Formulário para excluir bebida -->
                        <!-- Formulário para EDITAR (atualizar) os dados de uma bebida -->
<form method="POST">
    
    <!-- Campo oculto que indica qual ação o PHP deve executar -->
    <!-- Aqui definimos que essa requisição é do tipo "editar" -->
    <input type="hidden" name="acao" value="editar">

    <!-- Campo oculto com o nome da bebida original -->
    <!-- O nome é usado como "chave" para identificar qual bebida editar -->
    <input type="hidden" name="nome" value="<?= htmlspecialchars($bebida->getNome()) ?>">

    <!-- Campo de texto para editar a categoria da bebida -->
    <!-- O valor inicial vem do que já está cadastrado -->
    <input type="text" 
           name="categoria" 
           value="<?= htmlspecialchars($bebida->getCategoria()) ?>" 
           placeholder="Categoria">

    <!-- Campo de texto para editar o volume (ex: 350ml, 1L, etc.) -->
    <input type="text" 
           name="volume" 
           value="<?= htmlspecialchars($bebida->getVolume()) ?>" 
           placeholder="Volume">

    <!-- Campo numérico para editar o valor (preço) -->
    <!-- step="0.01" permite inserir casas decimais -->
    <input type="number" 
           step="0.01" 
           name="valor" 
           value="<?= htmlspecialchars($bebida->getValor()) ?>" 
           placeholder="Valor (R$)">

    <!-- Campo numérico para editar a quantidade em estoque -->
    <input type="number" 
           name="qtde" 
           value="<?= htmlspecialchars($bebida->getQtde()) ?>" 
           placeholder="Quantidade">

    <!-- Botão que envia o formulário -->
    <!-- Quando clicado, o PHP processa os dados e chama o método editar() -->
    <button type="submit">Salvar</button>
</form>

                    </td>
            </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</main>
</body>
</html>
