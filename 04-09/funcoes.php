<?php
    $nome = "Vanessa";
    echo "<p>Todas em maíusculas: " . strtoupper($nome) . "</p>"; // strtoupper() converte uma string para maiúsculas
    echo "<p>Todas em minúsculas: " . strtolower($nome) . "</p>"; // strtolower() converte uma string para minúsculas
    echo "<p>Quantidade de caracteres: " . strlen($nome) . "</p>"; // strlen() retorna o tamanho de uma string
    $posicao = strpos($nome, "e"); // strpos() retorna a posição da primeira ocorrência de uma substring em uma string
    echo "<p>Caractere E na posição $posicao </p>: ";// A contagem começa do zero

    date_default_timezone_set("America/Sao_Paulo"); // Define o fuso horário para São Paulo   
    $data1 = date("d/m/Y");
    $dia = date("d ");
    $hora = date("H:i:s");
    echo "<p>Data atual: $data1</p>";
    echo "<p>Dia atual: $dia</p>";
    echo "<p>Hora atual: $hora</p>";

    if (checkdate(2, 29, 2025)) { // checkdate() verifica se a data é válida
        echo "<p>A data informada existe (30/02/2025)</p>";
    } else {
        echo "<p>A data informada não existe (30/02/2025)</p>";
    }

    $valor = -10;
    echo "<p>Valor absoluto de $valor é " . abs($valor) . "</p>"; // abs() retorna o valor absoluto de um número
    $valor2 = 5.9;
    echo "<p>Valor arredondado de $valor2 é " . round($valor2) . "</p>"; // round() arredonda um número
    $valor3 = rand(1, 100);
    echo "<p>Valor aleatorio: $valor3 </p>";
    echo "<p>Raiz quadrada de 16 é " . sqrt(16) . "</p>"; // sqrt() retorna a raiz quadrada de um número
    $valor4 = 13.5;
    echo "<p> Valor formatado: R$" . number_format($valor4, 2, ",", ".") . "</p>"; // number_format() formata um número com os milhares e decimais especificados



    function exibirSaudacao() {
        echo "<p>Olá! Olá mundo.</p>";
    }

    exibirSaudacao();

    function exibirSaudacaoComNome($nome) {
        echo "<p>Bem-vindo(a) $nome!.</p>";
    }
    exibirSaudacaoComNome("Camilla");

    function menorValor($valor5, $valor6) {
        return min ($valor5;, $valor6);
        }
        echo "<p>O menor valor entre 4 e 8 é " . menorValor(4, 8) . "</p>";

        function somarValores(...$numeros) {
            return array_sum($numeros);
        }
        $soma = somarValores(1, 2, 3, 4, 5, 6);
        echo "<p>A soma dos valores é $soma</p>";