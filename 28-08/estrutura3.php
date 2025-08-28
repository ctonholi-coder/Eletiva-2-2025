    <?php
        include("cabecalho.php");

        //1-domingo 2-segunda 3-terca 4-quarta 5-quinta 6-sexta 7-sabado

        $diaSemana = 1;

        switch ($diaSemana) {
            case 1:
                echo "Hoje é Domingo";
                break;
            case 2:
                echo "Hoje é Segunda-feira";
                break;
            case 3:
                echo "Hoje é Terça-feira";
                break;
            case 4:
                echo "Hoje é Quarta-feira";
                break;
            case 5:
                echo "Hoje é Quinta-feira";
                break;
            case 6:
                echo "Hoje é Sexta-feira";
                break;
            case 7:
                echo "Hoje é Sábado";
                break;
            default:
                echo "Dia inválido";
        }

        include("rodape.php");