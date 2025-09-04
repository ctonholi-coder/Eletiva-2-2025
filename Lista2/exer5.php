<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 5 - Lista 2</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 5 - Lista 2</h1>
<form method="post">
<div class="mb-3">
              <label for="numero1" class="form-label">Informe um numero</label>
              <input type="text" id="numero1" name="numero1" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero1 = $_POST["numero1"];
            switch ($numero1) {
                case 1:
                    echo "<h2>Janeiro</h2>";
                    break;
                case 2:
                    echo "<h2>Fevereiro</h2>";
                    break;
                case 3:
                    echo "<h2>Março</h2>";
                    break;
                case 4:
                    echo "<h2>Abril</h2>";
                    break;
                case 5:
                    echo "<h2>Maio</h2>";
                    break;
                case 6:
                    echo "<h2>Junho</h2>";
                    break;
                case 7:
                    echo "<h2>Julho</h2>";
                    break;
                case 8:
                    echo "<h2>Agosto</h2>";
                    break;
                case 9:
                    echo "<h2>Setembro</h2>";
                    break;
                case 10:
                    echo "<h2>Outubro</h2>";
                    break;
                case 11:
                    echo "<h2>Novembro</h2>";
                    break;
                case 12:
                    echo "<h2>Dezembro</h2>";
                    break;
                default:
                    echo "<h2>Número inválido. Por favor, insira um número entre 1 e 7.</h2>";
            }
        }
        ?>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>