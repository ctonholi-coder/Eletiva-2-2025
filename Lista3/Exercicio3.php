<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercicio 3 - Palavras Contidas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercicio 3 - Palavras Contidas</h1>
<form method="post">
<div class="mb-3">
              <label for="palavra1" class="form-label">Informe uma palavra</label>
              <input type="text" id="palavra1" name="palavra1" class="form-control" required="">
            </div>
<div class="mb-3">
              <label for="palavra2" class="form-label">Informe a segunda palavra</label>
              <input type="text" id="palavra2" name="palavra2" class="form-control" required="">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>

    <?php
    function verificarContido(string $principal, string $busca): bool
    {
        return str_contains($principal, $busca);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $p1 = $_POST["palavra1"];
        $p2 = $_POST["palavra2"];
        
        if (verificarContido($p1, $p2)) {
            echo "<p>Sim, a palavra '<strong>$p2</strong>' está contida em '<strong>$p1</strong>'.</p>";
        } else {
            echo "<p>Não, a palavra '<strong>$p2</strong>' não está contida em '<strong>$p1</strong>'.</p>";
        }
    }
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>