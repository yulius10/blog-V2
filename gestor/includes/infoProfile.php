<section class="content-header">
  <h1>
    Profile
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-dashboard">
        </i>
        Panel
      </a>
    </li>
    <li class="active">
      Profile
    </li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="dist/img/user4-128x128.jpg" alt="User profile picture" />
          <h3 class="profile-username text-center">
            <?=$usuario?>
          </h3>
          <p class="text-muted text-center">
            Correo: <?=$correo?>
          </p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
