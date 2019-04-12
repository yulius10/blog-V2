<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Auditoria
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-desktop">
        </i>
        Panel
      </a>
    </li>
    <li class="active">
      Auditoria
    </li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>
                Transaccion
              </th>
              <th>
                Sql ejecutado
              </th>
              <th>
                Tabla
              </th>
              <th>
                Auditoria del cliente
              </th>
            </tr>
            </thead>
            <tbody>
              <?php
              if($resultados){
                while($registros = mysqli_fetch_array($resultados)){
                ?>
              <tr>
                <td>
                  <?php
                  if($registros["tra_aud"]=="1"){
                    echo "Consulta";
                  }
                  if($registros["tra_aud"]=="2"){
                    echo "Edicion";
                  }
                  if($registros["tra_aud"]=="3"){
                    echo "Insertar";
                  }
                  ?>
                </td>
                <td>
                  <?=$registros["sql_aud"]?>
                </td>
                <td>
                  <?=$registros["tab_aud"]?>
                </td>
                <td>
                  <?=$registros["cli_aud"]?>
                </td>
              </tr>
              <?php
                }
              }
              else{
                echo "No existen registros.";
              }
            ?>
          </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
