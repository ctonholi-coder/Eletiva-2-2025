<?php
include 'conexao.php'; // Inclui o $pdo

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coleta os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    try {
        // Se o ID estiver vazio, é um INSERT (novo autor)
        if (empty($id)) {
            $sql = "INSERT INTO autor (nome) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome]);
        } 
        // Se o ID existir, é um UPDATE (edição de autor)
        else {
            $sql = "UPDATE autor SET nome = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $id]);
        }

        // Redireciona para a página de listagem
        header("Location: autores_listar.php");
        exit();

    } catch (Exception $e) {
        die("Erro ao salvar o autor: " . $e->getMessage());
    }

    $pdo = null; // Fecha a conexão

} else {
    header("Location: autores_listar.php");
    exit();
}
?>