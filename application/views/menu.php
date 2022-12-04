<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style media="screen">
  <?php
  if (isset($this->session->USUARIO)) { // Sesión iniciada
    $log = "<a class=\"nav-item nav-link active\" style=\"color: white;\" href=\"${base_url}/usuario/logout\">SALIR</a>";
  }?>
</style>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark menu">
  <div class="container">
    <a class="navbar-brand" href="<?=$base_url?>/inicio"><i class="fa fa-home"></i> Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav justify-content-center me-auto mb-2 mb-lg-0">
        <?php if ($this->session->ROL == 'Administrador') { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            USUARIO
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=$base_url?>/usuario/crear"><i class="fa fa-user-plus"></i> Ingresar Usuario</a>
            <a class="dropdown-item" href="<?=$base_url?>/usuario/listar"><i class="fa fa-list-alt"></i> Listar Usuarios</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            PROVEEDOR
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=$base_url?>/proveedor"><i class="fa fa-building"></i> Ingresar Proveedor</a>
            <a class="dropdown-item" href="<?=$base_url?>/proveedor/listar"><i class="fa fa-list-alt"></i> Listar Proveedores</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           PRODUCTO
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=$base_url?>/producto"><i class="fa fa-cubes"></i> Registro de Producto</a>
            <a class="dropdown-item" href="<?=$base_url?>/producto/listar"><i class="fa fa-list-alt"></i> Listar Productos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           CLIENTE
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=$base_url?>/cliente"><i class="fa fa-user"></i> Registro de Cliente</a>
            <a class="dropdown-item" href="<?=$base_url?>/cliente/listar"><i class="fa fa-list-alt"></i> Listar Clientes</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           VENTA
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=$base_url?>/venta/crear"><i class="fa fa-shopping-cart"></i> Nueva Venta</a>
            <a class="dropdown-item" href="<?=$base_url?>/venta/listar"><i class="fa fa-list-alt"></i> Lista de Ventas</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav end">
      <li class="nav-item active">
        <a class="navbar-brand" href="<?=$base_url?>/usuario/logout">SALIR</a>
      </li>
    </ul>
    <?php } ?>
      <ul class="navbar-nav justify-content-center me-auto mb-2 mb-lg-0">
        <?php if ($this->session->ROL == 'Usuario') { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            PROVEEDOR
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=$base_url?>/proveedor"><i class="fa fa-building"></i> Ingresar Proveedor</a>
            <a class="dropdown-item" href="<?=$base_url?>/proveedor/listar"><i class="fa fa-list-alt"></i> Listar Proveedores</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           PRODUCTO
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=$base_url?>/producto"><i class="fa fa-cubes"></i> Registro de Producto</a>
            <a class="dropdown-item" href="<?=$base_url?>/producto/listar"><i class="fa fa-list-alt"></i> Listar Productos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           CLIENTE
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=$base_url?>/cliente"><i class="fa fa-user"></i> Registro de Cliente</a>
            <a class="dropdown-item" href="<?=$base_url?>/cliente/listar"><i class="fa fa-list-alt"></i> Listar Clientes</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           VENTA
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?=$base_url?>/venta/crear"><i class="fa fa-shopping-cart"></i> Nueva Venta</a>
            <a class="dropdown-item" href="<?=$base_url?>/venta/listar"><i class="fa fa-list-alt"></i> Lista de Ventas</a>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav end">
      <li class="nav-item active">
        <a class="navbar-brand" href="<?=$base_url?>/usuario/logout">SALIR</a>
      </li>
    </ul>
    <?php } ?>
    </div>
  </div>
</nav>