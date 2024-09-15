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
                'nome' => function($dados) {
                    echo"<p>Classificado na ordem alfabética de nomes.</p><br><br>"; alfabetica($dados); 
                },
                "nascimento" => function($dados) {
                    echo"<p>Classificado pela ordem decrescente, considerando as idades, do mais velho, ao mais novo.</p><br><br>"; idade($dados);
                }, //ordem crescente
                "matrícula" => function($dados) {
                    echo "<p>Classificado pela ordem crescente dos últimos três dígitos da matrícula.</p><br><br>" ;crescente($dados, "matricula", 3); 
                },
                "Ano de Ingresso" => function($dados) {
                    echo "<p>Classificado pela ordem crescente do ano de matrícula, sem considerar o período.</p><br><br>"; crescente($dados, "matricula", 1); 
                },
                "Período de Ingresso" => function($dados) {
                    echo"<p>Classificado pela ordem crescente do período do ano de ingresso, sem considerar o ano.</p><br><br>"; crescente($dados, "matricula", 0); 
                },
                "Ano e Período de Ingresso" => function($dados) {
                    echo"<p>Classificado considerando o ano e período de ingresso, do aluno(a) mais antigo da graduação, ao mais novo(a).</p><br><br>"; anoPeriodo($dados);
                },
                "curso" => function($dados) {
                    echo"<p>Classificado pela ordem crescente do número equivalente ao curso.</p><br><br>"; crescente($dados, "matricula", 2); 
                },
                "cr" => function($dados) {
                    echo"<p>Classificado pela ordem crescente de CR, Coeficiente de Rendimento.</p><br><br>";crescente($dados, "cr"); 
                },
                "disciplinas" => function($dados) {
                    echo"<p>Classificado pela ordem crescente de matérias não feitas.</p><br><br>"; disciplinas($dados); 
                }
            ];
        
            // Verifica se o parâmetro existe no array de funções e o executa
            if (array_key_exists($parametro, $funcoes)):
                $funcoes[$parametro]($dados);
            else:
                echo "Parâmetro não existente.";
            endif;
        else:
            echo"<p id='semParametro'>Nenhum parâmetro escolhido.</p>";
        endif;
        ?>
    </main>
</body>
</html>
