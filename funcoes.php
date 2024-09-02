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
?>