<?php

include 'funcoes.php';


$dadosJson = file_get_contents('dados.json');
$dados = json_decode($dadosJson, true);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações dos Alunos</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/apresentacaoStyle.css">
    <link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">

</head>
<body>
    <main>
        <?php
        if (isset($_GET["parametro"])):
            $parametro = $_GET["parametro"];
            echo "<h1>".htmlspecialchars($parametro). "</h1> <br>";
        
            $funcoes = [
                "nome" => function($dados) {echo"Classificado na ordem alfabética de nomes.<br><br>"; alfabetica($dados); },
                "nascimento" => function($dados) {echo"Classificado pela ordem decrescente, do mais velho, ao mais novo.<br><br>"; idade($dados);}, //ordem crescente
                "matricula" => function($dados) {echo "Classificado pela ordem crescente dos últimos três dígitos da matrícula.<br><br>" ;crescente($dados, "matricula", 3); },
                "Ano de Ingresso" => function($dados) {echo "Classficiado pela ordem crescente do ano de matrícula, sem considerar o período.<br><br>"; crescente($dados, "matricula", 1); },
                "Período de Ingresso" => function($dados) {echo"Classificado pela ordem crescente do período do ano de ingresso, sem considerar o ano. <br><br>"; crescente($dados, "matricula", 0); },
                "Ano e Período de Ingresso" => function($dados) {
                    anoPeriodo($dados);
                },
                "curso" => function($dados) {echo"Classificado pela ordem crescente do número equivalente ao curso.<br><br>"; crescente($dados, "matricula", 2); },
                "cr" => function($dados) {echo"Classficado pela ordem crescente de CR, Coeficiente de Rendimento. <br><br>";crescente($dados, "cr"); },
                "disciplinas" => function($dados) {echo"Classificado pela ordem crescente de matérias não feitas.<br><br>"; disciplinas($dados); }
            ];
        
            // Verifica se o parâmetro existe no array de funções e o executa
            if (array_key_exists($parametro, $funcoes)):
                $funcoes[$parametro]($dados);
            else:
                echo "Parâmetro não existente.";
            endif;
        else:
            echo "Nenhum parâmetro escolhido.";
        endif;
        ?>
    </main>
</body>
</html>
