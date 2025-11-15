<?php

require("cabecalho.php");
include 'conexao.php'; 


$id = '';
$titulo = '';
$isbn = '';
$editora = '';
$ano_publicacao = '';
$quantidade_disponivel = 1; 
$titulo_pagina = "Cadastrar Novo Livro";

$autores_selecionados_ids = []; 


$stmt_autores = $pdo->query("SELECT id, nome FROM autor ORDER BY nome");
$todos_autores = $stmt_autores->fetchAll(PDO::FETCH_ASSOC);



if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $titulo_pagina = "Editar Livro";


    $stmt_livro = $pdo->prepare("SELECT * FROM livro WHERE id = ?");
    $stmt_livro->execute([$id]);
    
    if ($stmt_livro->rowCount() > 0) {
        $livro = $stmt_livro->fetch(PDO::FETCH_ASSOC);
        $titulo = $livro['titulo'];
        $isbn = $livro['isbn'];
        $editora = $livro['editora'];
        $ano_publicacao = $livro['ano_publicacao'];
        $quantidade_disponivel = $livro['quantidade_disponivel'];
    }


    $stmt_autores_livro = $pdo->prepare("SELECT autor_id FROM livro_autor WHERE livro_id = ?");
    $stmt_autores_livro->execute([$id]);
    $autores_selecionados_ids = $stmt_autores_livro->fetchAll(PDO::FETCH_COLUMN);
}

$pdo = null;
?>

<h2><?php echo $titulo_pagina; ?></h2>

<form action="livro_salvar.php" method="POST" class="col-md-8">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

    <div class="mb-3">
        <label for="titulo" class="form-label">Título:</label>
        <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo htmlspecialchars($titulo); ?>" required>
    </div>

    <div class="mb-3">
        <label for="autores" class="form-label">Autores (Segure 'Ctrl' ou 'Cmd' para selecionar vários):</label>
        <select id="autores" name="autores[]" class="form-select" multiple required size="5">
            <?php
            foreach ($todos_autores as $autor) {
                $selecionado = in_array($autor['id'], $autores_selecionados_ids) ? 'selected' : '';
                echo "<option value='" . $autor['id'] . "' $selecionado>" . htmlspecialchars($autor['nome']) . "</option>";
            }
            ?>
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="editora" class="form-label">Editora:</label>
            <input type="text" id="editora" name="editora" class="form-control" value="<?php echo htmlspecialchars($editora); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="isbn" class="form-label">ISBN:</label>
            <input type="text" id="isbn" name="isbn" class="form-control" value="<?php echo htmlspecialchars($isbn); ?>">
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="ano_publicacao" class="form-label">Ano de Publicação:</label>
            <input type="number" id="ano_publicacao" name="ano_publicacao" class="form-control" value="<?php echo htmlspecialchars($ano_publicacao); ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="quantidade_disponivel" class="form-label">Quantidade Disponível:</label>
            <input type="number" id="quantidade_disponivel" name="quantidade_disponivel" class="form-control" value="<?php echo htmlspecialchars($quantidade_disponivel); ?>" required min="0">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        <?php echo ($id) ? 'Atualizar' : 'Cadastrar'; ?>
    </button>
    <a href="livros_listar.php" class="btn btn-secondary">Voltar</a>
</form>

<?php
require("rodape.php");
?>