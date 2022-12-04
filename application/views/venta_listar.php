<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

if (count($arr) < 1) {

  $mensaje = "<script>Swal.fire({
  icon: 'warning',
  title: 'No hay ninguna venta registrada'
  });
</script>";
}

?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Ventas</title>
</head>
<body>
  <?php $this->load->view('menu'); ?>
  <div class="espacio">
    <header><center><h3><i class="fa fa-dolly-flatbed"></i> Listado de Ventas</h3>
    <a href="<?=$base_url?>/Venta/crear" class="btn btn-primary btn-sm botones oculalimprimir" ><i class="fa fa-cart-plus"></i> Nueva venta</a></center></header>
    <div class="table-responsive-sm container-fluid" >
    <table class="table-striped table-bordered" id="tablax">
      <thead>
        <tr>
          <th class="textcenter">COD</th>
          <th class="textcenter">Fecha y Hora</th>
          <th class="textcenter">Usuario</th>
          <th class="textcenter">Nombre del Cliente</th>
          <th class="textcenter">Total</th>
          <th class="textcenter">Estado</th>
          <th class="textcenter">Ver</th>
          <th class="textcenter">Dar Baja</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($arr as $a){
         ?>
          <tr>
            <td class="textcenter"><?php echo $a['id_comprobante'] ;?></td>
            <td class="textcenter"><?php echo $a['fecha'] ;?></td>
            <td class="textcenter"><?php echo $a['usuario'] ;?></td>
            <td class="textcenter"><?php echo $a['nombreCliente'] ;?></td>
            <td class="textright">Q. <?php echo $a['total'] ;?></td>
            <td class="textcenter">
            <?php if($a['estado'] == 1){ ?>
              <span class='btn-sm btn-success'>Venta Realizada</span>         
              <?php } else{ ?>
                <p style="color: red; font-weight: bold">Dado de Baja</p>
              <?php } ?> 
            </td>
            <td class="textcenter">
              <?php if($a['estado'] == 1){ ?>
              <a class='btn btn-info' href="<?=$base_url?>/venta/mostrar/<?php echo $a['id_comprobante'] ;?>"><i class="fa fa-file-alt"></i></a>
              <?php } else{ ?>
                <center><i class="fa fa-eraser" style="color: blue;"></i></center>
              <?php } ?> 
            </td>
            <td>
            <?php if($a['estado'] == 1){ ?>
              <center><a class='btn btn-danger' style="color: #fff;" data-toggle="modal" data-target="#eliminarSum" 
              onclick="obdatosIdSum('<?php echo $a['id_comprobante'] ;?>')"><i class="fa fa-trash-alt"></i></a></center>
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
  </div>
  <!---->
  <footer class="oculalimprimir"><?php $this->load->view('footer') ?></footer>
<!-- Modal eliminar-->
<div class="modal fade" id="eliminarSum" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel">DAR DE BAJA LA VENTA REGISTRADA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center><p style="color: #0901A4; font-weight: bold;">Detalles Generales</p></center>
        <div class="form-row">
            <div class="col-sm-6 col-6">
                <label for="fecha">Nombre del Cliente</label>
                <input type="text" class="form-control" name="cliente" id="cliente" readonly>
            </div>
            <div class="col-sm-6 col-6">
                <label for="cantidad">Fecha del registro</label>
                <input type="text" class="form-control" name="fecha" id="fecha" readonly>
            </div>
        </div>
        <center><p style="color: #0901A4; font-weight: bold;">Precio</p></center>
        <div class="form-row">
             <div class="col-sm-4 col-4">
                <label for="descripcion">Total</label>
                <input type="text" class="form-control" id="total" readonly>
            </div>
            <div class="col-sm-4 col-4">
                <label for="descripcion">Estado</label>
                <input type="text" class="form-control" id="est" readonly>
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
        <center><h3 style="color: red;">¿Está seguro de eliminar el registro?</h3></center>
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">No Eliminar</button>
            <form method="POST" id="eliminarRegi" name="eliminarRegi">
                <input type="hidden" name="action" value="eliminarRegi">
                <input type="hidden" id="id_vsum" name="id_vsum" value="">
                <input type="hidden" id="id_cli" name="id_cli" value="">
                <button type="submit" class="btn btn-danger" id="enviarDatoS">SI</button>
            </form>           
      </div>
    </div>
  </div>
</div>
  <script type="text/javascript">
    //datatables//
       $(document).ready(function () {
            $('#tablax').DataTable({
                order: [ 0, "desc" ],
                language: {
                    processing: "Tratamiento en curso...",
                    search: "Buscar&nbsp;:",
                    lengthMenu: "Agrupar por _MENU_ items",
                    info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
                    infoEmpty: "No existen datos.",
                    infoFiltered: "(filtrado de _MAX_ elementos en total)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos con tu busqueda",
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
                scrollY: 1500,
                scrollCollapse: true,
                lengthMenu: [ [15, 30, 50, -1], [15, 30, 50, "All"] ],
            });
        });

  //obtener id dato selec
  function obdatosIdSum(id_comprobante) {
        datos = {
            "id_comprobante": id_comprobante
        }

        $.ajax({
            data: datos,
            url: '<?=$base_url?>/venta/buscarRegistroVenta',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#id_vsum').val(data[0]['id_comprobante']);
                    $('#fecha').val(data[0]['fecha']);
                    $('#id_cli').val(data[0]['id_cliente']);
                    $('#cliente').val(data[0]['nombreCliente']);
                    $('#total').val(data[0]['total']);
                    if ((data[0]['estado']) == 1) {
                      var estaves = "Activo";
                      $('#est').val(estaves);
                    }
                }
            } 
        });
    };

     //darbaja
    $('#enviarDatoS').click(function(){
        $.ajax({
            url: '<?=$base_url?>/venta/darBajaVenta',
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