<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 8 - Lista 2</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 8 - Lista 2</h1>
<form method="post">
<div class="mb-3">
              <label for="numero" class="form-label">Informe um numero</label>
              <input type="text" id="numero" name="numero" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = (int)$_POST["numero"];
        echo "<hr>";
        echo "<h3>Contagem regressiva a partir de $num:</h3>";

        $contador_regressivo = $num;

        if ($contador_regressivo > 0) {
            do {
                echo $contador_regressivo . "<br>";
                $contador_regressivo--;             
            } while ($contador_regressivo >= 1);    
        } else {
            echo "Por favor, informe um número maior que zero.";
        }
    }
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>