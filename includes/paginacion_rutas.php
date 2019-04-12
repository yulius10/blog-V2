<?php
$cant_reg_pag = 5;
$sqlP = "SELECT cod_blo,tit_blo,ent_blo,ima_blo,fec_cre FROM blog where reg_eli=0";
$pagina = isset($_REQUEST["pg"]) ? $_REQUEST["pg"] : null;
if(empty($pagina)  || $pagina==0) { $pagina=1; }

$tabla = "blog";
$where = "";
$cantidad_paginas = $funciones->consultarCount($tabla,$where,$link);

$cant_pag_maximo=ceil($cantidad_paginas/$cant_reg_pag);
$reg_inicio = intval($pagina) * intval($cant_reg_pag) - $cant_reg_pag ;
$paginar=" limit  $reg_inicio, $cant_reg_pag";
$sqlP=$sqlP." $paginar ";
?>