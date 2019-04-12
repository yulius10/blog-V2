<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="formEditCategories">
        <div class="box-body">
          <div class="form-group col-md-6">
            <label for="categorie">
              Categoria
            </label>
            <input type="text" class="form-control" id="categorie" name="categorie" value="<?=$categoria?>" />
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
