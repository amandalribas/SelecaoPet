<?php
$danilo = "De 21, nao fez 1. P3: (não fez Redes_Locais_e_de_Acesso_P3; atrasou Interconexão_de_Redes_I_P4; compensou com Elementos_de_Gestao";

$pedro = "De 28, não fez 2. P4: (não fez Engenharia_de_Software_P4; atrasou Projeto_de_Software_P5; compensou com Topicos_em_Engenharia_de_Software_P5). P5: (não fez Redes_de_Computadores_I_P5; atrasou Redes_de_Computadores_II_P6; compensou com Sociologia_Do_Trabalho";

$frase1 = explode(" ",$danilo);
print_r($frase1[1]);
echo "<br> <hr>";
$frase2 = explode(" ", $pedro);
print_r($frase2[1]);

?>