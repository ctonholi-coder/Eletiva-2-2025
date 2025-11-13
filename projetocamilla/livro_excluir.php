<?php
include 'conexao.php'; // Inclui o $pdo

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Prepara e executa o comando de exclusão
        $sql = "DELETE FROM livro WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        // (O banco de dados irá apagar as relações em 'livro_autor' automaticamente)

        // Redireciona de volta para a lista
        header("Location: livros_listar.php");
        exit();

    } catch (Exception $e) {
        // Se o livro estiver em um empréstimo, o banco não deixará excluir (Erro 23000)
        if ($e->getCode() == '23000') {
             die("Erro: Não é possível excluir este livro, pois ele está associado a um empréstimo ativo. <br><br><a href='livros_listar.php'>Voltar</a>");
        }
        die("Erro ao excluir o livro: " . $e->getMessage());
    }

    $pdo = null;
} else {
    header("Location: livros_listar.php");
    exit();
}
?>