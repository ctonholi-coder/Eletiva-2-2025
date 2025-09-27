<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 4 - Data</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 4 - Data</h1>
<form method="post">
<div class="mb-3">
              <label for="dia" class="form-label">Informe o dia</label>
              <input type="number" id="dia" name="dia" class="form-control" required min="1" max="31">

              <label for="mes" class="form-label">Informe o mês</label>
              <input type="number" id="mes" name="mes" class="form-control" required min="1" max="12">

              <label for="ano" class="form-label">Informe o ano</label>
              <input type="number" id="ano" name="ano" class="form-control" required min="1">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
    function formatarDataValida(int $d, int $m, int $a): string
    {
        if (checkdate($m, $d, $a)) {
            return sprintf("%02d/%02d/%04d", $d, $m, $a);
        } else {
            return "A data informada é inválida.";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dia = (int)$_POST["dia"];
        $mes = (int)$_POST["mes"];
        $ano = (int)$_POST["ano"];
        
        $resultado = formatarDataValida($dia, $mes, $ano);
        echo "<p>Resultado: <strong>$resultado</strong></p>";
    }
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>