<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio</title>
	<?php $this->load->view('header'); ?>
</head>
<body>
	<header>
		<?php $this->load->view('menu'); ?>
	</header>
	<div class="espacio">
		<br><br>
	<center><h2><strong>Bienvenido al Sistema de Ventas</strong></h2></center>
	<br>
	<section>
    <div class="card-group text-center">
      <div class="col-md-12 col-lg-3">
        <div class="card m-3"><br>
        <img class="card-img-top mb-3" src="<?=$base_url?>/recursos/img/ventap.png" alt="Card image cap" height="250px">
          <div class="card-block">
          <h4 class="card-title">Crear Venta</h4>
          <a class="btn btn-warning" href="<?=$base_url?>/venta/crear" role="button"><i class="fa fa-shopping-cart" ></i> Ingresar</a>                                  
          </div><br>
        </div>
      </div>
      <div class="col-md-12 col-lg-3">
        <div class="card m-3"><br>
        <img class="card-img-top mb-3" src="<?=$base_url?>/recursos/img/listarv.png" alt="Card image cap" height="250px">
          <div class="card-block">
          <h4 class="card-title">Listar Ventas</h4>
          <a class="btn btn-warning" href="<?=$base_url?>/venta/listar" role="button"><i class="fa fa-dolly-flatbed"></i> Ingresar</a>                                  
          </div><br>
        </div>
      </div>
      <div class="col-md-12 col-lg-3">
        <div class="card m-3"><br>
        <img class="card-img-top mb-3" src="<?=$base_url?>/recursos/img/listac.png" alt="Card image cap" height="250px">
          <div class="card-block">
          <h4 class="card-title">Listado de Clientes</h4>
          <a class="btn btn-warning" href="<?=$base_url?>/cliente/listar" role="button" ><i class="fa fa-users"></i> Ingresar</a>
          </div><br>
        </div>
      </div>
      <div class="col-md-12 col-lg-3">
        <div class="card m-3"><br>
          <img class="card-img-top mb-3" src="<?=$base_url?>/recursos/img/listap.png" alt="Card image cap" height="250px">
            <div class="card-block">
            <h4 class="card-title">Listado de Productos</h4>
            <a class="btn btn-warning" href="<?=$base_url?>/producto/listar" role="button" ><i class="fa fa-cubes"></i> Ingresar</a>
            </div><br>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <footer><?php $this->load->view('footer') ?></footer>
	<script type="text/javascript">
		const Toast = Swal.mixin({
		  toast: true,
		  position: 'top-end',
		  showConfirmButton: false,
		  timer: 3000,
		  timerProgressBar: true,
		  didOpen: (toast) => {
		    toast.addEventListener('mouseenter', Swal.stopTimer)
		    toast.addEventListener('mouseleave', Swal.resumeTimer)
		  }
		})

		Toast.fire({
		  icon: 'success',
		  title: 'Bienvenido al Sistema'
		})
	</script>
</body>
</html>