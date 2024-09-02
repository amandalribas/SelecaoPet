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
    <link rel="stylesheet" href="styles/style.css" type="text/css">
</head>
<body>
    <main>
        <?php
        if (isset($_GET["parametro"])):
            $parametro = $_GET["parametro"];
            echo "<h1>".htmlspecialchars($parametro). "</h1> <br>";
        
            $funcoes = [
                "nome" => function($dados) { alfabetica($dados); },
                "nascimento" => function($dados) {echo"CLassificado pela ordem decrescente, do mais velho, ao mais novo.<br><br>"; idade($dados);}, //ordem crescente
                "matricula" => function($dados) {echo "Classificado pela ordem crescente dos últimos três dígitos da matrícula.<br><br>" ;crescente($dados, "matricula", 3); },
                "anoIngresso" => function($dados) {echo "Classficiado pela ordem crescente do ano de matrícula, sem considerar o período.<br><br>"; crescente($dados, "matricula", 1); },
                "peIngresso" => function($dados) {echo"Classficado pela ordem crescente do período do ano de ingresso, sem considerar o ano. <br><br>"; crescente($dados, "matricula", 0); },
                "anoPeIngresso" => function($dados) {
                    // Ordenar por ano e ingresso
                },
                "curso" => function($dados) {echo"Classificado pela ordem crescente do número equivalente ao curso.<br><br>"; crescente($dados, "matricula", 2); },
                "cr" => function($dados) {echo"Classficado pela ordem do CR, Coeficiente de Rendimento. <br><br>";crescente($dados, "cr"); },
                "disciplinas" => function($dados) {
                    // Transformar o elemento disciplinas em um array ao invés de string -- usando explode(" ", string)?;
                    // Pegar pelo valor[4] o número e ordenar.
                }
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
