<?php
include 'conexao.php'; // Inclui o $pdo

// Inicializa as variáveis
$id = '';
$nome = '';
$titulo_pagina = "Cadastrar Novo Autor";
$action = "autor_salvar.php";

// Verifica se o ID foi passado na URL (modo de edição)
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $titulo_pagina = "Editar Autor";

    // Busca os dados do autor no banco
    $stmt = $pdo->prepare("SELECT * FROM autor WHERE id = ?");
    $stmt->execute([$id]);
    
    if ($stmt->rowCount() > 0) {
        $autor = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $autor['nome'];
    }
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
        form { max-width: 500px; }
        label, input { display: block; margin-bottom: 10px; width: 100%; }
        input[type="submit"] { width: auto; padding: 10px 20px; cursor: pointer; }
    </style>
</head>
<body>

    <h2><?php echo $titulo_pagina; ?></h2>

    <form action="<?php echo $action; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <label for="nome">Nome do Autor:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

        <input type="submit" value="<?php echo ($id) ? 'Atualizar' : 'Cadastrar'; ?>">
    </form>
    <br>
    <a href="autores_listar.php">Voltar para a Lista</a>

</body>
</html>