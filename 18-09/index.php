<?php
    $valor = array(1,2,3,4,5);
    echo "<p>Primeiro valor do vetor:" . $valor[0]."</p>";
    //$v = $POST['NOME'];

    $vetor = [1,2,3,4,5];
    //FUNCAO PARA EXIBIR VETORES DOS VALORES
    var_dump($vetor);
    echo "<br/>";
    print_r($vetor);

    $vetor[4] = 6;
    echo "<p>Novo valor da posicao 4:" . $vetor[4]."</p>";

    $vetor['nome'] = "Camilla";
    print_r($vetor);


    $valores = [
        'nome' => "Vanessa",
        "sobrenome" => 'Borges',
        'idade' => 35
    ];

    foreach($valores as $v){
        echo "<p> $v </p>";
    }


    // nessa estrutura o c e a recuperacao da chave ou indice
    //foreach($valores as $c >= $v){
    //    echo "<p> $v </p>;"
    //}