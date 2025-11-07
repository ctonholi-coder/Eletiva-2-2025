<?php
include 'conexao.php'; // Inclui o $pdo

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Prepara e executa o comando de exclusão
        $sql = "DELETE FROM aluno WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]); // Passa o ID

        // Redireciona de volta para a lista
        header("Location: alunos_listar.php");
        exit();

    } catch (Exception $e) {
        die("Erro ao excluir o aluno: " . $e->getMessage());
    }

    $pdo = null; // Fecha a conexão
} else {
    header("Location: alunos_listar.php");
    exit();
}
?>