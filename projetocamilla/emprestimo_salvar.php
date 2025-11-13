<?php
include 'conexao.php'; // Inclui o $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coleta os dados
    $aluno_id = (int)$_POST['aluno_id'];
    $livro_id = (int)$_POST['livro_id'];
    $data_devolucao_prevista = $_POST['data_devolucao_prevista'];

    // Validação básica
    if (empty($aluno_id) || empty($livro_id) || empty($data_devolucao_prevista)) {
        die("Erro: Todos os campos são obrigatórios. <a href='emprestimo_novo.php'>Voltar</a>");
    }

    try {
        // *** INICIA A TRANSAÇÃO ***
        $pdo->beginTransaction();

        // 1. Verificar se o livro ainda está disponível e diminuir o estoque
        // (Usamos "FOR UPDATE" para "travar" a linha e evitar que duas pessoas peguem o último livro ao mesmo tempo)
        $stmt_check = $pdo->prepare("SELECT quantidade_disponivel FROM livro WHERE id = ? FOR UPDATE");
        $stmt_check->execute([$livro_id]);
        $livro = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($livro && $livro['quantidade_disponivel'] > 0) {
            
            // 2. Diminuir o estoque
            $stmt_update_livro = $pdo->prepare("UPDATE livro SET quantidade_disponivel = quantidade_disponivel - 1 WHERE id = ?");
            $stmt_update_livro->execute([$livro_id]);

            // 3. Inserir o registro de empréstimo
            $sql_emprestimo = "INSERT INTO emprestimo (aluno_id, livro_id, data_devolucao_prevista) VALUES (?, ?, ?)";
            $stmt_emprestimo = $pdo->prepare($sql_emprestimo);
            $stmt_emprestimo->execute([$aluno_id, $livro_id, $data_devolucao_prevista]);

            // *** CONFIRMA A TRANSAÇÃO ***
            $pdo->commit();
            
            header("Location: emprestimos_listar.php");
            exit();

        } else {
            // Se o livro não tiver estoque (ou não existir)
            $pdo->rollBack();
            die("Erro: O livro selecionado não está mais disponível no estoque. <a href='emprestimo_novo.php'>Voltar</a>");
        }

    } catch (Exception $e) {
        // *** DESFAZ A TRANSAÇÃO ***
        $pdo->rollBack();
        die("Erro ao registrar o empréstimo: " . $e->getMessage());
    }

    $pdo = null;

} else {
    header("Location: emprestimos_listar.php");
    exit();
}
?>