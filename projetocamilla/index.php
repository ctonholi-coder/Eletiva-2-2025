<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f2f2f2;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-card {
      width: 100%;
      max-width: 380px;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      background: #fff;
      text-align: center;
    }

    .login-logo {
      width: 180px;
      margin-bottom: 15px;
    }
  </style>
</head>

<body>

  <div class="login-card">

    <!-- LOGO -->
    <img src="logo.png" alt="Logo da Biblioteca" class="login-logo">

    <?php
      if (isset($_GET['cadastro'])) {
        echo $cadastro
          ? "<p class='text-success'>Cadastro realizado com sucesso!</p>"
          : "<p class='text-danger'>Erro ao realizar o cadastro!</p>";
      }

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        require('conexao.php');

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
          $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
          $stmt->execute([$email]);
          $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

          if ($usuario && password_verify($senha, $usuario['senha'])) {
            session_start();
            $_SESSION['acesso'] = true;
            $_SESSION['nome'] = $usuario['nome'];
            header('location: principal.php');
          } else {
            echo "<p class='text-danger'>Credenciais inválidas!</p>";
          }
        } catch (\Exception $e) {
          echo "<p class='text-danger'>Erro: ".$e->getMessage()."</p>";
        }
      }
    ?>

    <h4 class="mb-3">Acesso à Biblioteca</h4>

    <form action="index.php" method="POST">
      <div class="mb-3 text-start">
        <label class="form-label" for="emailLogin">Email</label>
        <input type="email" class="form-control" name="email" id="emailLogin" placeholder="Digite seu email" required>
      </div>

      <div class="mb-3 text-start">
        <label class="form-label" for="senhaLogin">Senha</label>
        <input type="password" class="form-control" name="senha" id="senhaLogin" placeholder="Digite sua senha" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>

    <p class="mt-3">
      Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
    </p>

  </div>

</body>

</html>
