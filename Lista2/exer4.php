<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 4 - Lista 2</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 4 - Lista 2</h1>
<form method="post">
<div class="mb-3">
              <label for="valor1" class="form-label">Informe o valor do produto</label>
              <input type="number" step="any" id="valor1" name="valor1" class="form-control" required="">
            </div><div class="mb-3">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valor1 = $_POST["valor1"];

            
            if ($valor1 > 100) {
                $novo = $valor1 - ($valor1 * 0.15);
                echo "<p> Produto acima de R$ 100,00! O valor do produto com desconto é de: $novo </p>";
            }
                else
                
                    echo "<p> Produto abaixo de R$ 100,00, não possui desconto.</p>";
               

        }
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>