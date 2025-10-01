<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercicio 2 - Cadastro de Alunos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4">Exercicio 2 - Cadastro de Alunos</h2>
    <p>Insira os dados de 5 alunos. Nomes duplicados não serão adicionados.</p>

    <div class="card p-4">
      <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="nome<?php echo $i; ?>" class="form-label">Nome do Aluno <?php echo $i; ?></label>
              <input type="text" class="form-control" id="nome<?php echo $i; ?>" name="nomes[]">
            </div>
            <div class="col-md-4">
              <label for="nota1<?php echo $i; ?>" class="form-label">Nota 1</label>
              <input type="number" step="0.1" class="form-control" id="nota1<?php echo $i; ?>" name="notas1[]">
            </div>
            <div class="col-md-4">
              <label for="nota2<?php echo $i; ?>" class="form-label">Nota 2</label>
              <input type="number" step="0.1" class="form-control" id="nota2<?php echo $i; ?>" name="notas2[]">
            </div>
            <div class="col-md-4">
              <label for="nota3<?php echo $i; ?>" class="form-label">Nota 3</label>
              <input type="number" step="0.1" class="form-control" id="nota3<?php echo $i; ?>" name="notas3[]">
            </div>
          </div>
        <?php endfor; ?>
        
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Salvar e Ordenar Alunos</button>
        </div>
      </form>
    </div>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
          $nomes = $_POST['nomes'];
          $notas1 = $_POST['notas1'];
          $notas2 = $_POST['notas2'];
          $notas3 = $_POST['notas3'];

          $erros = [];

          $mapaAlunos = [];
          $erros = [];
          for ($i = 0; $i < count($nomes); $i++) {
              $nome = trim($nomes[$i]);
              $nota1 = trim($notas1[$i]);
              $nota2 = trim($notas2[$i]);
              $nota3 = trim($notas3[$i]);

              if (empty($nome) || empty($nota1) || empty($nota2) || empty($nota3)) {
                  continue;
              }

              if ($nota1 < 0 || $nota2 < 0 || $nota3 < 0 || $nota1 > 10 || $nota2 > 10 || $nota3 > 10) {
                $erros[] = "Nota deve estar entre 0 e 10, aluno: '<strong>$nome</strong>'";
                continue;
              }
              
              if (array_key_exists($nome, $mapaAlunos)) {
                $erros[] = "O nome '<strong>$nome</strong>' já existe e não foi adicionado novamente.";
                continue;
              }

              $media = ($nota1 + $nota2 + $nota3) / 3.0;
              $mapaAlunos[$nome] = $media;

          }

          arsort($mapaAlunos);

          echo '<div class="card mt-5">';
          echo '<div class="card-header"><h4>Alunos Salvos e Ordenados</h4></div>';

          if (!empty($erros)) {
              echo '<div class="alert alert-danger mb-0">';
              echo '<strong>Erro:</strong><br>';
              foreach ($erros as $erro) {
                  echo $erro . '<br>';
              }
              echo '</div>';
          }

          if (!empty($mapaAlunos)) {
              echo '<ul class="list-group list-group-flush">';
              echo '<li  class="list-group-item d-flex justify-content-between align-items-center">';
              echo '  <strong>Nome </strong>';
              echo '  <strong>Média </strong>';
              echo '</li>';
              foreach ($mapaAlunos as $nome => $media) {
                  echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                  echo "<p> $nome </p>";
                  echo "<p> " . number_format($media, 2, ",", ".") . "</p>";
                  echo '</li>';
              }
              echo '</ul>';
          } else {
              echo '<div class="card-body"><p class="text-center">Nenhum aluno válido foi adicionado.</p></div>';
          }


          echo '</div>';
      }
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
