<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
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

    <h2>Gerenciamento de Alunos</h2>

    <a href="aluno_formulario.php" class="btn top-link">Cadastrar Novo Aluno</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Matrícula</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // 1. Incluir a conexão (agora provê a variável $pdo)
            include 'conexao.php';

            // 2. Criar o comando SQL
            $sql = "SELECT id, nome, email, matricula FROM aluno ORDER BY nome";

            // 3. Executar o comando com PDO
            $stmt = $pdo->query($sql);

            // 4. Exibir os resultados
            if ($stmt->rowCount() > 0) {
                // fetchAll() pega todos os resultados como um array
                $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($alunos as $aluno) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($aluno['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($aluno['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($aluno['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($aluno['matricula']) . "</td>";
                    echo "<td class='action-links'>";
                    // Link para editar
                    echo "<a href='aluno_formulario.php?id=" . $aluno['id'] . "'>Editar</a>";
                    // Link para excluir
                    echo "<a href='aluno_excluir.php?id=" . $aluno['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este aluno?\")' class='btn-delete'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum aluno cadastrado.</td></tr>";
            }
            
            // 5. Fechar a conexão (em PDO, é feito definindo como null)
            $pdo = null;
            ?>
        </tbody>
    </table>

</body>
</html>