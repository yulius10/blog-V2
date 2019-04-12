<!-- Categories Widget -->
<div class="card my-4">
  <h5 class="card-header">
    Categorías
  </h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled mb-0">
          <?php
            $tabla = "categorias";
            $columnas = "cod_cat,nom_cat";
            $where = "";
            $order = "";
            $resultado = $funciones->consultarRegistro($tabla,$columnas,$where,$order,$link);
            if($resultado){
              while($registros = mysqli_fetch_array($resultado)){
                ?>
                <li>
                  <a href="resultCategoria.php?sec=<?=$funciones->encode_this_get("id=".$registros["cod_cat"]);?>" title="<?=$registros["nom_cat"]?>">
                    <?=$registros["nom_cat"]?>
                  </a>
                </li>
                <?php
              }
            }
            else{
              echo "No hay datos..";
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- /Categories Widget -->
