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
			 	</tr>";
$htmltrows = "";
$id_usuario = '';
foreach ($arr as $a) {
	$id_usuario = $a['id_usuario'];
	$htmltrows .= sprintf($htmltrow, $a['nombre'], $a['cui'], $a['numero'], $a['usuario'], $a['rol']);
}
?><!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Diaco - Usuarios</title>
	<?php $this->load->view('header'); ?>
</head>
<body>
	<?php $this->load->view('menu'); ?>
	<div class="espacio container-fluid">
		<center><h4>Listado de usuarios registrados en el sistema</h4></center>
		<div>
		  	<table class=" table table-striped table-bordered table-responsive-sm"  id="tablax">
		    <thead> 
		      <tr id="letra_info">
		        <th>No.</th>
		        <th>Nombre</th>
		        <th>CUI</th>
		        <th>Teléfono</th>
		        <th>Usuario</th>
		        <th>Rol</th>
		        <th>Editar</th>
		        <th>Detalle</th>
		        <th>Dar Baja</th>
		      </tr>
		    </thead>
		    <tbody >
		       <?php
		          foreach ($arr as $a){
		         ?>
		         <tr>
		          <td class='text-center'><?php echo $a['id_usuario'];?></td>
		          <td><?php echo $a['nombre'] ;?></td>
		          <td><?php echo $a['cui'] ;?></td>
		          <td class='text-center'><?php echo $a['numero'] ;?></td> 
		          <td><?php echo $a['usuario'] ;?></td> 
		          <td><?php echo $a['rol'] ;?></td> 
		          <td class='text-center'><a class="btn btn-success btn-sm" data-toggle="modal" data-target="#actualizar" onclick="obdatosIdActualizar('<?php echo $a['id_usuario'] ;?>')"><i class="fa fa-edit"></i></a></td>
		          <td class='text-center'><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detalle" onclick="obdatosIdDetalle('<?php echo $a['id_usuario'] ;?>')"><i class="fa fa-info-circle"></i></a></td>
		          <td class='text-center'><a class='btn btn-danger btn-sm' data-toggle="modal" data-target="#eliminar" onclick="obdatosId('<?php echo $a['id_usuario'] ;?>')"><i class="fa fa-trash-alt"></i></a></td>
		         </tr>
		      <?php } ?>
		    </tbody>
		    </table>
		    <div class="label label-danger label-md" onclick="$(this).hide(1000)"><?=$mensaje?></div>
		</div>
	</div>
	<!-- Modal eliminar-->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel">DAR DE BAJA AL USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center><p style="color: #0901A4; font-weight: bold;">Detalles Generales</p></center>
        <div class="form-row">
            <div class="col-sm-8 col-8">
                <label for="fecha">Nombre del Usuario</label>
                <input type="text" class="form-control" name="nombreu" id="nombreu" readonly>
            </div>
            <div class="col-sm-4 col-4">
                <label for="cantidad">CUI</label>
                <input type="text" class="form-control" name="cuiu" id="cuiu" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-4 col-12">
                <label for="categoria">Teléfono</label>
                <input type="text" class="form-control" id="telefonou" name="telefonou" readonly>
            </div>
            <div class="col-sm-4 col-12">
                <label for="categoria">Usuario</label>
                <input type="text" class="form-control" id="usuariou" name="usuariou" readonly>
            </div>
            <div class="col-sm-4 col-12">
                <label for="categoria">Rol</label>
                <input type="text" class="form-control" id="rolu" name="rolu" readonly>
            </div>
            <input type="hidden" id="venta">
            <center></center>
            <div class="col-sm-12 col-12">
                <label for="usuario">Usuario quién elimina el registro:</label>
                <p><strong><?php echo $this->session->NOMBRE ?></strong></p>
            </div>
        </div>
        <div>
          <br>
        <center><h3 style="color: red;">¿Está seguro de eliminar el registro?</h3></center>
        </div>
        <br>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">No Eliminar</button>
            <form method="POST" id="eliminarRegi" name="eliminarRegi">
                <input type="hidden" name="action" value="eliminarRegi">
                <input type="hidden" id="id_c" name="id_c" value="">
                <button type="submit" class="btn btn-danger botoncito" id="enviarDato" readonly>SI</button>
            </form>           
      </div>
    </div>
  </div>
</div>
<!-- Modal actualizar-->
<div class="modal fade" id="actualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color: green; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR DATOS DEL USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
			<h5 class="text-center"><i class="fa fa-user-tie"></i> Datos Personales</h5>
			<form action="actualizar_registro" name="form_actualizar_usuario" id="form_actualizar_usuario">
				<input type="hidden" name="action" value="actualizar_registro" >
				<input type="hidden" id="id_usuarioa" name="id_usuarioa" value="">
				<input type="hidden" id="id_persona" name="id_persona" value="">
				<div class="form-row">
					<div class="col-sm-3">
						<label for="cui"><i class="fa fa-id-card"></i> No. del documento DPI</label>
						<input type="text" class="form-control positive" onchange="ValidarUsuario()" id="cui" name="cui" placeholder="CUI" value="" required min="1000000000000" maxlength="13">
					</div>
					<div class="col-sm-5">
						<label for="nombre"><i class="fa fa-pen-fancy"></i> Nombres</label>
						<input type="text" class="form-control" id="nombre" name="nombre" value="" required maxlength="50">
					</div>
					<div class="col-sm-4">
						<label for="apellido"><i class="fa fa-pen-fancy"></i> Apellidos</label>
						<input type="text" class="form-control" id="apellido" name="apellido" value="" required maxlength="50">
					</div>
				</div>
				<div class="form-row">
					<div class="col-sm-2">
						<label for="fecha_nacimiento"><i class="fa fa-calendar-day"></i> Fecha de Nacimiento</label>
						<input type="date" class="form-control" id="nacimiento" name="nacimiento" value="" required>
					</div>
					<div class="col-sm-2">
						<label for="numero1"><i class="fa fa-mobile-alt"></i> Teléfono</label>
						<input type="text" class="form-control positive" id="numero1" name="numero1" value=""  maxlength="8" required>
					</div>
					<div class="col-sm-2">
						<label for="numero2"><i class="fa fa-mobile"></i> Telefono 2</label>
						<input type="text" class="form-control positive" id="numero2" name="numero2" value="" maxlength="8">
					</div>
					<div class="col-sm-6">
						<label for="direccion"><i class="fa fa-map-marked-alt"></i> Dirección</label>
						<textarea type="text" class="form-control" name="direccion" id="direccion" value="" maxlength="145" required></textarea>
					</div>
				</div>
				<hr>
				<h5 class="text-center"><i class="fa fa-wrench"></i> Datos del usuario en el sistema</h5>
				<div class="form-row">
					<div class="col-sm-4">
						<label for="usuario"><i class="fa fa-users-cog"></i> Usuario</label>
						<input type="text" class="form-control" id="usuario" name="usuario" value="" required>
					</div>
					<div class="col-sm-4">
						<label for="cargo"><i class="fa fa-user-tie"></i> Cargo que desempeña</label>
						<input type="text" class="form-control" id="cargo" name="cargo" value="" required>
					</div>
					<div class="col-sm-4">
						<label for="rol"><i class="fa fa-users-cog"></i> Rol del usuario</label>
						<select name="rol" class="custom-select form-control"  required>
							<option id="rol" value=""></option>
							<option value="Usuario">Usuario</option>
							<option value="Administrador">Administrador</option>
						</select>
					</div>
				</div>
				<div class="form row">
					<div class="col-sm-6">
						<label for="email"><i class="fa fa-envelope"></i> Correo electrónico</label>
						<input type="email" class="form-control" id="email" name="email" value="" required>
					</div>
				</div>
				<br>
				<center>
					<button type="submit" class="btn btn-primary botoncito" id="actualizarDatos" readonly><i class="fa fa-sync-alt"></i> Actualizar</button>
				</center>
			</form>
		</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-warning" data-dismiss="modal">No actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal ver datos del usuario-->
<div class="modal fade" id="detalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color: blue; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel">DATOS DETALLADOS DEL USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
			<h5 class="text-center"><i class="fa fa-user-tie"></i> Datos Personales</h5>
				<div class="form-row">
					<div class="col-sm-3">
						<label for="cui"><i class="fa fa-id-card"></i> No. del documento DPI</label>
						<input type="text" class="form-control positive" id="cuid" value="" readonly>
					</div>
					<div class="col-sm-5">
						<label for="nombre"><i class="fa fa-pen-fancy"></i> Nombres</label>
						<input type="text" class="form-control" id="nombred" value="" readonly>
					</div>
					<div class="col-sm-4">
						<label for="apellido"><i class="fa fa-pen-fancy"></i> Apellidos</label>
						<input type="text" class="form-control" id="apellidod" value="" readonly>
					</div>
				</div>
				<div class="form-row">
					<div class="col-sm-2">
						<label for="fecha_nacimiento"><i class="fa fa-calendar-day"></i> Fecha de Nacimiento</label>
						<input type="date" class="form-control" id="nacimientod" value="" readonly>
					</div>
					<div class="col-sm-2">
						<label for="numero1"><i class="fa fa-mobile-alt"></i> Teléfono</label>
						<input type="text" class="form-control" id="numero1d" value="" readonly>
					</div>
					<div class="col-sm-2">
						<label for="numero2"><i class="fa fa-mobile"></i> Telefono 2</label>
						<input type="text" class="form-control" id="numero2d" value="" readonly>
					</div>
					<div class="col-sm-6">
						<label for="direccion"><i class="fa fa-map-marked-alt"></i> Dirección</label>
						<textarea type="text" class="form-control" id="direcciond" value=""  readonly></textarea>
					</div>
				</div>
				<hr>
				<h5 class="text-center"><i class="fa fa-wrench"></i> Datos del usuario en el sistema</h5>
				<div class="form-row">
					<div class="col-sm-4">
						<label for="usuario"><i class="fa fa-users-cog"></i> Usuario</label>
						<input type="text" class="form-control" id="usuariod" value="" readonly>
					</div>
					<div class="col-sm-4">
						<label for="cargo"><i class="fa fa-user-tie"></i> Cargo que desempeña</label>
						<input type="text" class="form-control" id="cargod" value="" readonly>
					</div>
					<div class="col-sm-4">
						<label for="rol"><i class="fa fa-users-cog"></i> Rol del usuario</label>
						<input type="text" class="form-control" id="rold" readonly>
					</div>
				</div>
				<div class="form row">
					<div class="col-sm-6">
						<label for="email"><i class="fa fa-envelope"></i> Correo electrónico</label>
						<input type="email" class="form-control" id="emaild" value="" readonly>
					</div>
				</div>
		</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-warning" data-dismiss="modal" id="limpiar"><i class="fa fa-sign-out-alt"></i> Salir</button>
      </div>
    </div>
  </div>
</div>
	<script>
		
//buscar usuario antes de eliminar
        function obdatosId(id_usuario) {
        datos = {
            "id_usuario": id_usuario
        }

        $.ajax({
            data: datos,
            url: '<?=$base_url?>/usuario/buscarRegistro',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#id_c').val(data[0]['id_usuario']);
                    $('#nombreu').val(data[0]['nombre']);
                    $('#cuiu').val(data[0]['cui']);
                    $('#telefonou').val(data[0]['numero']);
                    $('#usuariou').val(data[0]['usuario']);
                    $('#rolu').val(data[0]['rol']);
                }
            } 
        });
    };

      //darbaja
    $('#enviarDato').click(function(){
        $.ajax({
            url: '<?=$base_url?>/usuario/darBajaUser',
            type: "POST",
            async: true,
            data: $('#eliminarRegi').serialize(),

            success: function(response){
                data = $.parseJSON(response);
                    if(data.length > 0){
                    console.log(response);
                }
            }
        });
    });


    //buscar usuario para actualizar los datos
        function obdatosIdActualizar(id_usuario) {
        datos = {
            "id_usuario": id_usuario
        }

        $.ajax({
            data: datos,
            url: '<?=$base_url?>/usuario/buscarRegistroUsuario',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#id_usuarioa').val(data[0]['id_usuario']);
                    $('#id_persona').val(data[0]['id_persona']);
                    $('#cui').val(data[0]['cui']);
                    $('#cargo').val(data[0]['cargo']);
                    $('#usuario').val(data[0]['usuario']);
                    $('#rol').html(data[0]['rol']);
                    $('#nombre').val(data[0]['nombre']);
                    $('#apellido').val(data[0]['apellido']);
                    $('#nacimiento').val(data[0]['nacimiento']);
                    $('#direccion').val(data[0]['direccion']);
                    $('#numero1').val(data[0]['numero1']);
                    $('#numero2').val(data[0]['numero2']);
                    $('#email').val(data[0]['email']);
                }
            } 
        });
    };

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
				  text: 'El Código que está ingresando ya existe! Ingrese otra.',
				})
				$(function(){$("#cui").val("");});
			}
		});
	};

	//actualizad datos del cliente
	//guardarventa
  $('#form_actualizar_usuario').submit(function(e){
    e.preventDefault();

    $.ajax({
      url: '<?=$base_url?>/usuario/actualizarUsuario',
        type: "POST",
        async: true,
        data: $('#form_actualizar_usuario').serialize(),
         
        success: function(response){
          if (response != 'error') {
            redlistar()   
          }
        }
    });
  });

  function redlistar(){
  window.location.href='<?=$base_url?>/usuario/listar';
};

function obdatosIdDetalle(id_usuario) {
        datos = {
            "id_usuario": id_usuario
        }

        $.ajax({
            data: datos,
            url: '<?=$base_url?>/usuario/buscarRegistroUsuario',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#cuid').val(data[0]['cui']);
                    $('#cargod').val(data[0]['cargo']);
                    $('#usuariod').val(data[0]['usuario']);
                    $('#rold').val(data[0]['rol']);
                    $('#nombred').val(data[0]['nombre']);
                    $('#apellidod').val(data[0]['apellido']);
                    $('#nacimientod').val(data[0]['nacimiento']);
                    $('#direcciond').val(data[0]['direccion']);
                    $('#numero1d').val(data[0]['numero1']);
                    $('#numero2d').val(data[0]['numero2']);
                    $('#emaild').val(data[0]['email']);
                }
            } 
        });
    };

	</script>
</body>
</html>