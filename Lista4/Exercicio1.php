<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Exercicio 1 - Cadastro de Contatos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4">Exercicio 1 - Cadastro de Contatos</h2>
    <p>Insira os dados de 5 contatos. Nomes ou números de telefone duplicados não serão adicionados.</p>

    <div class="card p-4">
      <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="nome<?php echo $i; ?>" class="form-label">Nome do Contato <?php echo $i; ?></label>
              <input type="text" class="form-control" id="nome<?php echo $i; ?>" name="nomes[]">
            </div>
            <div class="col-md-6">
              <label for="telefone<?php echo $i; ?>" class="form-label">Telefone do Contato <?php echo $i; ?></label>
              <input type="text" class="form-control" id="telefone<?php echo $i; ?>" name="telefones[]">
            </div>
          </div>
        <?php endfor; ?>
        
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Salvar e Ordenar Contatos</button>
        </div>
      </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $nomes = $_POST['nomes'];
        $telefones = $_POST['telefones'];

        $mapaContatos = [];
        $erros = [];
        $telefonesAdicionados = [];


        for ($i = 0; $i < count($nomes); $i++) {
            $nome = trim($nomes[$i]);
            $telefone = trim($telefones[$i]);

            if (empty($nome) || empty($telefone)) {
                continue;
            }


            if (array_key_exists($nome, $mapaContatos)) {
                $erros[] = "O nome '<strong>$nome</strong>' já existe e não foi adicionado novamente.";
                continue;
            }


            if (in_array($telefone, $telefonesAdicionados)) {
                $erros[] = "O telefone '<strong>$telefone</strong>' já existe e não foi adicionado para o contato '<strong>$nome</strong>'.";
                continue;
            }


            $mapaContatos[$nome] = $telefone;
            $telefonesAdicionados[] = $telefone;
        }

        ksort($mapaContatos);

        echo '<div class="card mt-5">';
        echo '<div class="card-header"><h4>Contatos Salvos e Ordenados</h4></div>';

        if (!empty($erros)) {
            echo '<div class="alert alert-warning mb-0">';
            echo '<strong>Avisos:</strong><br>';
            foreach ($erros as $erro) {
                echo $erro . '<br>';
            }
            echo '</div>';
        }


        if (!empty($mapaContatos)) {
            echo '<ul class="list-group list-group-flush">';
            foreach ($mapaContatos as $nome => $telefone) {
                echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                echo "<strong>$nome</strong>";
                echo "<span class='badge bg-secondary rounded-pill'>$telefone</span>";
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<div class="card-body"><p class="text-center">Nenhum contato válido foi adicionado.</p></div>';
        }

        echo '</div>';
    }
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
