<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

if (count($arr) < 1) {

  $mensaje = 
"<script>Swal.fire(
  'No hay ningún proveedor registrado'
);
</script>";

}

?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Proveedores</title>
</head>
<body>
  <?php $this->load->view('menu'); ?>
<div class="container">
<header class="espacio">
  <h3 style="color: #03064A"><i class="icon-briefcase fa-md" style=" font-weight: bold;"></i> Listado general de Proveedores</h3>
</header>
<br>
<section>
  <div class="table-responsive-sm">
    <table class="table table-striped table-bordered">
    <thead> 
      <tr id="letra_info">
        <th>Institución</th>
        <th>Dirección</th>
        <th>Teléfono</th>
        <th>Producto</th>
        <th>correo</th>
        <th>Acción</th>
        <th>Actualizar</th>
      </tr>
    </thead>
    <tbody>
      <?php
          foreach ($arr as $a){
         ?>
          <tr>
            <td><?php echo $a['nombre'] ;?></td>
            <td><?php echo $a['direccion'] ;?></td>
            <td><?php echo $a['telefono'] ;?></td>
            <td><?php echo $a['tipo'] ;?></td>
            <td><?php echo $a['correo'] ;?></td>
            <td class="oculalimprimir"><center><a class='btn btn-primary btn-sm' style="color: #fff;" data-toggle="modal" data-target="#actualizar" 
                  onclick="obdatosIdprov('<?php echo $a['id_proveedor'] ;?>')"><i class="fa fa-user-edit"></i></a></center></td>
            <td>
            <?php if($a['estado'] == 'Activo'){ ?>
                  <center><a class='btn btn-danger btn-sm' style="color: #fff;" data-toggle="modal" data-target="#eliminarSum" 
                  onclick="obdatosIdSum('<?php echo $a['id_proveedor'] ;?>')"><i class="fa fa-trash-alt"></i></a></center>
                  <?php } else{ ?>
                    <center><i class="fa fa-eraser" style="color: blue;"></i></center>
            <?php } ?> 
            </td>
          </tr>
         <?php
            }
          ?>
    </tbody>
    </table>
    <div class="label label-danger label-md" onclick="$(this).hide(1000)"><?=$mensaje?></div>
  </div>
</section>

</div>
<section class="container">
  <a href="<?=$base_url?>/proveedor" class=" btn btn-primary botones"><i class="icon-user-follow fa-md" style=" font-weight: bold;"></i> Registrar Proveedor</a>
</section>
<br>
<footer><?php $this->load->view('footer') ?></footer>
<section>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <form action="" method="POST" name="form_anular_factura" id="anularCompro" onsubmit="event.preventDefault(); anularCompro();">
                <center><h1><i class="fa fa-sync-alt" style="font-size: 45pt;"></i><br> Convertir en Cotización</h1>
                </center>
                <div class="form-row">
                  <div class="col-sm-6"><label for="numero"><i class="fa fa-hashtag"></i> Número</label><input type="text" class="form-control" id="id_comprobante" readonly></div>
                  <div class="col-sm-6"><label for="monto"><i class="fa fa-cash-register"></i> Monto en Q.</label><input type="text" class="form-control" id="totalComprobante" readonly></div>
                </div>
                 <div class="form-row">
                  <div class="col-sm-12"><label for="fecha"><i class="fa fa-calendar-day"></i> <i class="fa fa-clock"></i> Fecha y Hora de la cotización</label><input type="text" class="form-control" id="fecha" readonly></div>
                </div>
                <input type="hidden" name="action" value="anularCompro">
                <input type="hidden" name="no_compro" id="no_compro" value="id_comprobante" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-danger botones"><i class="fa fa-sync-alt"></i> Convertir en Cotización</button>
        </form>
            <button type="button" class="btn btn-sm btn-primary botones" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Modal eliminar-->
<div class="modal fade" id="eliminarSum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel">DAR DE BAJA Al PROVEEDOR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center><p style="color: #0901A4; font-weight: bold;">Detalles Generales</p></center>
        <div class="form-row">
            <div class="col-sm-6 col-6">
                <label for="fecha">Nombre del Proveedor</label>
                <input type="text" class="form-control" name="nombre" id="nombre" readonly>
            </div>
            <div class="col-sm-6 col-6">
                <label for="cantidad">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="direccion" readonly>
            </div>
        </div>
        <div class="form-row">
             <div class="col-sm-4 col-4">
                <label for="descripcion">Teléfono</label>
                <input type="text" class="form-control" id="telefono" readonly>
            </div>
            <div class="col-sm-4 col-4">
                <label for="descripcion">Tipo</label>
                <input type="text" class="form-control" id="tipo" readonly>
            </div>
             <div class="col-sm-4 col-4">
                <label for="descripcion">Correo</label>
                <input type="text" class="form-control" id="correo" readonly>
            </div>
        </div>
        <center>__________________________</center>
        <div class="form-row">
            <div class="col-sm-12 col-12">
                <label for="usuario">Usuario quién elimina el registro:</label>
                <p><strong><?php echo $this->session->NOMBRE ?></strong></p>
            </div>
        </div>
        <div>
          <br>
        <center><h3 style="color: red;">¿Está seguro de dar baja al registro?</h3></center>
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">No Eliminar</button>
            <form method="POST" id="eliminarRegi" name="eliminarRegi">
                <input type="hidden" name="action" value="eliminarRegi">
                <input type="hidden" id="id_prov" name="id_prov" value="">
                <button type="submit" class="btn btn-danger" id="enviarDatoS">SI</button>
            </form>           
      </div>
    </div>
  </div>
</div>
<!-- Modal actualziar-->
<div class="modal fade" id="actualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #00086C; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR DATOS DEL PROVEEDOR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center><p style="color: #0901A4; font-weight: bold;">Detalles Generales</p></center>
      <form method="POST" id="actualizarRe" name="actualizarRe">
        <input type="hidden" name="action" value="update">
        <input type="hidden" id="id_proveedor" name="id_proveedor" value="">
        <div class="form-row">
            <div class="col-sm-12 col-12">
                <label for="fecha">Nombre del Proveedor</label>
                <input type="text" class="form-control" name="nombreE" id="nombreE" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-12 col-12">
                <label for="cantidad">Dirección</label>
                <input type="text" class="form-control" name="direccionE" id="direccionE" required>
            </div>
        </div>
        <div class="form-row">
             <div class="col-sm-4 col-4">
                <label for="descripcion">Teléfono</label>
                <input type="text" class="form-control" name="telefonoE" id="telefonoE" required>
            </div>
            <div class="col-sm-4 col-4">
                <label for="descripcion">Tipo</label>
                <input type="text" class="form-control" name="tipoE" id="tipoE" required>
            </div>
             <div class="col-sm-4 col-4">
                <label for="descripcion">Correo</label>
                <input type="text" class="form-control" name="correoE" id="correoE" required>
            </div>
        </div>
        <center>__________________________</center>
        <div class="form-row">
            <div class="col-sm-12 col-12">
                <label for="usuario">Usuario quién edita el registro:</label>
                <p><strong><?php echo $this->session->NOMBRE ?></strong></p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">No Actualizar</button>
            <button type="submit" class="btn btn-success" id="updateData"><i class="fa fa-sync-alt"></i> Actualizar Registro</button>
      </form>           
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
      //obtener id dato selec
  function obdatosIdSum(id_proveedor) {
        datos = {
            "id_proveedor": id_proveedor
        }
        $.ajax({
            data: datos,
            url: '<?=$base_url?>/proveedor/buscarRegistro',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#id_prov').val(data[0]['id_proveedor']);
                    $('#nombre').val(data[0]['nombre']);
                    $('#direccion').val(data[0]['direccion']);
                    $('#telefono').val(data[0]['telefono']);
                    $('#tipo').val(data[0]['tipo']);
                    $('#correo').val(data[0]['correo']);
                }
            } 
        });
    };

     //darbaja
    $('#enviarDatoS').click(function(){
        $.ajax({
            url: '<?=$base_url?>/proveedor/cambioEstadoProveedor',
            type: "POST",
            async: true,
            data: $('#eliminarRegi').serialize(),

            success: function(response){
            }
        });
    });

    function obdatosIdprov(id_proveedor) {
        datos = {
            "id_proveedor": id_proveedor
        }
        $.ajax({
            data: datos,
            url: '<?=$base_url?>/proveedor/buscarRegistro',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#id_proveedor').val(data[0]['id_proveedor']);
                    $('#nombreE').val(data[0]['nombre']);
                    $('#direccionE').val(data[0]['direccion']);
                    $('#telefonoE').val(data[0]['telefono']);
                    $('#tipoE').val(data[0]['tipo']);
                    $('#correoE').val(data[0]['correo']);
                }
            } 
        });
    };

    //actualizar
    $('#updateData').click(function(){
        $.ajax({
            url: '<?=$base_url?>/proveedor/editarProveedor',
            type: "POST",
            async: true,
            data: $('#actualizarRe').serialize(),

            success: function(response){
            }
        });
    });

</script>
</body>
</html>

