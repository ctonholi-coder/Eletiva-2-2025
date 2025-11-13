<?php
include 'conexao.php'; // Inclui o $pdo

if (isset($_GET['id'])) {
    $emprestimo_id = (int)$_GET['id'];

    try {
        // *** INICIA A TRANSAÇÃO ***
        $pdo->beginTransaction();

        // 1. Buscar o ID do livro deste empréstimo
        $stmt_find = $pdo->prepare("SELECT livro_id FROM emprestimo WHERE id = ? AND data_devolucao_real IS NULL");
        $stmt_find->execute([$emprestimo_id]);
        $emprestimo = $stmt_find->fetch(PDO::FETCH_ASSOC);

        if ($emprestimo) {
            $livro_id = $emprestimo['livro_id'];

            // 2. Marcar o empréstimo como devolvido (data/hora atual)
            $stmt_devolver = $pdo->prepare("UPDATE emprestimo SET data_devolucao_real = CURRENT_TIMESTAMP WHERE id = ?");
            $stmt_devolver->execute([$emprestimo_id]);

            // 3. Aumentar o estoque do livro
            $stmt_update_livro = $pdo->prepare("UPDATE livro SET quantidade_disponivel = quantidade_disponivel + 1 WHERE id = ?");
            $stmt_update_livro->execute([$livro_id]);

            // *** CONFIRMA A TRANSAÇÃO ***
            $pdo->commit();

            header("Location: emprestimos_listar.php");
            exit();

        } else {
            // Empréstimo não existe ou já foi devolvido
            $pdo->rollBack();
            die("Erro: Empréstimo não encontrado ou já devolvido. <a href='emprestimos_listar.php'>Voltar</a>");
        }

    } catch (Exception $e) {
        // *** DESFAZ A TRANSAÇÃO ***
        $pdo->rollBack();
        die("Erro ao processar a devolução: " . $e->getMessage());
    }

    $pdo = null;
} else {
    header("Location: emprestimos_listar.php");
    exit();
}
?>