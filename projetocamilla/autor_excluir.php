<?php
include 'conexao.php'; // Inclui o $pdo

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Prepara e executa o comando de exclusão
        $sql = "DELETE FROM autor WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        // Redireciona de volta para a lista
        header("Location: autores_listar.php");
        exit();

    } catch (Exception $e) {
        // Atenção: Se o autor estiver ligado a um livro, o banco pode dar erro
        // (Isso é uma regra de integridade, o que é bom!)
        if ($e->getCode() == '23000') { // Código de erro de integridade (Foreign Key)
             die("Erro: Não é possível excluir este autor pois ele está associado a um ou mais livros.");
        }
        die("Erro ao excluir o autor: " . $e->getMessage());
    }

    $pdo = null; // Fecha a conexão
} else {
    header("Location: autores_listar.php");
    exit();
}
?>