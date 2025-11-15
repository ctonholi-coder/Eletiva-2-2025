<?php
    require("cabecalho.php");
    require("conexao.php");

    // Buscar estatísticas do banco
    $totalAlunos = $pdo->query("SELECT COUNT(*) FROM aluno")->fetchColumn();
    $totalAutores = $pdo->query("SELECT COUNT(*) FROM autor")->fetchColumn();
    $totalLivros = $pdo->query("SELECT COUNT(*) FROM livro")->fetchColumn();
    $totalEmprestimos = $pdo->query("SELECT COUNT(*) FROM emprestimo where data_devolucao_real IS NULL")->fetchColumn();
    $totalDevolucao = $pdo->query("SELECT COUNT(*) FROM emprestimo where data_devolucao_real IS NOT NULL")->fetchColumn();
    
    $sqlLivros = $pdo->query("SELECT titulo, quantidade_disponivel FROM livro ORDER BY titulo");
    $livros = $sqlLivros->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $quantidades = [];

    foreach ($livros as $l) {
      $labels[] = $l['titulo'];
      $quantidades[] = $l['quantidade_disponivel'];
    }

    $labels_json = json_encode($labels, JSON_UNESCAPED_UNICODE);
    $data_json   = json_encode($quantidades);

?>
    <h1>Seja bem vinda(o) à Biblioteca Central <?= $_SESSION['nome'] ?></h1>
    <div class="container mt-4">

      <h2 class="mb-4">Dashboard</h2>

      <div class="row">

          <div class="col-md-3">
              <div class="card text-bg-primary mb-3 shadow-sm">
                  <div class="card-body">
                      <h5 class="card-title">Alunos</h5>
                      <h2><?= $totalAlunos ?></h2>
                  </div>
              </div>
          </div>

          <div class="col-md-3">
              <div class="card text-bg-success mb-3 shadow-sm">
                  <div class="card-body">
                      <h5 class="card-title">Autores</h5>
                      <h2><?= $totalAutores ?></h2>
                  </div>
              </div>
          </div>

          <div class="col-md-3"> 
              <div class="card text-bg-warning mb-3 shadow-sm">
                  <div class="card-body">
                      <h5 class="card-title">Livros</h5>
                      <h2><?= $totalLivros ?></h2>
                  </div>
              </div>
          </div>

          <div class="col-md-3">
              <div class="card bg-color: #ffcccc mb-3 shadow-sm">
                  <div class="card-body">
                      <h5 class="card-title">Empréstimos</h5>
                      <h2><?= $totalEmprestimos ?></h2>
                  </div>
              </div>
          </div>

          <div class="col-md-3">
              <div class="card text-bg-danger mb-3 shadow-sm">
                  <div class="card-body">
                      <h5 class="card-title">Emprestimos Devolvidos</h5>
                      <h2><?= $totalDevolucao ?></h2>
                  </div>
              </div>
          </div>

      </div>

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <h3 class="mt-5">Quantidade de Livros Disponíveis</h3>
      <canvas id="graficoLivros" height="120"></canvas>

      <script>
        const ctxLivros = document.getElementById('graficoLivros');

        new Chart(ctxLivros, {
            type: 'bar',
            data: {
                labels: <?php echo $labels_json; ?>,
                datasets: [{
                    label: 'Quantidade Disponível',
                    data: <?php echo $data_json; ?>,
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', 
                scales: {
                            x: { 
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,   
                                    precision: 0
                                }
                            }
                        }
            }
        });
        </script>
    </div>
<?php
  require("rodape.php");
?>