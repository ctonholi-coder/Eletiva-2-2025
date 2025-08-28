<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1></h1>
<form method="post">
<div class="mb-3">
              <label for="Dias" class="form-label">Informe a quantidade de dias</label>
              <input type="text" id="Dias" name="Dias" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $Dias = $_POST["Dias"];
      $Horas = $Dias * 24;
      $Minutos = $Horas * 60;
      $Segundos = $Minutos * 60;
        echo "<p>A quantidade de horas é: $Horas, minutos $Minutos, segundos $Segundos</p>";
        echo "<ul>
            <li>Horas: $Horas</li>
            <li>Minutos: $Minutos</li>
            <li>Segundos: $Segundos</li>
        </ul>";
       }
      ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>