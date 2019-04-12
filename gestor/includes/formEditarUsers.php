<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="formEditUsers">
        <div class="box-body">
          <div class="form-group col-md-6">
            <label for="name">
              Nombre
            </label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$nombre?>" />
          </div>
          <div class="form-group col-md-6">
            <label for="lastname">
              Apellido
            </label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?=$apellido?>" />
          </div>
          <div class="form-group col-md-6">
            <label for="mail">
              Correo
            </label>
            <input type="email" class="form-control" id="mail" name="mail" value="<?=$correo?>" />
          </div>
          <div class="form-group col-md-6">
            <label for="password">
              Contraseña
            </label>
            <input type="password" class="form-control" id="password" name="password" value="<?=$password?>" />
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
