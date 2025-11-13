<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a { text-decoration: none; color: #007bff; }
        a.btn { padding: 5px 10px; border: 1px solid #007bff; border-radius: 4px; }
        a.btn-delete { color: #dc3545; border-color: #dc3545; }
        .action-links a { margin-right: 10px; }
        .top-link { margin-bottom: 20px; display: inline-block; }
    </style>
</head>
<body>

    <h2>Gerenciamento de Livros</h2>

    <a href="livro_formulario.php" class="btn top-link">Cadastrar Novo Livro</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Editora</th>
                <th>ISBN</th>
                <th>Disponíveis</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'conexao.php'; // Inclui o $pdo

            $sql = "SELECT id, titulo, editora, isbn, quantidade_disponivel FROM livro ORDER BY titulo";
            $stmt = $pdo->query($sql);

            if ($stmt->rowCount() > 0) {
                while($livro = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($livro['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($livro['titulo']) . "</td>";
                    echo "<td>" . htmlspecialchars($livro['editora']) . "</td>";
                    echo "<td>" . htmlspecialchars($livro['isbn']) . "</td>";
                    echo "<td>" . htmlspecialchars($livro['quantidade_disponivel']) . "</td>";
                    echo "<td class='action-links'>";
                    echo "<a href='livro_formulario.php?id=" . $livro['id'] . "'>Editar</a>";
                    echo "<a href='livro_excluir.php?id=" . $livro['id'] . "' onclick='return confirm(\"Tem certeza?\")' class='btn-delete'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum livro cadastrado.</td></tr>";
            }
            
            $pdo = null;
            ?>
        </tbody>
    </table>

</body>
</html>