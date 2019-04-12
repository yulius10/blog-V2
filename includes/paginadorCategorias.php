<?php
    $total_total_pages=$cant_pag_maximo;
    if($pagina==0 || $pagina<4 ){
        $pag_atras=1;
        $pag_ini=1;
        $pag_fin=$pag_ini+2;
        $pag_adelante=$pag_fin+1;
    }
    else {
        $pag_ini=$pagina-1;
        $pag_atras=$pag_ini-1;
        $pag_fin=$pag_ini+2;
        $pag_adelante=$pag_fin+1;
    }
    $ruta_local_con = "resultCategoria.php";
if($total_total_pages>1){
?>
<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
<?php
    if($pagina>3){
?>
        <li class="page-item"><a href="<?=$ruta_local_con."?pg=1"?>" class="page-link"><<</a></li>
        <li class="page-item"><a href="<?=$ruta_local_con."?pg=".$pag_atras?>" class="page-link"><</a></li>
<?php
    }
    for($i=$pag_ini; $i<=$pag_fin; $i++) {
        if($i<=$cant_pag_maximo) {
        ?>
            <li class="page-item"><a href="<?=$ruta_local_con."?pg=".$i?>" class="page-link"><?=$i?></a></li>
        <?php
        }
    }
?>
<?php
    if($cant_pag_maximo>=$pag_adelante){
?>
        <li class="page-item"><a href="<?=$ruta_local_con."?pg=".$pag_adelante?>" class="page-link">></a></li>
        <li class="page-item"><a href="<?=$ruta_local_con."?pg=".$total_total_pages?>" class="page-link">>></a></li>
<?php
    }
}
    ?>
</ul>
<!-- /Pagination -->
