<?php
// Inclui o cabeçalho (já contém <html>, <head>, <body>, CSS, JS e o menu)
require("cabecalho.php");
?>

<h2>Gerenciamento de Autores</h2>

<a href="autor_formulario.php" class="btn btn-primary mb-3">Cadastrar Novo Autor</a>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th style="width: 200px;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'conexao.php';

        $sql = "SELECT id, nome FROM autor ORDER BY nome";
        $stmt = $pdo->query($sql);

        if ($stmt->rowCount() > 0) {

            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $autor) {

                echo "<tr>";
                echo "<td>" . htmlspecialchars($autor['id']) . "</td>";
                echo "<td>" . htmlspecialchars($autor['nome']) . "</td>";
                echo "<td>";
                echo "<a href='autor_formulario.php?id={$autor['id']}' class='btn btn-secondary btn-sm'>Editar</a> ";
                echo "<a href='autor_excluir.php?id={$autor['id']}' 
                        onclick='return confirm(\"Tem certeza que deseja excluir este autor?\")'
                        class='btn btn-danger btn-sm'>
                        Excluir
                      </a>";
                echo "</td>";
                echo "</tr>";

            }
        } else {
            echo "<tr><td colspan='3'>Nenhum autor cadastrado.</td></tr>";
        }

        $pdo = null;
        ?>
    </tbody>
</table>

<?php
// Inclui o rodapé (fecha </body> e </html>)
require("rodape.php");
?>
