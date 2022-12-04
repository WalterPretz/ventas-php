<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

if (count($arr) < 1) {
  $mensaje = "<script>Swal.fire({
  icon: 'warning',
  title: 'No hay ningún cliente registrado'
  });
</script>";
}

$htmltrow = "<tr>
  <td>%s</td>
  <td>%s</td>
  <td>%s</td>
  <td>%s</td> 
  <td>%s</td> 
  <td>%s</td>
  <td>%s</td>
  <td>%s</td> 
 </tr>\n";
$htmltrows = "";

foreach ($arr as $a) {
  $htmltrows .= sprintf($htmltrow, 
    $a['codigo'], $a['nombre'], $a['direccion'], $a['estado'], $a['numero1'], $a['id_cliente'], $a['id_cliente'], $a['id_cliente']);
}
?><!DOCTYPE html>
<html lang="es">

<head>
  <?php $this->load->view('header'); ?>
  <title>Clientes</title>
</head>
<body>
  <?php $this->load->view('menu'); ?>
<header>
  <div class="espacio container-fluid">
    <br>
    <div class="form-row">
      <div class="col-sm-4"><center><h3 style="color: #03064A"><i class="fa fa-users" style=" font-weight: bold;"></i> Listado de Clientes</h3></center></div>
      <div class="form-group col-8 col-sm-3" style=" padding-left: 1rem;"><a href="<?=$base_url?>/cliente" type="submit" class="btn btn-success botones"><i class="icon-user fa-md" style=" font-weight: bold;"></i> Registrar Cliente</a></div>
    </div>  
    </div>
  </div>
</header>
<div class="container-fluid">
<section>
  <div class="table-responsive-sm">
    <table class=" table table-striped table-bordered" id="tablax" >
    <thead> 
      <tr id="letra_info">
        <th>Código</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Estado</th>
        <th>Teléfono</th>
        <th>Detalles</th>
        <th>Editar</th>
        <th>Dar Baja</th>
      </tr>
    </thead>
    <tbody >
       <?php
          foreach ($arr as $a){
         ?>
         <tr>
          <td class='text-center'><?php echo $a['codigo'] ;?></td>
          <td><?php echo $a['nombre'] ;?></td>
          <td><?php echo $a['direccion'] ;?></td>
          <td class='text-center'><?php echo $a['estado'] ;?></td> 
          <td><?php echo $a['numero1'] ;?></td> 
          <td class='text-center'><a class="btn btn-success btn-sm" href="<?=$base_url?>/cliente/det/<?php echo $a['id_cliente']; ?>"><i class="fa fa-info-circle"></i></a></td>
          <td class='text-center'><a class='btn btn-primary btn-sm' href="<?=$base_url?>/cliente/editar/<?php echo $a['id_cliente']; ?>"><i class="fa fa-user-edit"></i></a></td>
          <td class="text-center"><a class='btn btn-danger icon-trash btn-sm' style="color: #fff;" data-toggle="modal" data-target="#eliminar" onclick="obdatosId('<?php echo $a['id_cliente'] ;?>')"><i class="fa fa-trash-alt"></i></a>
          </td>
         </tr>
      <?php } ?>
    </tbody>
    </table>
    <div class="label label-danger label-md" onclick="$(this).hide(1000)"><?=$mensaje?></div>
  </div>
</section>

</div>
<section class="container">
  <a href="<?=$base_url?>/cliente" class="badge badge-pill badge-primary botones"><i class="icon-user fa-md" style=" font-weight: bold;"></i> Registrar un nuevo Cliente</a>
</section>
<br><br>
<footer><?php $this->load->view('footer') ?></footer>
<!-- Modal eliminar-->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel">DAR DE BAJA AL CLIENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center><p style="color: #0901A4; font-weight: bold;">Detalles Generales</p></center>
        <div class="form-row">
            <div class="col-sm-8 col-8">
                <label for="fecha">Nombre del Cliente</label>
                <input type="text" class="form-control" name="cliente" id="cliente" readonly>
            </div>
            <div class="col-sm-4 col-4">
                <label for="cantidad">CUI</label>
                <input type="text" class="form-control" name="cuic" id="cuic" readonly>
            </div>
            <div class="col-sm-12 col-12">
                <label for="categoria">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" readonly>
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
                <button type="submit" class="btn btn-danger botoncito" id="enviarDato" readonly><i class="fa fa-trash-alt"></i> SI</button>
            </form>           
      </div>
    </div>
  </div>
</div>
<script>
   //datatables//
       $(document).ready(function () {
            $('#tablax').DataTable({
                order: [ 0, "desc" ],
                language: {
                    processing: "Proceso en curso...",
                    search: "Buscar&nbsp;:",
                    lengthMenu: "Agrupar por _MENU_ items",
                    info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
                    infoEmpty: "No existen datos.",
                    infoFiltered: "(filtrado de _MAX_ elementos en total)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos con tu búsqueda",
                    emptyTable: "No hay datos disponibles en la tabla.",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Ultimo"
                    },
                    aria: {
                        sortAscending: ": active para ordenar la columna en orden ascendente",
                        sortDescending: ": active para ordenar la columna en orden descendente"
                    }
                },
                scrollY: 2500,
                scrollCollapse: true,
                lengthMenu: [ [15, 30, 50, -1], [15, 30, 50, "All"] ],
            });
        });
</script>
<script>
   function obdatosId(id_cliente) {
        datos = {
            "id_cliente": id_cliente
        }

        $.ajax({
            data: datos,
            url: '<?=$base_url?>/cliente/buscarRegistro',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#id_c').val(data[0]['codigo']);
                    $('#cliente').val(data[0]['cliente']);
                    $('#cuic').val(data[0]['cui']);
                    $('#direccion').val(data[0]['direccion']);
                    if ((data[0]['venta']) == 'V') {
                      $('.botoncito').slideUp();
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'El cliente tiene una venta registrada!',
                        })
                    }else{
                      $('.botoncito').slideDown();
                    }
                }
            } 
        });
    };

     //darbaja
    $('#enviarDato').click(function(){
        $.ajax({
            url: '<?=$base_url?>/cliente/darBajaCli',
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
</script>
</body>
</html>


