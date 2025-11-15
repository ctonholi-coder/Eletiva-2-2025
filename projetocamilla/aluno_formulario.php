<?php
require("cabecalho.php");

include 'conexao.php'; // Inclui o $pdo

// Inicializa as variáveis
$id = '';
$nome = '';
$email = '';
$matricula = '';
$telefone = '';
$titulo_pagina = "Cadastrar Novo Aluno";
$action = "aluno_salvar.php";

// Verifica se o ID foi passado na URL (modo de edição)
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $titulo_pagina = "Editar Aluno";

    // Busca os dados do aluno no banco
    $stmt = $pdo->prepare("SELECT * FROM aluno WHERE id = ?");
    $stmt->execute([$id]); // Passa o ID como um array para o execute
    
    if ($stmt->rowCount() > 0) {
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC); // Pega o primeiro resultado
        $nome = $aluno['nome'];
        $email = $aluno['email'];
        $matricula = $aluno['matricula'];
        $telefone = $aluno['telefone'];
    }
}
$pdo = null; // Fecha a conexão
?>

<div class="container mt-4">
    <h2><?php echo $titulo_pagina; ?></h2>

    <form action="<?php echo $action; ?>" method="POST" class="mt-3" style="max-width: 500px;">
       
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <div class="mb-3">
            <label for="nome"  class="form-label" >Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?php echo htmlspecialchars($nome); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" class="form-control" value="<?php echo htmlspecialchars($matricula); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone (opcional):</label>
            <input type="text" id="telefone" name="telefone" class="form-control" value="<?php echo htmlspecialchars($telefone); ?>">
        </div>
        
        <button type="submit" class="btn btn-primary">
            <?php echo ($id) ? 'Atualizar' : 'Cadastrar'; ?>
        </button>

        <a href="alunos_listar.php" class="btn btn-secondary">Voltar para a Lista</a>
    </form>
    <br>

</div>

<?php
require("rodape.php");
?>