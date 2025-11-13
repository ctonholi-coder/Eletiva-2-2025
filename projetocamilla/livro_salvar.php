<?php
include 'conexao.php'; // Inclui o $pdo

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coleta os dados do formulário
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $editora = $_POST['editora'];
    $isbn = $_POST['isbn'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $quantidade_disponivel = $_POST['quantidade_disponivel'];
    
    // Pega o array de autores. Se nenhum for enviado, usa um array vazio
    $autores = $_POST['autores'] ?? [];

    // Validação básica
    if (empty($titulo) || empty($autores)) {
        die("Erro: Título e pelo menos um Autor são obrigatórios.");
    }

    try {
        // *** INICIA A TRANSAÇÃO ***
        // Isso garante que todas as operações funcionem, ou nenhuma delas.
        $pdo->beginTransaction();

        $livro_id = $id;

        // Se o ID estiver vazio, é um INSERT (novo livro)
        if (empty($id)) {
            $sql_livro = "INSERT INTO livro (titulo, editora, isbn, ano_publicacao, quantidade_disponivel) 
                          VALUES (?, ?, ?, ?, ?)";
            $stmt_livro = $pdo->prepare($sql_livro);
            $stmt_livro->execute([$titulo, $editora, $isbn, $ano_publicacao, $quantidade_disponivel]);
            
            // Pega o ID do livro que acabamos de inserir
            $livro_id = $pdo->lastInsertId();
        } 
        // Se o ID existir, é um UPDATE (edição de livro)
        else {
            $sql_livro = "UPDATE livro SET titulo = ?, editora = ?, isbn = ?, ano_publicacao = ?, quantidade_disponivel = ? 
                          WHERE id = ?";
            $stmt_livro = $pdo->prepare($sql_livro);
            $stmt_livro->execute([$titulo, $editora, $isbn, $ano_publicacao, $quantidade_disponivel, $id]);

            // ANTES de inserir os novos autores, apagamos todas as relações antigas
            $stmt_apagar_autores = $pdo->prepare("DELETE FROM livro_autor WHERE livro_id = ?");
            $stmt_apagar_autores->execute([$livro_id]);
        }

        // --- Insere as relações na tabela livro_autor ---
        $sql_livro_autor = "INSERT INTO livro_autor (livro_id, autor_id) VALUES (?, ?)";
        $stmt_livro_autor = $pdo->prepare($sql_livro_autor);

        foreach ($autores as $autor_id) {
            $stmt_livro_autor->execute([$livro_id, $autor_id]);
        }

        // *** CONFIRMA A TRANSAÇÃO ***
        // Se tudo deu certo até aqui, confirma as mudanças
        $pdo->commit();

        // Redireciona para a página de listagem
        header("Location: livros_listar.php");
        exit();

    } catch (Exception $e) {
        // *** DESFAZ A TRANSAÇÃO ***
        // Se algo deu errado, desfaz tudo
        $pdo->rollBack();
        die("Erro ao salvar o livro: " . $e->getMessage());
    }

    $pdo = null; // Fecha a conexão

} else {
    header("Location: livros_listar.php");
    exit();
}
?>