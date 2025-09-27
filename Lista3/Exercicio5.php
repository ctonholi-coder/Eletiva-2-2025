<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 5 - Cálculo de raiz quadrada</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 5 - Cálculo de raiz quadrada</h1>
<form method="post">
<div class="mb-3">
              <label for="numero" class="form-label">Informe um número</label>
              <input type="number" id="numero" name="numero" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

    <?php

    function calcularRaiz(float $num)
    {
        if ($num < 0) {
            return "Não é possível calcular a raiz de um número negativo.";
        }
        return sqrt($num);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numeroUsuario = (float)$_POST["numero"];
        $resultado = calcularRaiz($numeroUsuario);
        echo "<p>A raiz quadrada de <strong>$numeroUsuario</strong> é <strong>$resultado</strong>.</p>";
    }
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>