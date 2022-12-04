<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
if (count($arr) < 1) {
	$mensaje = "No hay usuarios activos!";
}

$htmltrow = "<tr>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
			 	</tr>";
$htmltrows = "";
$id_usuario = '';
foreach ($arr as $a) {
	$id_usuario = $a['id_usuario'];
	$htmltrows .= sprintf($htmltrow, $a['nombre'],$a['direccion'], htmlspecialchars($a['usuario']),htmlspecialchars($a['nacimiento']), $a['cui'], $a['numero1'], $a['numero2'], $a['email'], $a['usuario'], htmlspecialchars($a['rol']), htmlspecialchars($a['cargo']));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Incersion reciente</title>
</head>
<body>
<div class="container espacio">
	<?php $this->load->view('menu'); ?>
	<header>
		<br>
		<h3 class="text-center">Datos detallados del usuario ingresado</h3>
	</header>
<br>
	<div class="table-responsive-sm">
 		<table class="table table-bordered responsive">
			<thead>
				<th>Nombre</th>
				<th>Fecha de Nacimiento</th>
				<th class="text-center">CUI</th>
				<th>Dirección</th>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $a['nombre']; ?></td>
					<td class="text-center"><?php echo $a['nacimiento']; ?></td>
					<td class="text-center"><?php echo $a['cui']; ?></td>
					<td><?php echo $a['direccion']; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="table-responsive-sm">
		<table class="table table-bordered responsive">
			<thead>
				<th class="text-center">No. de Teléfono 1</th>
				<th class="text-center">No. de Teléfono 2</th>
				<th class="text-center">Correo Electrónico</th>
				<th class="text-center">Usuario</th>
				<th class="text-center">Rol</th>
				<th>Cargo</th>
			</thead>
			<tbody>
				<tr>
					<td class="text-center"><?php echo $a['numero1']; ?></td>
					<td class="text-center"><?php echo $a['numero2']; ?></td>
					<td class="text-center"><?php echo $a['email']; ?></td>
					<td class="text-center"><?php echo $a['usuario']; ?></td>
					<td class="text-center"><?php echo $a['rol']; ?></td>
					<td><?php echo $a['cargo']; ?></td>
				</tr>
			</tbody>
		</table>
    <br><a class='btn btn-primary btn-md' href="<?=$base_url?>/usuario/listar">Listo</a>
	</div>
	<br><br><br><br><br><br>
</div>
<footer><?php $this->load->view('footer') ?></footer>
<script>
	Swal.fire({
	  position: 'top-end',
	  icon: 'success',
	  title: '<?=$mensaje?>',
	  showConfirmButton: false,
	  timer: 1500
	})
</script>
</body>
</html>
