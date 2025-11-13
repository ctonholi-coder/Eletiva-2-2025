<?php
include 'conexao.php'; // Inclui o $pdo

// --- INICIALIZAÇÃO DE VARIÁVEIS ---
$id = '';
$titulo = '';
$isbn = '';
$editora = '';
$ano_publicacao = '';
$quantidade_disponivel = 1; // Padrão
$titulo_pagina = "Cadastrar Novo Livro";

// Array para guardar os IDs dos autores selecionados
$autores_selecionados_ids = []; 

// --- BUSCAR TODOS OS AUTORES (para o <select>) ---
$stmt_autores = $pdo->query("SELECT id, nome FROM autor ORDER BY nome");
$todos_autores = $stmt_autores->fetchAll(PDO::FETCH_ASSOC);


// --- MODO DE EDIÇÃO (se o ID for passado) ---
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $titulo_pagina = "Editar Livro";

    // 1. Busca os dados do LIVRO
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

    // 2. Busca os IDs dos autores JÁ ASSOCIADOS a este livro
    $stmt_autores_livro = $pdo->prepare("SELECT autor_id FROM livro_autor WHERE livro_id = ?");
    $stmt_autores_livro->execute([$id]);
    // fetchAll(PDO::FETCH_COLUMN) pega só a primeira coluna (autor_id)
    $autores_selecionados_ids = $stmt_autores_livro->fetchAll(PDO::FETCH_COLUMN);
}

$pdo = null; // Fecha a conexão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo_pagina; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 600px; }
        label, input, select { display: block; margin-bottom: 10px; width: 100%; }
        input[type="submit"] { width: auto; padding: 10px 20px; cursor: pointer; }
        /* Estilo para o select múltiplo */
        select[multiple] { height: 150px; }
    </style>
</head>
<body>

    <h2><?php echo $titulo_pagina; ?></h2>

    <form action="livro_salvar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required>

        <label for="autores">Autores (Segure 'Ctrl' ou 'Cmd' para selecionar vários):</label>
        <select id="autores" name="autores[]" multiple required>
            <?php
            foreach ($todos_autores as $autor) {
                // Verifica se o ID deste autor está no array de selecionados
                $selecionado = in_array($autor['id'], $autores_selecionados_ids) ? 'selected' : '';
                echo "<option value='" . $autor['id'] . "' $selecionado>" . htmlspecialchars($autor['nome']) . "</option>";
            }
            ?>
        </select>
        <label for="editora">Editora:</label>
        <input type="text" id="editora" name="editora" value="<?php echo htmlspecialchars($editora); ?>">

        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($isbn); ?>">
        
        <label for="ano_publicacao">Ano de Publicação:</label>
        <input type="number" id="ano_publicacao" name="ano_publicacao" value="<?php echo htmlspecialchars($ano_publicacao); ?>">
        
        <label for="quantidade_disponivel">Quantidade Disponível:</label>
        <input type="number" id="quantidade_disponivel" name="quantidade_disponivel" value="<?php echo htmlspecialchars($quantidade_disponivel); ?>" required min="0">

        <input type="submit" value="<?php echo ($id) ? 'Atualizar' : 'Cadastrar'; ?>">
    </form>
    <br>
    <a href="livros_listar.php">Voltar para a Lista</a>

</body>
</html>