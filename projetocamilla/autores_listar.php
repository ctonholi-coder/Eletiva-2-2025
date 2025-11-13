<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Autores</title>
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

    <h2>Gerenciamento de Autores</h2>

    <a href="autor_formulario.php" class="btn top-link">Cadastrar Novo Autor</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 1. Incluir a conexão (provê a variável $pdo)
            include 'conexao.php';

            // 2. Criar e executar o comando SQL
            $sql = "SELECT id, nome FROM autor ORDER BY nome";
            $stmt = $pdo->query($sql);

            // 3. Exibir os resultados
            if ($stmt->rowCount() > 0) {
                $autores = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($autores as $autor) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($autor['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($autor['nome']) . "</td>";
                    echo "<td class='action-links'>";
                    // Link para editar
                    echo "<a href='autor_formulario.php?id=" . $autor['id'] . "'>Editar</a>";
                    // Link para excluir
                    echo "<a href='autor_excluir.php?id=" . $autor['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este autor?\")' class='btn-delete'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhum autor cadastrado.</td></tr>";
            }
            
            $pdo = null; // Fechar conexão
            ?>
        </tbody>
    </table>

</body>
</html>