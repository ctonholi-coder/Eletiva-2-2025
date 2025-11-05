<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cadastro de Alunos (as)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Cadastro de Alunos (as)</h1>
<form method="post">
<div class="mb-3">
              <label for="id" class="form-label">ID</label>
              <input type="number" id="id" name="id" class="form-control" required="">
            </div><div class="mb-3">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" id="nome" name="nome" class="form-control" required="">
            </div><div class="mb-3">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" id="email" name="email" class="form-control" required="">
            </div><div class="mb-3">
              <label for="aluno_ra" class="form-label">R.A.</label>
              <input type="number" id="aluno_ra" name="aluno_ra" class="form-control" required="">
            </div><div class="mb-3">
              <label for="telefone" class="form-label">Telefone</label>
              <input type="number" id="telefone" name="telefone" class="form-control">
            </div>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>