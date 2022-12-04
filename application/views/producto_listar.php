<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
if (count($arr) < 1) {
  $mensaje = "<script>Swal.fire({
  icon: 'warning',
  title: 'No hay ningún producto registrado'
  });
</script>";

};
?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Productos</title>
</head>
<body>
  <?php $this->load->view('menu'); ?>
  <header class="espacio">
  <div>
    <h5 style="color: #03064A" class="text-center"><i class="fa fa-cubes"></i> Listado de Productos</h5>
    <hr>
  </div>
  </header>
<section class="container-fluid">
  <?php $numero  = count($arr); ?>
  <div class="form-row">
    <div class="col-sm-7">
      <div>
      <a href="<?=$base_url?>/producto" class="btn btn-primary btn-sm botones"><i class="icon-pencil fa-md" style="font-weight: bold;"></i> Registrar Producto</a>
      <a href="<?=$base_url?>/producto/detalleGeneral" class="btn btn-warning btn-sm botones"><i class="icon-magnifier-add fa-md" style="font-weight: bold;"></i> Datos Detallados</a>
      </div>
      <br>
    </div>
  </div>
</section>
<section>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0" id="productos">
                  <thead>
                    <tr>
                      <th class='text-center'>CÓDIGO</th>
                      <th>DESCRIPCIÓN</th>
                      <th>PRECIO VENTA</th>
                      <th class='text-center'>EXISTENCIA</th>
                      <th>IMÁGEN</th>
                      <th>EDITAR</th>
                      <th>ELIMINAR</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($arr as $a){
                        $direccion ='/ventas-umg/recursos/upload/';
                        $imagen = $direccion.$a['imagen'];
                      ?>
                      <tr>
                        <td class='text-center'><?php echo $a['codigo'] ;?></td>
                        <td><?php echo $a['descripcion'] ;?></td>
                        <td class='text-right'>Q. <?php echo number_format($a['precio'], 2, '.', ' ') ;?></td> 
                        <td class='text-center'>
                          <?php if ($a['existencia'] == 0) { ?>
                            <h6 style="color: red;">No hay productos <p style="color: blue; font-weight: bold;">¡Actualizar!</p></h6>
                          <?php } else { ?>
                            <?php echo $a['existencia'] ;?>
                          <?php } ?>
                        </td>
                        <td class='text-center'><img src="<?php echo $imagen ;?>" alt="" height="100px"></td> 
                        <td class='text-center'><a class='btn btn-primary' style="color: #fff;" data-toggle="modal" data-target="#updateProd" onclick="obdatosIdprodUp('<?php echo $a['id_producto'] ;?>')"><i class="fa fa-edit"></i></a></td> 
                        <td><center>
                          <a class='btn btn-danger' style="color: #fff;" data-toggle="modal" data-target="#eliminarProd" onclick="obdatosIdprod('<?php echo $a['id_producto'] ;?>')"><i class="fa fa-trash-alt"></i></a></center>
                        </td> 
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div class="label label-danger label-md" onclick="$(this).hide(1000)"><?=$mensaje?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<footer><?php $this->load->view('footer') ?></footer>
<!-- Modal eliminar-->
<div class="modal fade" id="eliminarProd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel">DAR DE BAJA AL PRODUCTO REGISTRADO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center><p style="color: #0901A4; font-weight: bold;">Detalles Generales</p></center>
        <div class="form-row">
            <div class="col-sm-6 col-6">
                <label for="fecha">Código del Producto</label>
                <input type="text" class="form-control" id="codigo" readonly>
            </div>
            <div class="col-sm-6 col-6">
                <label for="cantidad">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" readonly>
            </div>
        </div>
        <center><p style="color: #0901A4; font-weight: bold;">Precio</p></center>
        <div class="form-row">
            <div class="col-sm-6 col-6">
                <label for="cantidad">Descripción del Producto</label>
                <input type="text" class="form-control" id="descripcion" readonly>
            </div>
             <div class="col-sm-3 col-3">
                <label for="descripcion">Precio</label>
                <input type="text" class="form-control" id="precio" readonly>
            </div>
            <div class="col-sm-3 col-3">
                <label for="descripcion">Existencia</label>
                <input type="text" class="form-control" id="existencia" readonly>
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
                <input type="hidden" id="id_prod" name="id_prod" value="">
                <button type="submit" class="btn btn-danger" id="enviarDatoP">SI</button>
            </form>           
      </div>
    </div>
  </div>
</div>
<!-- Modal actualizar-->
<div class="modal fade" id="updateProd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#000979; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR REGISTRO DEL PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center><p style="color: #0901A4; font-weight: bold;">Detalles Generales</p></center>
        <form method="POST" id="actualizarProducto" name="actualizarProducto">
          <input type="hidden" name="action" value="updateRegi">
          <input type="hidden" id="id_producto" name="id_producto" value="">
        <div class="form-row">
            <div class="col-sm-4 col-4">
                <label for="fecha" class="result">Código del Producto</label>
                <input type="text" class="form-control resul" onchange="validarCodigo()" id="codigoup" name="codigoup" value="" readonly>
            </div>
            <div class="col-sm-8 col-8">
                <label for="cantidad" class="result">Nombre del Producto</label>
                <input type="text" class="ford resul" id="nombreup" name="nombreup" value="" required>
            </div>
        </div>
          <div class="form-row">
            <div class="col-sm-12 col-12">
                <label for="cantidad" class="result">Descripción del Producto</label>
                <input type="text" class="ford resul" id="descripcionup" name="descripcionup" value="" required>
            </div>
          </div>
          <div class="form-row">
            <div class="col-sm-3 col-3">
                <label for="descripcion" class="result">Precio Compra</label>
                <input type="text" class="ford resul positive decimal-2-places" id="precioc" name="preciouc" value="" required>
            </div>
            <div class="col-sm-3 col-3">
                <label for="descripcion" class="result">Precio Venta</label>
                <input type="text" class="ford resul positive decimal-2-places" id="preciov" name="preciov" value="" required>
            </div>
            <div class="col-sm-3 col-3">
                <label for="descripcion" class="result">Existencia</label>
                <input type="text" class="ford resul positive" id="existenciaup" name="existenciaup" value="" maxlength="10" required>
            </div>
        </div>
        <center>__________________________</center>
        <div class="form-row">
            <div class="col-sm-12 col-12">
                <label for="usuario">Usuario quién actualiza el registro:</label>
                <p><strong><?php echo $this->session->NOMBRE ?></strong></p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-sign-out-alt" style="font-weight: bold;"></i> No actualizar</button>
        <button type="submit" class="btn btn-success" id="actualizarDatos"><i class="fa fa-sync-alt"></i> Actualizar Registro</button>
      </form>           
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    $('#productos').DataTable({
      "scrollX": true,
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
        scrollY: 2500,
        scrollCollapse: true,
        lengthMenu: [ [15, 30, 50, -1], [15, 30, 50, "All"] ],
    });
});

//obtener id dato selec
  function obdatosIdprod(id_producto) {
        datos = {
            "id_producto": id_producto
        }
        $.ajax({
            data: datos,
            url: '<?=$base_url?>/producto/buscarRegistroProducto',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#id_prod').val(data[0]['id_producto']);
                    $('#codigo').val(data[0]['codigo']);
                    $('#nombre').val(data[0]['nombreProducto']);
                    $('#descripcion').val(data[0]['descripcion']);
                    $('#precio').val(data[0]['precio']);
                    $('#existencia').val(data[0]['existencia']);
                }
            } 
        });
    };

     //darbaja
    $('#enviarDatoP').click(function(){
        $.ajax({
            url: '<?=$base_url?>/producto/daraBajaProd',
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

    //obtener id dato selec
  function obdatosIdprodUp(id_producto) {
        datos = {
            "id_producto": id_producto
        }
        $.ajax({
            data: datos,
            url: '<?=$base_url?>/producto/buscarRegistroProducto',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#id_producto').val(data[0]['id_producto']);
                    $('#codigoup').val(data[0]['codigo']);
                    $('#nombreup').val(data[0]['nombreProducto']);
                    $('#descripcionup').val(data[0]['descripcion']);
                    $('#precioc').val(data[0]['precio_compra']);
                    $('#preciov').val(data[0]['precio']);
                    $('#existenciaup').val(data[0]['existencia']);
                }
            } 
        });
    };

    //validar campos
  $(document).ready(function(){
    validarCualquierNumero()
  });

  function validarCualquierNumero(){
    $(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
    $(".decimal-2-places").numeric({ decimalPlaces: 2 });
    $("#remove").click(
      function(e)
      {
        e.preventDefault();
        $("positive,.decimal-2-places").removeNumeric();
      }
      );
  };



  //actualizad datos del producto
  $('#actualizarProducto').submit(function(e){
    e.preventDefault();

    $.ajax({
      url: '<?=$base_url?>/producto/actualizarProducto',
        type: "POST",
        async: true,
        data: $('#actualizarProducto').serialize(),
         
        success: function(response){
          if (response != 'error') {
            redlistar()   
          }
        }
    });
  });

  function redlistar(){
  window.location.href='<?=$base_url?>/producto/listar';
};
 
 </script>
</body>
</html>