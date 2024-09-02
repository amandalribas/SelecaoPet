<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações dos Alunos</title>
    <link rel="stylesheet" href="styles/">
</head>
<body>
    
</body>
</html>
<?php




// acessando o arquivo .json:
$dadosJson = file_get_contents('dados.json');
$dados = json_decode($dadosJson, true);
// funcoes:
echo "<pre>";

function imprime($array){
    foreach ($array as $indice => $elemento):
        foreach ($elemento as $ind => $ele){
            echo $ind.": ";
            if (is_array($ele)):
                foreach ($ele as $e){
                    echo $e. " ";
                }
                echo "<br>";
            else:
                echo $ele. "<br>";
            endif;
        }
        echo "<hr>";
    endforeach;
}

function crescente($array,$indice,$elemento=-1){
    if ($elemento == -1): //não é um array dentro do array
        foreach ($array as $aluno => $info):
            $aux[] = ($info[$indice]);
        endforeach;
    else:
        foreach ($array as $aluno => $info):
            $aux[] = ($info[$indice][$elemento]);
        endforeach;
    endif;
    asort($aux); // array somente com o $indice em ordem crescente
    foreach ($aux as $aluno => $info):
        $array_aux[] = $array[$aluno];
    endforeach;
    imprime($array_aux);
    
}


function alfabetica($array){
    array_multisort($array);
    imprime($array);
}


if (isset($_GET["parametro"])):
    $parametro = $_GET["parametro"];
    echo htmlspecialchars($parametro) . "<br>";

    $funcoes = [
        "nome" => function($dados) { alfabetica($dados); },
        "nascimento" => function($dados) { crescente($dados, "nascimento", 2); },
        "matricula" => function($dados) { crescente($dados, "matricula", 3); },
        "anoIngresso" => function($dados) { crescente($dados, "matricula", 1); },
        "peIngresso" => function($dados) { crescente($dados, "matricula", 0); },
        "anoPeIngresso" => function($dados) {
            // Ordenar por ano e ingresso
        },
        "curso" => function($dados) { crescente($dados, "matricula", 2); },
        "cr" => function($dados) { crescente($dados, "cr"); },
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
"</pre>";

?>