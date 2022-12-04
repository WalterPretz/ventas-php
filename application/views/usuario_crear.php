<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
?><!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Crear Usuario</title>
</head>
<body>

<div class="container-fluid espacio">
	<?php $this->load->view('menu'); ?>
	<header>
		<h3 class="text-center"><i class="fa fa-user-plus"></i>Crear Usuario</h3>
	</header>
	<div class="formestilo">
		<h5 class="text-center"><i class="fa fa-user-tie"></i> Datos Personales</h5>
		<form action="<?=$base_url?>/usuario/crear/" method="POST">
			<div class="form-row">
				<div class="col-sm-3">
					<label for="cui"><i class="fa fa-id-card"></i> Ingrese No. del documento DPI</label>
					<input type="text" class="form-control positive" onchange="ValidarUsuario()" id="cui" name="cui" placeholder="CUI" value="<?=$cui?>" required min="1000000000000" maxlength="13">
				</div>
				<div class="col-sm-5">
					<label for="nombre"><i class="fa fa-pen-fancy"></i> Nombres</label>
					<input type="text" class="form-control" id="nombre" name="nombre" value="<?=$nombre?>" required maxlength="50">
				</div>
				<div class="col-sm-4">
					<label for="apellido"><i class="fa fa-pen-fancy"></i> Apellidos</label>
					<input type="text" class="form-control" id="apellido" name="apellido" value="<?=$apellido?>" required maxlength="50">
				</div>
			</div>
			<div class="form-row">
				<div class="col-sm-2">
					<label for="fecha_nacimiento"><i class="fa fa-calendar-day"></i> Fecha de Nacimiento</label>
					<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="" required>
				</div>
				<div class="col-sm-2">
					<label for="numero1"><i class="fa fa-mobile-alt"></i> Teléfono</label>
					<input type="text" class="form-control positive" id="numero1" name="numero1" value="<?=$numero1?>"  maxlength="8" required>
				</div>
				<div class="col-sm-2">
					<label for="numero2"><i class="fa fa-mobile"></i> Telefono 2</label>
					<input type="text" class="form-control positive" id="numero2" name="numero2" value="<?=$numero2?>" maxlength="8">
				</div>
				<div class="col-sm-6">
					<label for="direccion"><i class="fa fa-map-marked-alt"></i> Dirección</label>
					<input type="text" class="form-control" name="direccion" id="direccion" value="<?=$direccion?>" maxlength="145" required>
				</div>
			</div>
			<hr>
			<h5 class="text-center"><i class="fa fa-wrench"></i> Datos del usuario en el sistema</h5>
			<div class="form-row">
				<div class="col-sm-4">
					<label for="usuario"><i class="fa fa-users-cog"></i> Usuario</label>
					<input type="text" class="form-control" id="usuario" name="usuario" value="<?=$usuario?>" required>
				</div>
				<div class="col-sm-4">
					<label for="cargo"><i class="fa fa-user-tie"></i> Cargo que desempeña</label>
					<input type="text" class="form-control" id="cargo" name="cargo" value="<?=$cargo?>" required>
				</div>
				<div class="col-sm-4">
					<label for="rol"><i class="fa fa-users-cog"></i> Rol del usuario</label>
					<select class="form-control" name="rol" required>
						<option selected disabled>Seleccionar</option>
						<option value="Usuario">Usuario</option>
						<option value="Administrador">Administrador</option>
					</select>
				</div>
			</div>
			<div class="form row">
				<div class="col-sm-6">
					<label for="email"><i class="fa fa-envelope"></i> Correo electrónico</label>
					<input type="email" class="form-control" id="email" name="email" value="<?=$email?>" required>
				</div>
				<div class="col-sm-3">
					<label for="clave"><i class="fa fa-key"></i> Ingrese contraseña</label>
					<input type="text" class="form-control" id="clave" name="clave" value="<?=$clave?>" autocomplete="on" required>
				</div>
				<div class="col-sm-3">
					<label for="clave2"><i class="fa fa-keyboard"></i> Repita la contraseña ingresada</label>
					<input type="text" class="form-control" id="clave2" name="clave2" value="<?=$clave2?>" autocomplete="on" required>
				</div>
			</div>
			<br>
			<center>
				<button type="submit" class="btn btn-sm btn-primary" name="guardar" value="Guardar"><i class="fa fa-save"></i> Guardar registro</button>
			</center>
		</form>
		<br>
		<div class="alert alert-danger" onclick="$(this).hide(1000)"><?php echo $mensaje; ?></div>
	</div>
</div>
<br><br>

<footer><?php $this->load->view('footer') ?></footer>
<script type="text/javascript">
	function validar(){
		let cui = document.getElementById('cui').value
		window.location.href = '<?=$base_url?>/usuario/crear?cui='+cui+'';
	}
	var ValidarUsuario = function() {
	var cui = $("#cui").val();

	var request = $.ajax({
		method: "POST",
		url: "<?=$base_url?>/usuario/validar",
		data: { cui_user: cui}
	});

	request.done(function(resultado) {
		if (resultado > 0) {
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'El CUI que está ingresando ya existe! Ingrese otra.',
			})
			$(function(){$("#cui").val("");});
		}
	});
};


  $(document).ready(function(){
    validarCualquierNumero()
  });

  function validarCualquierNumero(){
    $(".numeric").numeric();
    $(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
    $(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
    $(".decimal-2-places").numeric({ decimalPlaces: 2 });
    $("#remove").click(
      function(e)
      {
        e.preventDefault();
        $(".numeric,.positive,.decimal-2-places").removeNumeric();
      }
      );
  };


</script>
</body>
</html>
