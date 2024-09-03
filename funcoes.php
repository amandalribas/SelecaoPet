<?php
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

function alfabetica($array){ //nome
    array_multisort($array);
    imprime($array);
}

function idade($array) {
    usort($array, function($a, $b){
        // DD - MM - AAAA  
        $dataA = strtotime($a['nascimento'][0]. '-' .$a['nascimento'][1]. '-' .$a['nascimento'][2]); 
        $dataB = strtotime($b['nascimento'][0]. '-' .$b['nascimento'][1]. '-' .$b['nascimento'][2]);
        //formatação strtotime() permite a comparação
        return $dataA <=> $dataB;
    });

    imprime($array);
}

function crescente($array,$indice,$elemento=-1){
    if ($elemento == -1): 
        foreach ($array as $aluno => $info):
            $aux[] = ($info[$indice]);
        endforeach;
    else: // o tipo de dado é um array (matricula e nascimento)
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


function anoPeriodo($array){
    usort($array, function($a,$b){ //ordena de acordo com a funcao
        $anoA = $a["matricula"][1];
        $anoB = $b["matricula"][1];
        return $anoA <=> $anoB;
        //caso sejam iguais compara os periodos:
        $peA = $a["matricula"][0];
        $peB = $b["matricula"][0];
        return $peA <=> $peB;
        }); 
    imprime($array);
}

function disciplinas($array){
    // Transformar o elemento disciplinas em um array ao invés de string -- usando explode(" ", string)?;
    // Pegar pelo valor[4] o número e ordenar.
    foreach ($array as $aluno):
        $info = explode(" ", $aluno["disciplinas"]);
        $aux[] = $info[4];
    endforeach;
    asort($aux);
    foreach ($aux as $aluno => $info):
        $array_aux[] = $array[$aluno];
    endforeach;
    imprime($array_aux);
}

?>