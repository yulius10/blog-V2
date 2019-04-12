<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="formEditSeo" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group col-md-12">
            <label for="descripcion">
              Descripcion
            </label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?=$descripcion?></textarea>
          </div>
          <div class="form-group col-md-12">
            <label for="palabrasClave">
              Palabras Clave
            </label>
            <textarea class="form-control" id="palabrasClave" name="palabrasClave" rows="3"><?=$palabrasClave?></textarea>
          </div>
          <div class="form-group col-md-12">
            <label for="google">
              Google Analitics
            </label>
            <textarea class="form-control" id="google" name="google" rows="3"><?=$googleAnalitics?></textarea>
          </div>
          <!-- /.box-body -->
          <div class="form-group col-md-12 align-items-center">
            <button type="submit" class="btn btn-primary">
              Editar
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
