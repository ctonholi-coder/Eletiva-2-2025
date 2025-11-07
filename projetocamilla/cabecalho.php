<?php
  session_start();
  // Verifica se o usuário está logado
  // (A sua verificação original de 'acesso' está correta)
  if(!isset($_SESSION['acesso']))
    header('location: index.php');
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Biblioteca</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="principal.php">Biblioteca</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="principal.php">Início</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="emprestimos_listar.php">Empréstimos</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownCadastros" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Cadastros
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownCadastros">
              <li><a class="dropdown-item" href="alunos_listar.php">Alunos</a></li>
              <li><a class="dropdown-item" href="autores_listar.php">Autores</a></li>
              <li><a class="dropdown-item" href="livros_listar.php">Livros</a></li>
            </ul>
          </li>
        </ul>

        </div>
    </div>
  </nav>
  
  <div class="container py-3">