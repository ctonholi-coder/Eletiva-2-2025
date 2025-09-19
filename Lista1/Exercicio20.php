<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 20  - Velocidade média</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container">
<h1>Exercício 20  - Velocidade média</h1>
<form method="post">
<div class="mb-3">
              <label for="valor1" class="form-label">Informe o valor da distancia percorrida em metros</label>
              <input type="number" step="0,01" id="valor1" name="valor1" class="form-control" required="">
            </div><div class="mb-3">
              <label for="valor2" class="form-label">Informe o tempo em horas</label>
              <input type="number" step="any" id="valor2" name="valor2" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $valor1 = floatval($_POST["valor1"]);
      $valor2 = floatval($_POST["valor2"]);

      $tempo_segundos = $valor2 *3600;

      $velocidade_ms = $valor1 / $tempo_segundos;

      $velocidade_kmh = $velocidade_ms * 3.6;
    
      echo "<p><strong>Resultado:</strong></p>";
      echo "<p>Velocidade média: " . number_format($velocidade_ms, 2, ',', '.') . " m/s</p>";
      echo "<p>Velocidade média: " . number_format($velocidade_kmh, 2, ',', '.') . " km/h</p>";

      
  }

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>