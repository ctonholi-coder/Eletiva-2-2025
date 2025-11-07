<?php
include 'conexao.php'; // Inclui o $pdo

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coleta os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $matricula = $_POST['matricula'];
    $telefone = $_POST['telefone'];

    try {
        // Se o ID estiver vazio, é um INSERT (novo aluno)
        if (empty($id)) {
            $sql = "INSERT INTO aluno (nome, email, matricula, telefone) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            // Passa os valores em um array para o execute
            $stmt->execute([$nome, $email, $matricula, $telefone]);
        } 
        // Se o ID existir, é um UPDATE (edição de aluno)
        else {
            $sql = "UPDATE aluno SET nome = ?, email = ?, matricula = ?, telefone = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            // A ordem no array deve ser a mesma dos '?'
            $stmt->execute([$nome, $email, $matricula, $telefone, $id]);
        }

        // Redireciona para a página de listagem
        header("Location: alunos_listar.php");
        exit();

    } catch (Exception $e) {
        // Em caso de erro, exibe a mensagem
        die("Erro ao salvar o aluno: " . $e->getMessage());
    }

    $pdo = null; // Fecha a conexão

} else {
    header("Location: alunos_listar.php");
    exit();
}
?>