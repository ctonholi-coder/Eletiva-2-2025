<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 18 - Cálculo de Montante</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercício 18 - Cálculo de Montante</h1>
<form method="post">
<div class="mb-3">
              <label for="Capital" class="form-label">Insira o Capital</label>
              <input type="number" id="Capital" name="Capital" class="form-control" required="">
            </div><div class="mb-3">
              <label for="Taxa" class="form-label">Informe a taxa</label>
              <input type="number" id="Taxa" name="Taxa" class="form-control" required="">
            </div><div class="mb-3">
              <label for="Periodo" class="form-label">Informe o periodo</label>
              <input type="text" id="Periodo" name="Periodo" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $Capital = $_POST["Capital"];
      $Taxa = $_POST["Taxa"];
      $Periodo = $_POST["Periodo"];
      $Montante = $Capital * (1 + ($Taxa/100) * $Periodo);
      echo "<p>O valor do montante é: $Montante</p>";
       }
      ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>