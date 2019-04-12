<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="formEditBlog" enctype="multipart/form-data">
        <div class="box-body">
          
          <div class="form-group col-md-6">
            <label for="titulo">
              Titulo del blog
            </label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?=$titulo?>"/>
          </div>
          <div class="form-group col-md-6">
            <label for="titulo">
              Tipo de categoria
            </label>
            <br/>
            <select name="tipoCategorie">
              <option>
              </option>
            <?php

              $tabla = "categorias";
              $columnas = "cod_cat,nom_cat";
              $where = "";
              $order = "";
              
              $resultados = $funciones->consultarRegistro($tabla,$columnas,$where,$order,$link);
              while($registros = mysqli_fetch_array($resultados)){
            ?>
              <option value="<?=$registros["cod_cat"]?>" <?php if($categoria==$registros["cod_cat"]){ echo "selected"; } ?>>
                <?=$registros["nom_cat"]?>
              </option>
            <?php
              }
            ?>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="descripcionPeg">
              Descripcion pequeña
            </label>
            <textarea class="form-control" id="descripcionPeg" name="descripcionPeg" rows="3"><?=$descripcionPeq?></textarea>
          </div>
          <div class="form-group col-md-12">
            <label for="descripcion">
              Descripcion
            </label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?=$descripcion?></textarea>
          </div>
          <div class="form-group col-md-12">
            <label for="categorie">
              Archivos
            </label>
            <div class="form-group">
              <input type="file" id="Archivo" name="Archivo"  multiple/>
            </div>
            <label for="categorie">
              Imagen portada
            </label>
            <div class="form-group">
              <input type="file" name="Portada" id="Portada" value="<?=$ima?>" />
              <img src="<?=$ima?>" alt="<?=$titulo?>"  />
            </div>
          </div>
          <!-- /.box-body -->
          <div class="form-group col-md-12 align-items-center">
            <button type="submit" class="btn btn-primary">
              Submit
            </button>
          </div>
        </div>
        <input type="hidden" class="form-control" id="idRegis" name="idRegis" value="<?=$funciones->encode_this_get($id)?>" />
      </form>
    </div>
    <!-- /.box -->
  </div>
  <!--/.col (left) -->
</div>
<!-- /.row -->
