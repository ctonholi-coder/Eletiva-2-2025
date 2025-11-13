<?php
// 1. Inclui o cabeçalho (ISSO RESOLVE O "LINK DE VOLTA")
require("cabecalho.php");

// 2. Inclui a conexão
include 'conexao.php';

// 3. Prepara a busca
// Pega o termo da busca na URL, se existir. Senão, usa string vazia.
$termo_busca = $_GET['busca'] ?? '';

?>

<h2>Gerenciamento de Empréstimos</h2>

<div class="row mb-3">
    <div class="col-md-6">
        <a href="emprestimo_novo.php" class="btn btn-primary">Registrar Novo Empréstimo</a>
    </div>

    <div class="col-md-6">
        <form action="emprestimos_listar.php" method="GET" class="d-flex">
            <input type="text" class="form-control me-2" name="busca" 
                   placeholder="Buscar por Aluno ou Livro..." 
                   value="<?php echo htmlspecialchars($termo_busca); // Mantém o termo na caixa ?>">
            <button type="submit" class="btn btn-secondary">Buscar</button>
        </form>
    </div>
</div>


<h3>Empréstimos Ativos (Não Devolvidos)</h3>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Livro</th>
            <th>Aluno</th>
            <th>Data Empréstimo</th>
            <th>Previsão Devolução</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // 4. MODIFICAÇÃO NO SQL
        // SQL base
        $sql = "SELECT 
                    e.id, 
                    l.titulo AS livro_titulo, 
                    a.nome AS aluno_nome,
                    e.data_emprestimo,
                    e.data_devolucao_prevista
                FROM emprestimo AS e
                JOIN livro AS l ON e.livro_id = l.id
                JOIN aluno AS a ON e.aluno_id = a.id
                WHERE e.data_devolucao_real IS NULL";

        // Array de parâmetros para o PDO
        $params = [];

        // Se o termo de busca NÃO ESTIVER VAZIO, adiciona o filtro
        if (!empty($termo_busca)) {
            // Adiciona a condição no SQL
            $sql .= " AND (l.titulo LIKE ? OR a.nome LIKE ?)";
            // Adiciona os valores no array de parâmetros
            // O '%' é um coringa do SQL (significa "qualquer coisa")
            $params[] = '%' . $termo_busca . '%';
            $params[] = '%' . $termo_busca . '%';
        }

        // Adiciona a ordenação
        $sql .= " ORDER BY e.data_devolucao_prevista ASC";
        
        // 5. Executa o SQL
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params); // Passa os parâmetros (vazio ou com a busca)

        if ($stmt->rowCount() > 0) {
            while($emprestimo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Formata as datas
                $data_emprestimo = date('d/m/Y H:i', strtotime($emprestimo['data_emprestimo']));
                $data_prevista = date('d/m/Y', strtotime($emprestimo['data_devolucao_prevista']));

                echo "<tr>";
                echo "<td>" . htmlspecialchars($emprestimo['id']) . "</td>";
                echo "<td>" . htmlspecialchars($emprestimo['livro_titulo']) . "</td>";
                echo "<td>" . htmlspecialchars($emprestimo['aluno_nome']) . "</td>";
                echo "<td>" . $data_emprestimo . "</td>";
                echo "<td>" . $data_prevista . "</td>";
                echo "<td>";
                echo "<a href='emprestimo_devolver.php?id=" . $emprestimo['id'] . "' class='btn btn-success btn-sm' onclick='return confirm(\"Confirmar a devolução deste livro?\")'>Devolver</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // Mensagem dinâmica se não houver resultados
            if (!empty($termo_busca)) {
                echo "<tr><td colspan='6'>Nenhum empréstimo ativo encontrado para a busca: \"" . htmlspecialchars($termo_busca) . "\"</td></tr>";
            } else {
                echo "<tr><td colspan='6'>Nenhum empréstimo ativo no momento.</td></tr>";
            }
        }
        
        $pdo = null;
        ?>
    </tbody>
</table>

<?php
// 6. Inclui o rodapé
require("rodape.php");
?>