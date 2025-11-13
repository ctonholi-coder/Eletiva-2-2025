<?php
// 1. Inclui o cabeçalho
require("cabecalho.php");
include 'conexao.php'; // Inclui o $pdo

// --- 1. Buscar Alunos ---
$stmt_alunos = $pdo->query("SELECT id, nome, matricula FROM aluno ORDER BY nome");
$alunos = $stmt_alunos->fetchAll(PDO::FETCH_ASSOC);

// --- 2. Buscar Livros Disponíveis ---
$stmt_livros = $pdo->query("SELECT id, titulo FROM livro WHERE quantidade_disponivel > 0 ORDER BY titulo");
$livros = $stmt_livros->fetchAll(PDO::FETCH_ASSOC);

$data_devolucao_padrao = date('Y-m-d', strtotime('+7 days'));

$pdo = null; // Fecha a conexão
?>

<h2>Registrar Novo Empréstimo</h2>

<form action="emprestimo_salvar.php" method="POST" class="col-md-6">

    <div class="mb-3">
        <label for="aluno_id" class="form-label">Aluno:</label>
        <select id="aluno_id" name="aluno_id" class="form-select" required>
            <option value="">Selecione um aluno...</option>
            <?php
            foreach ($alunos as $aluno) {
                echo "<option value='{$aluno['id']}'>" . htmlspecialchars($aluno['nome']) . " (Matrícula: {$aluno['matricula']})</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="livro_id" class="form-label">Livro Disponível:</label>
        <select id="livro_id" name="livro_id" class="form-select" required>
            <option value="">Selecione um livro...</option>
            <?php
            if (empty($livros)) {
                 echo "<option value='' disabled>Nenhum livro disponível no momento.</option>";
            }
            foreach ($livros as $livro) {
                echo "<option value='{$livro['id']}'>" . htmlspecialchars($livro['titulo']) . "</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="data_devolucao_prevista" class="form-label">Data de Devolução Prevista:</label>
        <input type="date" id="data_devolucao_prevista" name="data_devolucao_prevista" class="form-control" value="<?php echo $data_devolucao_padrao; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary" <?php if (empty($livros) || empty($alunos)) echo 'disabled'; ?>>
        Salvar Empréstimo
    </button>
    <a href="emprestimos_listar.php" class="btn btn-secondary">Voltar</a>
    
    <?php if (empty($livros) || empty($alunos)) echo '<p class="text-danger mt-2">Cadastre alunos e livros disponíveis antes de fazer um empréstimo.</p>'; ?>
</form>

<?php
// 2. Inclui o rodapé
require("rodape.php");
?>