<ul class="sidebar-menu" data-widget="tree">
  <li class="header">
    MAIN
  </li>
  <!--<li class="active treeview">-->
  <li <?php if(basename($_SERVER['PHP_SELF']) == "panel.php"){ echo "class='active treeview'"; } ?>>
    <a href="panel.php">
      <i class="fa fa-desktop">
      </i>
      <span>
        Panel
      </span>
    </a>
  </li>
  <li class='treeview'>
    <a href="#">
      <i class="fa fa-users">
      </i>
      <span>
        Administracion
      </span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right">
        </i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li <?php if(basename($_SERVER['PHP_SELF']) == "auditoria.php"){ echo "class='active treeview'"; } ?>>
        <a href="auditoria.php">
          <i class="fa fa-black-tie">
          </i>
          Auditoria
        </a>
      </li>
    </ul>
  </li>
  <li <?php if(basename($_SERVER['PHP_SELF']) == "blog.php"){ echo "class='active treeview'"; } ?>>
    <a href="blog.php">
      <i class="fa fa-newspaper-o">
      </i>
      <span>
        Blog
      </span>
    </a>
  </li>
  <li <?php if(basename($_SERVER['PHP_SELF']) == "categories.php"){ echo "class='active treeview'"; } ?>>
    <a href="categories.php">
      <i class="fa fa-newspaper-o">
      </i>
      <span>
        Categorias
      </span>
    </a>
  </li>
  <li <?php if(basename($_SERVER['PHP_SELF']) == "users.php"){ echo "class='active treeview'"; } ?>>
    <a href="users.php">
      <i class="fa fa-newspaper-o">
      </i>
      <span>
        Usuarios
      </span>
    </a>
  </li>
  <li <?php if(basename($_SERVER['PHP_SELF']) == "SEO.php"){ echo "class='active treeview'"; } ?>>
    <a href="SEO.php">
      <i class="fa fa-newspaper-o">
      </i>
      <span>
        SEO
      </span>
    </a>
  </li>
  <li <?php if(basename($_SERVER['PHP_SELF']) == "#"){ echo "class='active treeview'"; } ?>>
    <a href="#">
      <i class="fa fa-newspaper-o">
      </i>
      <span>
        Comentarios Articulos
      </span>
    </a>
  </li>
</ul>
