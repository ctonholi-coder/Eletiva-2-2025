<?php
// Inclui o cabeçalho (que já contém <html>, <head>, <body> e o menu)
require("cabecalho.php");
?>

<h2>Gerenciamento de Alunos</h2>

<a href="aluno_formulario.php" class="btn btn-primary mb-3">Cadastrar Novo Aluno</a>

<table class="table table-striped table-bordered">
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
        include 'conexao.php';

        $sql = "SELECT id, nome, email, matricula FROM aluno ORDER BY nome";
        $stmt = $pdo->query($sql);

        if ($stmt->rowCount() > 0) {
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $aluno) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($aluno['id']) . "</td>";
                echo "<td>" . htmlspecialchars($aluno['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($aluno['email']) . "</td>";
                echo "<td>" . htmlspecialchars($aluno['matricula']) . "</td>";
                echo "<td>";
                echo "<a href='aluno_formulario.php?id={$aluno['id']}' class='btn btn-secondary btn-sm'>Editar</a> ";
                echo "<a href='aluno_excluir.php?id={$aluno['id']}' class='btn btn-danger btn-sm'
                        onclick='return confirm(\"Tem certeza que deseja excluir este aluno?\")'>
                        Excluir
                      </a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum aluno cadastrado.</td></tr>";
        }

        $pdo = null;
        ?>
    </tbody>
</table>

<?php
// Inclui o rodapé (fecha </body> e </html>)
require("rodape.php");
?>
