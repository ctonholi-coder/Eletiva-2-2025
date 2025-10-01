<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercicio 5 - Cadastro de Livros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4">Exercicio 5 - Cadastro de Livros</h2>
    <p>Insira os dados de 5 livros. Títulos duplicados não serão adicionados.</p>

    <div class="card p-4">
      <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="titulo<?php echo $i; ?>" class="form-label">Título do Livro <?php echo $i; ?></label>
              <input type="text" class="form-control" id="titulo<?php echo $i; ?>" name="titulos[]">
            </div>
            <div class="col-md-4">
              <label for="estoque<?php echo $i; ?>" class="form-label">Estoque <?php echo $i; ?></label>
              <input type="number" step="1" class="form-control" id="estoque<?php echo $i; ?>" name="estoques[]">
            </div>              
            </div>  
        <?php endfor; ?>
        
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Salvar e Ordenar Livros</button>
        </div>
      </form>
    </div>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
          $titulos = $_POST['titulos'];
          $estoques = $_POST['estoques'];

          $alertas = [];

          $mapaLivros = [];
          $erros = [];

          for ($i = 0; $i < count($titulos); $i++) {
              $titulo = trim($titulos[$i]);
              $estoque = trim($estoques[$i]);

              if (empty($titulo) || empty($estoque)) {
                continue;
              }

              if ($estoque < 0 ) {
                $erros[] = "Estoque deve ser maior que zero, Livro: '<strong>$titulo</strong>'";
                continue;
              }

              if (array_key_exists($titulo, $mapaLivros)) {
                $erros[] = "O título '<strong>$titulo</strong>' já existe e não foi adicionado novamente.";
                continue;
              }

              if ($estoque < 5) {
                $alertas[] = "O título '<strong>$titulo</strong>' possui quantidade em estoque menor que 5.";
              }

              $mapaLivros[$titulo] = $estoque;
          }

          ksort($mapaLivros);

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

          if (!empty($alertas)) {
              echo '<div class="alert alert-warning mb-0">';
              echo '<strong>Avisos:</strong><br>';
              foreach ($alertas as $alerta) {
                  echo $alerta . '<br>';
              }
              echo '</div>';
          }

          if (!empty($mapaLivros)) {
              echo '<ul class="list-group list-group-flush">';
              echo '<li  class="list-group-item d-flex justify-content-between align-items-center">';
              echo '  <strong>Livros </strong>';
              echo '  <strong>Qtde Estoque</strong>';
              echo '</li>';
              foreach ($mapaLivros as $titulo => $estoque) {
                  echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                  echo " <p> $titulo </p> ";
                  echo " <p> $estoque </p>";
                  echo '</li>';
              }
              echo '</ul>';
          } else {
              echo '<div class="card-body"><p class="text-center">Nenhum livro válido foi adicionado.</p></div>';
          }

          echo '</div>';
      }
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
