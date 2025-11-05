<?php 

require_once "../model/bebidasCRUD.php";
require_once "../model/bebidasDAO.php"; // Inclui arquivos PHP necessários

// Objeto da classe BebidasDAO para gerenciar os métodos do CRUD 
$dao = new BebidasDAO();

// CREATE - Criar algumas bebidas de exemplo
$dao->criarBebida("001", "Coca-Cola", "Refrigerante", "2L", 8.99, 50);
$dao->criarBebida("002", "Guaraná Antarctica", "Refrigerante", "1L", 6.99, 40);
$dao->criarBebida("003", "Água Mineral", "Água", "500ml", 2.50, 100);

// READ - Listar todas as bebidas
echo "\nListagem Inicial:\n";
echo "--------------------------------\n";
foreach ($dao->lerTodos() as $codigo => $bebida) {
    echo "Código: {$codigo}\n";
    echo "Nome: {$bebida->getNome()}\n";
    echo "Categoria: {$bebida->getCategoria()}\n";
    echo "Volume: {$bebida->getVolume()}\n";
    echo "Valor: R$ {$bebida->getValor()}\n";
    echo "Quantidade: {$bebida->getQtde()}\n";
    echo "--------------------------------\n";
}

// UPDATE - Atualizar uma bebida
$dao->atualizar("003", "Água Crystal", "Água", "500ml", 2.75, 95);

echo "\nApós Atualização:\n";
echo "--------------------------------\n";
foreach ($dao->lerTodos() as $codigo => $bebida) {
    echo "Código: {$codigo}\n";
    echo "Nome: {$bebida->getNome()}\n";
    echo "Categoria: {$bebida->getCategoria()}\n";
    echo "Volume: {$bebida->getVolume()}\n";
    echo "Valor: R$ {$bebida->getValor()}\n";
    echo "Quantidade: {$bebida->getQtde()}\n";
    echo "--------------------------------\n";
}

// DELETE - Excluir uma bebida
$dao->excluir("002");

echo "\nApós Exclusão:\n";
echo "--------------------------------\n";
foreach ($dao->lerTodos() as $codigo => $bebida) {
    echo "Código: {$codigo}\n";
    echo "Nome: {$bebida->getNome()}\n";
    echo "Categoria: {$bebida->getCategoria()}\n";
    echo "Volume: {$bebida->getVolume()}\n";
    echo "Valor: R$ {$bebida->getValor()}\n";
    echo "Quantidade: {$bebida->getQtde()}\n";
    echo "--------------------------------\n";
}

// Exemplo de busca por categoria
echo "\nBebidas da categoria 'Refrigerante':\n";
echo "--------------------------------\n";
$refrigerantes = $dao->buscarPorCategoria("Refrigerante");
foreach ($refrigerantes as $codigo => $bebida) {
    echo "Código: {$codigo}\n";
    echo "Nome: {$bebida->getNome()}\n";
    echo "Volume: {$bebida->getVolume()}\n";
    echo "Valor: R$ {$bebida->getValor()}\n";
    echo "Quantidade: {$bebida->getQtde()}\n";
    echo "--------------------------------\n";
}
