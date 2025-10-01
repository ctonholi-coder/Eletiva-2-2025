<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercicio 3 - Cadastro de Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4">Exercicio 3 - Cadastro de Produtos</h2>
    <p>Insira os dados de 5 produtos. Nomes duplicados não serão adicionados.</p>

    <div class="card p-4">
      <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="codigo<?php echo $i; ?>" class="form-label">Codigo <?php echo $i; ?></label>
              <input type="number" step="1" class="form-control" id="nota1<?php echo $i; ?>" name="codigos[]">
            </div>
            <div class="col-md-4">
              <label for="preco<?php echo $i; ?>" class="form-label">Preco <?php echo $i; ?></label>
              <input type="number" step="0.01" class="form-control" id="preco<?php echo $i; ?>" name="precos[]">
            </div>  
            <div class="col-md-12">
              <label for="nome<?php echo $i; ?>" class="form-label">Nome do Produto <?php echo $i; ?></label>
              <input type="text" class="form-control" id="nome<?php echo $i; ?>" name="nomes[]">
            </div>
            
            </div>  
        <?php endfor; ?>
        
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Salvar e Ordenar Produtos</button>
        </div>
      </form>
    </div>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
          $nomes = $_POST['nomes'];
          $codigos = $_POST['codigos'];
          $precos = $_POST['precos'];

          $erros = [];

          $mapaProdutos = [];
          $erros = [];
          $valorProduto = [];

          for ($i = 0; $i < count($nomes); $i++) {
              $nome = trim($nomes[$i]);
              $codigo = trim($codigos[$i]);
              $preco = trim($precos[$i]);

              if (empty($nome) || empty($codigo) || empty($preco)) {
                  continue;
              }

              if ($preco < 0 ) {
                $erros[] = "Preço deve ser maior que zero, produto: '<strong>$nome</strong>'";
                continue;
              }

              if ($codigo < 0 ) {
                $erros[] = "Código deve ser maior que zero, produto: '<strong>$nome</strong>'";
                continue;
              }

              if (array_key_exists($nome, $mapaProdutos)) {
                  $erros[] = "O nome '<strong>$nome</strong>' já existe e não foi adicionado novamente.";
                  continue;
              }

              $valorProduto[0] = $codigo;
              $valorProduto[1] = $preco;
              $mapaProdutos[$nome] = $valorProduto;
          }

          ksort($mapaProdutos);

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


          if (!empty($mapaProdutos)) {
              echo '<ul class="list-group list-group-flush">';
              echo '<li  class="list-group-item d-flex justify-content-between align-items-center">';
              echo '  <strong>Produto </strong>';
              echo '  <strong>Código </strong>';
              echo '  <strong>Valor </strong>';
              echo '  <strong>Valor c\ Desconto </strong>';
              echo '</li>';
              foreach ($mapaProdutos as $nome => $valorProduto) {
                  echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                  echo " <p>  $nome  </p> ";
                  echo " <p> $valorProduto[0] </p> ";
                  echo "<p>" . number_format($valorProduto[1], 2, ",", ".") . "</p>";
                  if ( $valorProduto[1] > 100) {
                    $valor = $valorProduto[1] * 0.9;
                    echo "<p>" . number_format($valor, 2, ",", ".") . "</p>";
                  } else {
                    echo ' <p> - <p> ';
                  }
                  echo '</li>';
              }
              echo '</ul>';
          } else {
              echo '<div class="card-body"><p class="text-center">Nenhum produto válido foi adicionado.</p></div>';
          }

          echo '</div>';
      }
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
