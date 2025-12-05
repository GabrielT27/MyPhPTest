    <?php
    require_once __DIR__ . "/livrosController.php";



    $controller = new LivrosController();
    $mensagem = '';
    $tipoMensagem = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            if ($_POST['acao'] === 'salvar') {
                $controller->criar(
                    $_POST['nome'],
                    $_POST['descricao'],
                    $_POST['qntde'],
                    $_POST['local'],
                    $_POST['autor'],
                    $_POST['ano'],
                    $_POST['genero']
                );
                $mensagem = 'Livro cadastrado com sucesso!';
                $tipoMensagem = 'sucesso';
                
            } elseif ($_POST['acao'] === 'deletar') {
                $controller->excluir($_POST['id_livro']);
                $mensagem = 'Livro excluído com sucesso!';
                $tipoMensagem = 'sucesso';
                
            } elseif ($_POST['acao'] === 'atualizar') {
                $controller->atualizar(
                    $_POST['id_livro'],
                    $_POST['nome'],
                    $_POST['descricao'],
                    $_POST['qntde'],
                    $_POST['local'],
                    $_POST['autor'],
                    $_POST['ano'],
                    $_POST['genero']
                );
                $mensagem = 'Livro atualizado com sucesso!';
                $tipoMensagem = 'sucesso';
            }
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
            $tipoMensagem = 'erro';
        }
    }

    // Lista todos os livros
    $livros = $controller->ler();
    ?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Biblioteca SENAI</title>
        <style>
            /* Reset e configurações básicas */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body { 
                font-family: 'Segoe UI', Arial, sans-serif; 
                background-color: #f5f5f5;
                color: #333;
                line-height: 1.6;
            }
            
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }
            
            /* Cabeçalho no estilo SENAI */
            .header {
                background: linear-gradient(to right, #d40000, #a80000);
                color: white;
                padding: 20px 0;
                margin-bottom: 30px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            }
            
            .header h1 {
                text-align: center;
                font-size: 28px;
                font-weight: 600;
            }
            
            /* Mensagens de feedback */
            .mensagem {
                padding: 12px 15px;
                margin-bottom: 20px;
                border-radius: 4px;
                font-weight: 500;
            }
            
            .mensagem.sucesso { 
                background-color: #e8f5e9; 
                color: #2e7d32;
                border-left: 4px solid #2e7d32;
            }
            
            .mensagem.erro { 
                background-color: #ffebee; 
                color: #c62828;
                border-left: 4px solid #c62828;
            }
            
            /* Formulário de cadastro */
            .form-section {
                background: white;
                padding: 25px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                margin-bottom: 30px;
            }
            
            .form-section h2 {
                color: #d40000;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 2px solid #f0f0f0;
            }
            
            .form-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 15px;
            }
            
            .form-grid input {
                width: 100%;
                padding: 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 16px;
                transition: border 0.3s;
            }
            
            .form-grid input:focus {
                border-color: #d40000;
                outline: none;
                box-shadow: 0 0 0 2px rgba(212, 0, 0, 0.2);
            }
            
            /* Botões */
            button, .btn {
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-weight: 600;
                transition: all 0.3s;
                font-size: 15px;
            }
            
            .btn-primary {
                background-color: #d40000;
                color: white;
            }
            
            .btn-primary:hover {
                background-color: #a80000;
            }
            
            .btn-secondary {
                background-color: #333;
                color: white;
            }
            
            .btn-secondary:hover {
                background-color: #000;
            }
            
            .btn-danger {
                background-color: #c62828;
                color: white;
            }
            
            .btn-danger:hover {
                background-color: #b71c1c;
            }
            
            /* Tabela de livros */
            .table-section {
                background: white;
                padding: 25px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                overflow-x: auto;
            }
            
            .table-section h2 {
                color: #d40000;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 2px solid #f0f0f0;
            }
            
            table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 10px;
            }
            
            th {
                background-color: #d40000;
                color: white;
                text-align: left;
                padding: 12px 15px;
                font-weight: 600;
            }
            
            td {
                padding: 12px 15px;
                border-bottom: 1px solid #eee;
            }
            
            tr:hover {
                background-color: #f9f9f9;
            }
            
            .acoes {
                display: flex;
                gap: 8px;
            }
            
            .acoes button {
                padding: 8px 12px;
                font-size: 14px;
            }
            
            /* Modal de edição */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.5);
            }
            
            .modal-content {
                background: #fff;
                margin: 5% auto;
                padding: 30px;
                width: 90%;
                max-width: 600px;
                border-radius: 8px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                position: relative;
            }
            
            .close {
                position: absolute;
                right: 20px;
                top: 15px;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
                color: #777;
            }
            
            .close:hover {
                color: #d40000;
            }
            
            .modal h2 {
                color: #d40000;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 2px solid #f0f0f0;
            }
            
            .modal form {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }
            
            .modal input {
                width: 100%;
                padding: 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 16px;
            }
            
            .modal input:focus {
                border-color: #d40000;
                outline: none;
            }
            
            .modal button {
                grid-column: span 2;
            }
            
            /* Mensagem quando não há livros */
            .sem-livros {
                text-align: center;
                padding: 40px;
                color: #666;
                font-style: italic;
            }
            
            /* Responsividade */
            @media (max-width: 768px) {
                .form-grid {
                    grid-template-columns: 1fr;
                }
                
                .modal form {
                    grid-template-columns: 1fr;
                }
                
                .modal button {
                    grid-column: span 1;
                }
                
                .acoes {
                    flex-direction: column;
                }
            }

            /* Estilos específicos para os formulários existentes */
            h1 {
                color: #d40000;
                margin-bottom: 20px;
                text-align: center;
            }

            form {
                background: white;
                padding: 25px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                margin-bottom: 30px;
            }

            form input {
                width: 100%;
                padding: 12px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 16px;
            }

            form input:focus {
                border-color: #d40000;
                outline: none;
                box-shadow: 0 0 0 2px rgba(212, 0, 0, 0.2);
            }

            button.cadastrar {
                background-color: #d40000;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-weight: 600;
                font-size: 16px;
                width: 100%;
            }

            button.cadastrar:hover {
                background-color: #a80000;
            }

            /* CORREÇÃO DO BOTÃO EDITAR */
            button.editar {
                background-color: #ff9800;
                color: white;
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                font-weight: 600;
                transition: background-color 0.3s;
            }

            button.editar:hover {
                background-color: #f57c00;
            }

            button.excluir {
                background-color: #c62828;
                color: white;
                padding: 8px 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                font-weight: 600;
                transition: background-color 0.3s;
            }

            button.excluir:hover {
                background-color: #b71c1c;
            }

            /* Estilo para os formulários inline na tabela */
            form[style*="display:inline"] {
                display: inline;
                background: none;
                padding: 0;
                box-shadow: none;
                margin: 0;
            }

            .acoes-form {
                display: flex;
                gap: 8px;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- MENSAGENS -->
            <?php if ($mensagem): ?>
            <div class="mensagem <?php echo $tipoMensagem; ?>">
                <?php echo $mensagem; ?>
            </div>
            <?php endif; ?>

            <!-- FORMULÁRIO DE CADASTRO -->
            <h1>Cadastro de Livros</h1>
            <form method="POST">
                <input type="hidden" name="acao" value="salvar">
                <input type="text" name="nome" placeholder="Nome do livro" required>
                <input type="text" name="descricao" placeholder="Descrição do livro" required>
                <input type="number" name="qntde" placeholder="Quantidade em estoque" required>
                <input type="text" name="local" placeholder="Local na biblioteca" required>
                <input type="text" name="autor" placeholder="Autor" required>
                <input type="date" name="ano" required>
                <input type="text" name="genero" placeholder="Gênero literário" required>
                <button type="submit" class="cadastrar">Cadastrar</button>
            </form>

            <!-- LISTAGEM DE LIVROS -->
            <h2>Livros Cadastrados</h2>
            <?php if ($livros): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Local</th>
                        <th>Autor</th>
                        <th>Ano</th>
                        <th>Gênero</th>
                        <th>Ações</th>
                    </tr>
                    <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?php echo $livro->getIdLivro(); ?></td>
                        <td><?php echo $livro->getNomeLivro(); ?></td>
                        <td><?php echo $livro->getDescricaoLivro(); ?></td>
                        <td><?php echo $livro->getQntde(); ?></td>
                        <td><?php echo $livro->getLocal(); ?></td>
                        <td><?php echo $livro->getAutor(); ?></td>
                        <td><?php echo $livro->getAno(); ?></td>
                        <td><?php echo $livro->getGenero(); ?></td>
                        <td>
                            <div class="acoes-form">
                                <button type="button" class="editar"
                                    data-id="<?php echo $livro->getIdLivro(); ?>"
                                    data-nome="<?php echo htmlspecialchars($livro->getNomeLivro(), ENT_QUOTES); ?>"
                                    data-descricao="<?php echo htmlspecialchars($livro->getDescricaoLivro(), ENT_QUOTES); ?>"
                                    data-qntde="<?php echo $livro->getQntde(); ?>"
                                    data-local="<?php echo htmlspecialchars($livro->getLocal(), ENT_QUOTES); ?>"
                                    data-autor="<?php echo htmlspecialchars($livro->getAutor(), ENT_QUOTES); ?>"
                                    data-ano="<?php echo $livro->getAno(); ?>"
                                    data-genero="<?php echo htmlspecialchars($livro->getGenero(), ENT_QUOTES); ?>"
                                    onclick="abrirModalFromButton(this)">Editar</button>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="acao" value="deletar">
                                    <input type="hidden" name="id_livro" value="<?php echo $livro->getIdLivro(); ?>">
                                    <button type="submit" class="excluir" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Nenhum livro cadastrado.</p>
            <?php endif; ?>
        </div>

                <!-- MODAL DE EDIÇÃO -->
                <div id="modalEditar" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="fecharModal()">&times;</span>
                        <h2>Editar Livro</h2>
                        <form method="POST">
                            <input type="hidden" name="acao" value="atualizar">
                            <input type="hidden" id="edit_id" name="id_livro">
                            <input type="text" id="edit_nome" name="nome" placeholder="Nome do livro" required>
                            <input type="text" id="edit_descricao" name="descricao" placeholder="Descrição" required>
                            <input type="number" id="edit_qntde" name="qntde" placeholder="Quantidade" required>
                            <input type="text" id="edit_local" name="local" placeholder="Local" required>
                            <input type="text" id="edit_autor" name="autor" placeholder="Autor" required>
                            <input type="date" id="edit_ano" name="ano" required>
                            <input type="text" id="edit_genero" name="genero" placeholder="Gênero" required>
                            <button type="submit" class="cadastrar">Salvar Alterações</button>
                        </form>
                    </div>
                </div>

                <script>
                                function abrirModalFromButton(btn) {
                                    var d = btn.dataset;
                                    document.getElementById('edit_id').value = d.id || '';
                                    document.getElementById('edit_nome').value = d.nome || '';
                                    document.getElementById('edit_descricao').value = d.descricao || '';
                                    document.getElementById('edit_qntde').value = d.qntde || '';
                                    document.getElementById('edit_local').value = d.local || '';
                                    document.getElementById('edit_autor').value = d.autor || '';
                                    document.getElementById('edit_ano').value = d.ano || '';
                                    document.getElementById('edit_genero').value = d.genero || '';
                                    document.getElementById('modalEditar').style.display = 'block';
                                }

                    function abrirModal(id, nome, descricao, qntde, local, autor, ano, genero) {
                        document.getElementById('edit_id').value = id;
                        document.getElementById('edit_nome').value = nome;
                        document.getElementById('edit_descricao').value = descricao;
                        document.getElementById('edit_qntde').value = qntde;
                        document.getElementById('edit_local').value = local;
                        document.getElementById('edit_autor').value = autor;
                        document.getElementById('edit_ano').value = ano;
                        document.getElementById('edit_genero').value = genero;
                        document.getElementById('modalEditar').style.display = 'block';
                    }
                    
                    function fecharModal() {
                        document.getElementById('modalEditar').style.display = 'none';
                    }

                    // Fechar modal clicando fora dele
                    window.onclick = function(event) {
                        var modal = document.getElementById('modalEditar');
                        if (event.target == modal) {
                            fecharModal();
                        }
                    }
                </script>
    </body>
    </html>