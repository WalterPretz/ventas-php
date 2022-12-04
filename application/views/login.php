<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
?><!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Autenticación</title>
</head>
<body class="fondoestulo">
	<?php $this->load->view('menu'); ?>
	<header class="espacio"><br>
		<center><h3>SISTEMA DE VENTAS</h3></center>
	</header>
<section class="espacio">
	<div class="abs-center">
		<div id="container-fluid">
			<div class="row">
				<form class="form-container needs-validation fondoLogin" novalidate action="<?=$base_url?>/usuario/login" method="POST">
					<div class="form-group">
						<label for="user1 validationUsername"><i class="fa fa-user-tie"></i> Usuario</label>
						<input type="text" class="form-control" placeholder="Usuario" name="usuario" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
						<div class="invalid-feedback">
					      Ingresar usuario
					    </div>
					</div>
					<div class="form-group">
						<label for="Pasword"><i class="fa fa-key"></i> Contraseña</label>
						<input type="password" class="form-control" placeholder="Contraseña" name="clave"  autocomplete="on" required>
						<div class="invalid-feedback">
					      Ingresar contraseña
					    </div>
					</div>
					<td colspan="2">
						<center><input type="submit" id="btnAL_1" class="btn btn-primary btn-md " role="button" name="login" value="Ingresar"></center>
					</td>
				</form>						
		</div>
		<div class="alert alert" role="alert" class="alert-link" style="color: #000;" onclick="$(this).hide(1000)"><h5><?=$mensaje?></h5>
	</div>
</div>
</section>
<script type="text/javascript">
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>
</html>
