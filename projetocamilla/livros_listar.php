<?php
// Inclui o cabeçalho (já possui <html>, <head>, <body>, menu, CSS, JS)
require("cabecalho.php");
?>

<h2>Gerenciamento de Livros</h2>

<a href="livro_formulario.php" class="btn btn-primary mb-3">Cadastrar Novo Livro</a>

<table class="table table-striped table-bordered">
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
        include 'conexao.php';

        $sql = "SELECT id, titulo, editora, isbn, quantidade_disponivel 
                FROM livro 
                ORDER BY titulo";

        $stmt = $pdo->query($sql);

        if ($stmt->rowCount() > 0) {
            while ($livro = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($livro['id']) . "</td>";
                echo "<td>" . htmlspecialchars($livro['titulo']) . "</td>";
                echo "<td>" . htmlspecialchars($livro['editora']) . "</td>";
                echo "<td>" . htmlspecialchars($livro['isbn']) . "</td>";
                echo "<td>" . htmlspecialchars($livro['quantidade_disponivel']) . "</td>";
                echo "<td>";
                echo "<a href='livro_formulario.php?id={$livro['id']}' class='btn btn-secondary btn-sm'>Editar</a> ";
                echo "<a href='livro_excluir.php?id={$livro['id']}' 
                        onclick='return confirm(\"Tem certeza?\")' 
                        class='btn btn-danger btn-sm'>Excluir</a>";
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

<?php
// Inclui o rodapé (fecha </body> e </html>)
require("rodape.php");
?>
