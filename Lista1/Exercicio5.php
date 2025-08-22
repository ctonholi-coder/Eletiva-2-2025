<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 5  - Média de Notas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container">
<h1>Exercício 5 - Média de Notas</h1>
<form method="post">
<div class="mb-3">
              <label for="valor1" class="form-label">Informe a primeira nota</label>
              <input type="text" placeholder="10.00"id="valor1" name="valor1" class="form-control" required="">
            </div><div class="mb-3">
              <label for="valor2" class="form-label">Informe a segunda nota</label>
              <input type="text" placeholder="10.00" id="valor2" name="valor2" class="form-control" required="">
            </div><div class="mb-3">
              <label for="valor3" class="form-label">Informe a terceira nota</label>
              <input type="text" placeholder="10.00" id="valor3" name="valor3" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $valor1 = $_POST["valor1"];
      $valor2 = $_POST["valor2"];
      $valor3 = $_POST["valor3"];
      $media = ($valor1 + $valor2 + $valor3) / 3;
      echo "<p>A média de notas é: $media</p>";

      
  }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>