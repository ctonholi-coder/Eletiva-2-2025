<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 1 - Contador de caracteres</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 1 - Contador de caracteres</h1>
<form method="post">
<div class="mb-3">
              <label for="palavra" class="form-label">Informe uma palavra</label>
              <input type="text" id="palavra" name="palavra" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

    <?php
    
    function contarCaracteres(string $palavra): int
    {
        return strlen($palavra);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $palavraUsuario = $_POST["palavra"];
        $quantidade = contarCaracteres($palavraUsuario);
        echo "<p>A palavra '<strong>$palavraUsuario</strong>' possui <strong>$quantidade</strong> caracteres.</p>";
    }
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>