<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 15 - Calculo de IMC (Indice de Massa Corporal)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container">
<h1>Exercício 15 - Calculo de IMC (Indice de Massa Corporal)</h1>
<form method="post">
<div class="mb-3">
              <label for="valor1" class="form-label">Informe o seu peso</label>
              <input type="text" id="valor1" name="valor1" class="form-control" required="">
              <label for="valor2" class="form-label">Informe a sua altura</label>
              <input type="text" id="valor2" name="valor2" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $valor1 = $_POST["valor1"];
      $valor2 = $_POST["valor2"];
      $imc = $valor1 / ($valor2 * $valor2);
      echo "<p>O valor do IMC é: $imc</p>";
      
  }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>