<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 14 - Conversão de kilometros para milhas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container">
<h1>Exercício 14 - Conversão de kilometros para milhas</h1>
<form method="post">
<div class="mb-3">
              <label for="valor1" class="form-label">Informe o valor em kilometros</label>
              <input type="text" id="valor1" name="valor1" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $valor1 = $_POST["valor1"];
      $resultado = $valor1 * 0.62137;
      echo "<p>O valor de $valor1 kilometros, em milhas é: $resultado</p>";
      
  }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>