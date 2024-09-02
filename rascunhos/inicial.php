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



//funções:
function nomeCRDisc($data, $val){ // nome ; CR ;  Disciplinas;
    foreach ($data as $aluno):
        echo $aluno[$val]. "<br>";
    endforeach;
}


function nascMat($data, $val, $div){ //nascimento ; matricula
    foreach ($data as $aluno):
        $resp = implode("$div", $aluno[$val]);
        echo $resp. "<br>";
    endforeach;
}


function ingresso($data, $val){ //ano de ingresso ; periodo de ingresso
    foreach ($data as $aluno):
        echo $aluno['matricula'][$val]. "<br>";
    endforeach;
}

function anope($data){ //ano e periodo de ingresso
    foreach ($data as $aluno):
        echo $aluno['matricula'][1].".".$aluno['matricula'][0]. "<br>";
    endforeach;
}

function curso($data){ //curso
    $cursos = array("031"=>"Ciência da Computação","041"=>"Engenharia de Telecomunicações");
    foreach ($data as $aluno):
        $numCurso = $aluno['matricula'][2];
        if (in_array($numCurso, array_keys($cursos))):
            echo $cursos[$numCurso]. "<br>";
        endif;
    endforeach;
}

//array, para não lidar com if
$funcoes = [
    'nome' => function($dados) {
        nomeCRDisc($dados, 'nome');
    },
    'nasc' => function($dados) {
        nascMat($dados, "nascimento", "/");
    },
    'mat' => function($dados) {
        nascMat($dados, "matricula", ".");
    },
    'ano' => function($dados) {
        ingresso($dados, 1);
    },
    'pe' => function($dados) {
        ingresso($dados, 0);
    },
    'curso' => function($dados) {
        curso($dados);
    },
    'anope' => function($dados) {
        anope($dados);
    },
    'cr' => function($dados) {
        nomeCRDisc($dados, 'cr');
    },
    'disciplinas' => function($dados) {
        nomeCRDisc($dados, 'disciplinas');
    }
];

foreach ($funcoes as $chave => $funcao) {
    if (isset($_GET[$chave])):
        $funcao($dados);
        echo "<br>";
    endif;
}

?>