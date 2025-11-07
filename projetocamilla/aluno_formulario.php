<?php
include 'conexao.php'; // Inclui o $pdo

// Inicializa as variáveis
$id = '';
$nome = '';
$email = '';
$matricula = '';
$telefone = '';
$titulo_pagina = "Cadastrar Novo Aluno";
$action = "aluno_salvar.php";

// Verifica se o ID foi passado na URL (modo de edição)
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $titulo_pagina = "Editar Aluno";

    // Busca os dados do aluno no banco
    $stmt = $pdo->prepare("SELECT * FROM aluno WHERE id = ?");
    $stmt->execute([$id]); // Passa o ID como um array para o execute
    
    if ($stmt->rowCount() > 0) {
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC); // Pega o primeiro resultado
        $nome = $aluno['nome'];
        $email = $aluno['email'];
        $matricula = $aluno['matricula'];
        $telefone = $aluno['telefone'];
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

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" value="<?php echo htmlspecialchars($matricula); ?>" required>
        
        <label for="telefone">Telefone (opcional):</label>
        <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>">

        <input type="submit" value="<?php echo ($id) ? 'Atualizar' : 'Cadastrar'; ?>">
    </form>
    <br>
    <a href="alunos_listar.php">Voltar para a Lista</a>

</body>
</html>