<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      De todos para todos
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php if($ruta=="index.php"){ echo 'active'; }?>">
          <a class="nav-link" href="index.php">
            Inicio
          </a>
        </li>
        <!--
        <li class="nav-item <?php if($ruta=="login-register.php"){ echo 'active'; }?>">
          <a class="nav-link" href="login-register.php">
            Ingresar/Registrarse
          </a>
        </li>-->
        <li class="nav-item <?php if($ruta=="about.php"){ echo 'active'; }?>">
          <a class="nav-link" href="about.php">
            Acerca de
          </a>
        </li>
        <li class="nav-item <?php if($ruta=="contact.php"){ echo 'active'; }?>">
          <a class="nav-link" href="contact.php">
            Contáctenos
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- /Navigation -->
