<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
	<title>Venta UMG</title>
	<?php $this->load->view('header'); ?>
</head>
<body>
	<header>
		<?php $this->load->view('menu'); ?>
	</header>
	<div class="espacio">
		<div >
			<div>
				<br>
				<center><strong><h1>Sistema de Ventas</h1></strong></center>
				<br>
			<center>
				<img src="<?=$base_url?>/recursos/img/venta.png" alt="" class="imagen" >
			</center>
			</div>
			<br><br>
			<center>
				<?php
	            if (isset($this->session->USUARIO)) { ;?>
	                <a class="btn btn-success btn-lg" style="display: none;" href="<?=$base_url?>/inicio">Incio</a>
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
	                <?php }else{ ; ?>
	                <a class="btn btn-success btn-lg" href="<?=$base_url?>/usuario/login">INGRESAR AL SISTEMA</a>
	            <?php }; ?>
			</center>

		</div>
	</div>
	<br><br><hr><br><br>

	<footer><?php $this->load->view('footer') ?></footer>
</body>
</html>