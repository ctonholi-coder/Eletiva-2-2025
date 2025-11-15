<?php
require("cabecalho.php");

include 'conexao.php';

// Inicializa
$id = '';
$nome = '';
$titulo_pagina = "Cadastrar Novo Autor";
$action = "autor_salvar.php";

// Modo edição
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $titulo_pagina = "Editar Autor";

    $stmt = $pdo->prepare("SELECT * FROM autor WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $autor = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $autor['nome'];
    }
}

$pdo = null;
?>

<div class="container mt-4">

    <h2><?php echo $titulo_pagina; ?></h2>

    <form action="<?php echo $action; ?>" method="POST" class="mt-3" style="max-width: 500px;">
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Autor:</label>
            <input 
                type="text" 
                id="nome" 
                name="nome" 
                class="form-control"
                value="<?php echo htmlspecialchars($nome); ?>" 
                required>
        </div>

        <button type="submit" class="btn btn-primary">
            <?php echo ($id ? "Atualizar" : "Cadastrar"); ?>
        </button>

        <a href="autores_listar.php" class="btn btn-secondary ms-2">Voltar</a>
    </form>

</div>

<?php
require("rodape.php");
?>
