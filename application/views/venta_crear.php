<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
//venta
$htmltrow = "<tr>
        <td>%s</td><td>%s</td><td>%s</td><td>Q. %s</td><td>%s</td></tr>\n";
$htmltrows = "";

foreach ($sumin as $s) {
  $id_productos = $s['id_producto'];
  $htmltrows .= sprintf($htmltrow, $s['id_producto'], htmlspecialchars($s['nombreP']), htmlspecialchars($s['precio']), htmlspecialchars($s['existencia']), $s['imagen']);
}

//idsumin
$htmltrow3 = "<tr>
  <td>%s</td>
 </tr>\n";
$htmltrows3 = "";

foreach ($codVentaSum as $sum) {
  $htmltrows3 .= sprintf($htmltrow3, 
    $sum['id']);
}

$idvenSum = $sum['id'];

//idcliente
$htmltrow2 = "<tr>
  <td>%s</td>
 </tr>\n";
$htmltrows2 = "";

foreach ($codCliente as $c) {
  $htmltrows2 .= sprintf($htmltrow2, 
    $c['id_cli']);
}
?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Crear venta</title>
</head>
<body>
<header>
  <?php $this->load->view('menu'); ?>
</header>
    <div class="container espacio">
      <center><h3>Nueva Venta <i class="fa fa-shopping-cart"></i></h3></center>
      <div class="form-row">
      <div><h5>Datos del Cliente</h5></div>
      <div><a href="#" class="btn btn-sm btn-primary btn_new_cli" id="habilitar"><i class="fa fa-user-plus"></i> Nuevo Cliente</a></div></div>
      <div class="formestilo clientesform" id="registrocliente" style="display: none;">
        <form action="agregarCliente" name="nuevo_cliente" id="nuevo_cliente">
        <input type="hidden" name="action" value="agregarCliente" >
        <?php  {?>
          <input type="hidden" name="cod_cliente" id="cod_cliente" value="<?php echo $c['id_cli'] ;?>" required>
        <?php } ?>
        <div class="form-row">
          <div class="col-sm-4"><i class="fa fa-id-card" ></i><strong style="font-weight: bold; color: red;"> CUI </strong>
            <input type="text" class="ford positive" placeholder="Buscar aqui" minlength="1" maxlength="13" name="cui_cliente" id="cui_cliente">
          </div>
          <div class="col-sm-8"><i class="fa fa-address-book"></i> Nombre
            <input type="text" class="form-control" name="nom_cliente" id="nom_cliente" required disabled>
          </div>
          <div class="col-sm-4"><i class="fa fa-mobile"></i> Teléfono 1
            <input type="text" class="form-control positive" maxlength="14" name="tel_cliente" id="tel_cliente" required disabled>
          </div>
          <div class="col-sm-4"><i class="fa fa-mobile"></i> Teléfono 2
            <input type="text" class="form-control positive" maxlength="8" name="tel1_cliente" id="tel1_cliente"  disabled>
          </div>
           <div class="col-sm-4"><i class="fa fa-id-badge"></i><strong style="font-weight: bold; color: red;"> NIT</strong>
            <input type="text" class="ford" placeholder="Buscar aqui" name="nit_cliente"  id="nit_cliente" minlength="1" maxlength="13">
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-12"><i class="fa fa-location-arrow"></i> Dirección
            <input type="text" class="form-control" name="dir_cliente" id="dir_cliente" required disabled>
          </div>
        </div>
        <div class="guardar_cli">
        <center><button type="submit"  class="btn btn-sm btn-primary" style="font-weight: bold;"><i class="fa fa-save"></i> Guardar Cliente</button></center></div>
        </form>
      </div>
      <h5>Datos de la Venta</h5>
      <div class="ventasss">
        <div class="form-row">
          <div class="col-sm-6"><strong>Vendedor <i class="fa fa-user"></i></strong> : <?php echo $this->session->NOMBRE ?></div>
          <div class="col-sm-6"><strong>Fecha <i class="fa fa-calendar-day"></i></strong> : <?php echo date("d-m-Y"); ?></div>
        </div>
        <br>
      </div>
    <div class="ventassss formestilo">
      <center>
        <a data-toggle="modal" href="#suministros">        
          <button id="btnAgregarArt" type="button" class="btn btn-success btn-bloc" style="font-weight: bold;"><i class="fa fa-lightbulb"></i> <i class="fa fa-plug"></i> <i class="fa fa-bolt"></i> <i class="fa fa-car-battery"></i> Selecionar Artículos</button>
        </a>
      </center>
      <form action="agregarProd" method="POST">
        <div class="form-row " id="div1" style="display: none;">
          <div class="col-sm-2">
            <label for="codigo"><i class="fa fa-hashtag"></i> Cód</label><input type="hidden" id="id_prods" name="id_prods" required>
            <input type="text" class="form-control" id="cod_prods" name="cod_prods" style="display: none;" readonly required>
          </div>
          <div class="col-sm-4">
            <label for="nombre"><i class="fa fa-info-circle"></i> Nombre</label><textarea type="text" class="form-control" id="nombre_su" name="nombre_su" rows="2" value="" style="display: none;" readonly required></textarea>
          </div>
          <div class="col-sm-4">
            <label for="detalle"><i class="fa fa-info-circle"></i> Detalle</label><textarea type="text" class="form-control" id="descrip_s" name="descrip_s" rows="2" value="" style="display: none;" readonly required></textarea>
          </div>
          <div class="col-sm-2">
            <label for="stock"><i class="fa fa-cubes"></i> Existencia</label><input type="text" class="form-control" id="stok_prods" name="stok_prods" style="display: none;" readonly="" required>
          </div>
         </div>
        <div class="form-row" id="div2" style="display: none;">  
          <div class="col-sm-2">
            <label for="cantidad"><i class="fa fa-hashtag"></i> Cantidad</label><input type="text" class="form-control" id="cant_s" name="cant_s" maxlength="6" value="" required style="display: none;">
          </div>
          <div class="col-sm-2">
            <label for="preciou"><i class="fa fa-money-bill-wave-alt"></i> Precio Unitario</label><input type="text" class="form-control" id="precio_vs" name="precio_vs" style="display: none;" readonly="" required>
          </div>
          <div class="col-sm-2">
            <label for="descuento"><i class="fa fa-money-bill-wave"></i> Descuento en Q.</label><input type="text" class="form-control" id="desc_s" name="desc_s" maxlength="8" value="0" required style="display: none;">
          </div>
          <input type="hidden" id="engan_s" name="engan_s" value="0" required>
          <div class="col-sm-3">
            <label for="total"><i class="fa fa-cash-register"></i> Total</label><input type="text" class="form-control" id="total_s" name="total_s" maxlength="8" required readonly="" style="display: none;">
          </div>
          <div class="col-sm-3">
            <label for="accion"><i class="fa fa-puzzle-piece"></i> Acción para Agregar</label><center>
            <a href="#" class="btn btn-primary" id="add_product_sum" name="add_product_sum" style="font-weight: bold; display: none;"><i class="fa fa-plus"></i> Agregar Producto</a></center>
          </div>
        </div>
      </form>
      <br>
      <div class="table-responsive-sm">
        <input type="hidden" name="idclientesum" id="idclientesum" value="" required>
        <table class="table table-bordered table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="textcenter" width="75px">CÓD</th>
              <th class="textcenter">CANT</th>
              <th>DESCRIPCION</th>
              <th class="textcenter">PRECIOVENTA</th>
              <th class="textcenter">DESCUENTO</th>
              <th class="textcenter">SUBTOTAL</th>
              <th class="textcenter">ACCIÓN</th>
            </tr>
          </thead>
          <tbody id="detalle_venta">
          </tbody>
          <tfoot id="detalle_totales">
          </tfoot>
        </table>
      </div>
      <center>
      <a href="#" class="btn btn-danger BotonGuardar" style="font-weight: bold;" id="btn_anular_venta"><i class="fa fa-times"></i> Anular Venta</a>
      <button type="submit" class="btn btn-success BotonGuardar" style="font-weight: bold; display: none;" id="btn_facturar_venta_sum"><i class="fa fa-save"></i> Guardar</button></center><br>
    </div>
<!--modals-->
<section>
  <div class="modal fade" id="suministros" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header colormodal">
            <h5 class="modal-title">Seleccionar Suministros</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive-sm">
            <table class="table table-striped table-bordered" id="suministrosv">
              <thead>
                  <th>Op.</th>
                  <th>Cód</th>
                  <th>Nombre</th> 
                  <th>Precio Venta</th>
                  <th>Stock</th>
                  <th>Imágen</th>
              </thead>
              <tbody>
                 <?php
                    foreach ($sumin as $s){
                      $direccion ='/ventas-umg/recursos/upload/';
                      $imagens = $direccion.$s['imagen'];
                   ?>
                    <tr>
                      <td class="text-center"><a class='btn  btn-warning iconos' style="font-weight: bold; border-radius: 25px;" onclick="obdatosIdSum('<?php echo $s['id_producto'] ;?>')" data-dismiss="modal"><i class="fa fa-plus"></i></a></td>
                      <td class="text-center"><?php echo $s['codigo'] ;?></td>
                      <td class="text-center"><?php echo $s['nombreP'] ;?></td>
                      <td class="text-center">Q <?php echo number_format($s['precio'], 2, '.', ' ') ;?></td>
                      <td class="text-center"><?php echo $s['existencia'] ;?></td>
                      <td class="text-center"><img height="75px" src="<?php echo $imagens ?>"></td>
                    </tr>
                   <?php
                      }
                    ?>
              </tbody>
            </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
          </div>
        </div>
      </div>
    </div>
</section>
<br><br>
  <script>
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

 //buscar cliente en el registro
  $('#cui_cliente').keyup(function(e){
    e.preventDefault();
    var cliente = $(this).val();
    var action = 'buscarCliente';

    $.ajax({
      url: '<?=$base_url?>/venta/buscarCliente',
        type: "POST",
        async: true,
        data: {action:action,cliente:cliente},
         
        success: function(response){
          //console.log(response);
          if(response == 0) {
            $('#idcliente').val('');
            $('#nom_cliente').val('');
            $('#tel_cliente').val('');
            $('#tel1_cliente').val('');
            $('#dir_cliente').val('');
            //habilitar boton agregar
            $('.btn_new_cli').slideDown();
          }else{
            var data = $.parseJSON(response);
            if(data.length > 0){
              $('#idcliente').val(data[0]['id_cliente']);
              $('#cod_cliente').val(data[0]['codigo']);
              $('#idclientesum').val(data[0]['codigo']);
              $('#id_cliente_c').val(data[0]['codigo']);
              $('#nom_cliente').val(data[0]['nombre']);
              $('#tel_cliente').val(data[0]['numero1']);
              $('#tel1_cliente').val(data[0]['numero2']);
              $('#dir_cliente').val(data[0]['direccion']);
              $('#nit_cliente').val(data[0]['nit']);
              //ocultar boton agregar
              $('.btn_new_cli').slideUp();
              //bloquear los inputs
              $('#cod_cliente').attr('disabled','disabled');
              $('#nom_cliente').attr('disabled','disabled');
              $('#tel_cliente').attr('disabled','disabled');
              $('#tel1_cliente').attr('disabled','disabled');
              $('#dir_cliente').attr('disabled','disabled');
              //Ocultar boton guardar
              $('.guardar_cli').slideUp();
              }
          }
        },
        error: function(error){
        }
    });
  });

//buscar cliente en el registro
  $('#nit_cliente').keyup(function(e){
    e.preventDefault();
    var cliente = $(this).val();
    var action = 'buscarClienteNit';

    $.ajax({
      url: '<?=$base_url?>/venta/buscarClienteNit',
        type: "POST",
        async: true,
        data: {action:action,cliente:cliente},
         
        success: function(response){
          //console.log(response);
          if(response == 0) {
            $('#idcliente').val('');
            $('#nom_cliente').val('');
            $('#tel_cliente').val('');
            $('#tel1_cliente').val('');
            $('#dir_cliente').val('');
            //habilitar boton agregar
            $('.btn_new_cli').slideDown();
          }else{
            var data = $.parseJSON(response);
            if(data.length > 0){
              $('#idcliente').val(data[0]['id_cliente']);
              $('#cod_cliente').val(data[0]['codigo']);
              $('#idclientesum').val(data[0]['codigo']);
              $('#id_cliente_c').val(data[0]['codigo']);
              $('#nom_cliente').val(data[0]['nombre']);
              $('#cui_cliente').val(data[0]['cui']);
              $('#tel_cliente').val(data[0]['numero1']);
              $('#tel1_cliente').val(data[0]['numero2']);
              $('#dir_cliente').val(data[0]['direccion']);
              //ocultar boton agregar
              $('.btn_new_cli').slideUp();
              //bloquear los inputs
              $('#cod_cliente').attr('disabled','disabled');
              $('#nom_cliente').attr('disabled','disabled');
              $('#cui_cliente').attr('disabled','disabled');
              $('#tel_cliente').attr('disabled','disabled');
              $('#tel1_cliente').attr('disabled','disabled');
              $('#dir_cliente').attr('disabled','disabled');
              //Ocultar boton guardar
              $('.guardar_cli').slideUp();
              }
          }
        },
        error: function(error){
        }
    });
  });

   //habilitar formulario de registro de cliente
  $('.btn_new_cli').click(function(e){
    e.preventDefault();
    $('#nom_cliente').removeAttr('disabled');
    $('#tel_cliente').removeAttr('disabled');
    $('#tel1_cliente').removeAttr('disabled');
    $('#dir_cliente').removeAttr('disabled');

    $('.guardar_cli').slideDown();
  });

  $(function(){
        $("#habilitar").click(function(){
            $("#registrocliente").slideDown();
        });
  });

    //suministros obtener
    function obdatosIdSum(id_producto) {
        datos = {
            "id_producto": id_producto
        }

        $.ajax({
            data: datos,
            url: '<?=$base_url?>/venta/buscarProductoRe',
            type: 'POST',
            beforeSend: function(){},
            success: function(response) {
                data = $.parseJSON(response);
                if(data.length > 0){
                    $('#id_prods').val(data[0]['id_producto']);
                    $('#cod_prods').val(data[0]['codigo']);
                    $('#nombre_su').val(data[0]['nombreP']);
                    $('#descrip_s').val(data[0]['descripcion']);
                    $('#precio_vs').val(data[0]['precio']);
                    $('#stok_prods').val(data[0]['existencia']);

                    $('#cod_prods').slideDown();
                    $('#nombre_su').slideDown();
                    $('#descrip_s').slideDown();
                    $('#precio_vs').slideDown();
                    $('#stok_prods').slideDown();
                    $('#cant_s').slideDown();
                    $('#desc_s').slideDown();
                    $('#pend_vs').slideDown();
                    $('#total_s').slideDown();

                    $('#div1').slideDown();
                    $('#div2').slideDown();
                }
            } 
        });
    };

   //cliente
$('#nuevo_cliente').submit(function(e){
    e.preventDefault();

    $.ajax({
      url: '<?=$base_url?>/venta/crearCliente',
        type: "POST",
        async: true,
        data: $('#nuevo_cliente').serialize(),
         
        success: function(response){
          if (response != 'error') {
            $('#idcliente').val(response.replace(/\"/g, ""));
            $('#idclientesum').val(response.replace(/\"/g, ""));
            //bloquear campos al retornar los datos
            $('#cui_cliente').attr('disabled','disabled');
            $('#nom_cliente').attr('disabled','disabled');
            $('#tel_cliente').attr('disabled','disabled');
            $('#tel1_cliente').attr('disabled','disabled');
            $('#nit_cliente').attr('disabled','disabled');
            $('#dir_cliente').attr('disabled','disabled');
            //ocultar boton agregar
            $('.btn_new_cli').slideUp();
            //Ocultar boton guardar
            $('.guardar_cli').slideUp();
          }

        },
        error: function(error){
        }
    });
  });

//redirigir nuevamente al controller Venta con el producto
function redirectsum(){
  window.location.href='<?=$base_url?>/venta/mostrar/<?php echo $idvenSum ?>';
}


//redirigir nuevamente al controller Venta
function redirect(){
  window.location.href='<?=$base_url?>/venta/crear';
}


//validar campos
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

  //suministro calcular____________________
  $('#cant_s,#precio_vs,#desc_s').keyup(function(e){
    e.preventDefault();

      var textValue3 =$('#cant_s').val(); 
      var textValue4 =$('#precio_vs').val(); 
      var textValue50 =$('#desc_s').val(); 

      var resultado = (textValue3 * textValue4);
      var condescuento = resultado - textValue50
      $('#total_s').val(condescuento);
  });
//validar cantidad de producto al ingresar 
  $('#cant_s').keyup(function(e){
    e.preventDefault();
    var existenciasum = parseInt($('#stok_prods').val());

    if( ($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existenciasum) ){
      $('#add_product_sum').slideUp();
    }else{
      $('#add_product_sum').slideDown();
    }
  });
//descuento
  $('#desc_s').keyup(function(e){
    e.preventDefault();
    var preciouni = parseInt($('#precio_vs').val());

    if( ($(this).val() > preciouni) ){
      $('#add_product_sum').slideUp();
    }else{
      $('#add_product_sum').slideDown();
    }
  });

  //productos micelaneos   //agregar producto a detalle
  $('#add_product_sum').click(function(e){
    e.preventDefault();
    if($('#cant_s').val() > 0 ){
      var codproducto = $('#id_prods').val();
      var cantidad = $('#cant_s').val();
      var descuento = $('#desc_s').val();
      var enganche = $('#engan_s').val();
      var action = 'addProductoDetalle';

      $.ajax({
        url: '<?=$base_url?>/venta/agregarAlDetalleProd',
        type: "POST",
        async: true,
        data: {action:action,producto:codproducto,cantidad:cantidad,descuento:descuento},

        success: function(response){
          if (response != 'error') {
            var informacion = JSON.parse(response);
            $('#detalle_venta').html(informacion.detalle);
            $('#detalle_totales').html(informacion.totales);
            //limpiar datos
            $('#cod_prods').val('');
            $('#nombre_su').val('');
            $('#descrip_s').val('');
            $('#stok_prods').val('');
            $('#precio_vs').val('');
            $('#desc_s').val('0');
            $('#total_s').val('');
            $('#cant_s').val('');

            //ocultar div
            $('#div1').slideUp();
            $('#div2').slideUp();
            //bloquear cantidad
            $('#add_product_sum').slideUp();

          }else{
            console.log('No hay datos');
          } 
          viewProcesar();        
        }, 
        error: function(error){
        }
      });
    }
  });

  //anular venta en detalle temp
   $('#btn_anular_venta').click(function(e){
    e.preventDefault();

    var rows = $('#detalle_venta tr').length;
    if(rows > 0){
      var action = 'anularVenta';

      $.ajax({
        url: '<?=$base_url?>/venta/eliminarDetalleV',
        type: "POST",
        async: true,
        data: {action:action},
         
        success: function(response){
          redirect();
        },
        error: function(error){
        }
      });
    }
  });

  /////////////////Guardar venta de los productos
   $('#btn_facturar_venta_sum').click(function(e){
    e.preventDefault();

    var rows = $('#detalle_venta tr').length;
    if(rows > 0){
      var action = 'procesarComprobante';
      var idClient = $('#idclientesum').val();

      $.ajax({
        url: '<?=$base_url?>/venta/guardarVentaRealizada',
        type: "POST",
        async: true,
        data: {action:action,idClient:idClient},
         
        success: function(response){
          console.log(response);
          if(response != 'error'){
            var info = JSON.parse(response);
            console.log(info);
          
          }else if(response == 'error'){
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Debe de registrar o buscar al cliente, para generar la venta.',
            })
          } 
          if (response != 'error'){
            redirectsum(); 
          }
        },
        error: function(error){
        }
      });
    }
  });
//anular venta
   $('.anular').click(function(e){
    e.preventDefault();

    var nocomp = $(this).attr('comprob');
    var action = 'infoFactura';
    
      $.ajax({
        url: '<?=$base_url?>/venta/anularComprobante',
        type: "POST",
        async: true,
        data: {action:action,nocomp:nocomp},
         
        success: function(response){
          if(response != 'error'){
            var info = $.parseJSON(response); 
            //console.log(info);
          
          if(info.length > 0){
              $('#estado').val(info[0]['estado']);
              $('#fecha').val(info[0]['fecha']);
              $('#id_cliente').val(info[0]['id_cliente']);
              $('#id_comprobante').val(info[0]['id_comprobante']);
              $('#id_usuario').val(info[0]['id_usuario']);
              $('#totalComprobante').val(info[0]['totalComprobante']);
            }
          }
        },
        error: function(error){
          console.log(error);
        }
      });
  });


function del_product_detalle(correlativo){
  var action = 'del_product_detalle';
  var id_detalle = correlativo;

  $.ajax({
        url: '<?=$base_url?>/venta/eliminarDetalle',
        type: "POST",
        async: true,
        data: {action:action,id_detalle:id_detalle},

        success: function(response){
          if (response != 'error') {
            var informacion = JSON.parse(response);
            $('#detalle_venta').html(informacion.detalle);
            $('#detalle_totales').html(informacion.totales)

            $('#codigoProducto').html('');
            $('#nombre').html('');
            $('#valor1').val('0');
            $('#valor2').val('0');
            $('#valor3').val('0.00');
            $('#valor4').val('0.00');
            $('#valor50').val('0.00');
            $('#valor51').val('0.00');

            //bloquear cantidad
            $('#valor2').attr('disabled','disabled');
            //bloquear cantidad
            $('#add_product_venta').slideUp();
            
          }else{
            $('#detalle_venta').html('');
            $('#detalle_totales').html('');
          } 
          viewProcesar();        
        }, 
        error: function(error){
        }      
      });
}

function viewProcesar(){
  if($('#detalle_venta tr').length > 0){
    $('#btn_facturar_venta_sum').show();
  }else{
    $('#btn_facturar_venta_sum').hide();
  }
}

function searchForDetalle(id){
  var action = 'searchForDetalle';
  var user = id;
  $.ajax({
    url: '<?=$base_url?>/venta/mostrarDatos',
    type: "POST",
    async: true,
    data: {action:action,user:user},
 
    success: function(response){
      if (response != 'error') {
        var informacion = JSON.parse(response);
        $('#detalle_venta').html(informacion.detalle);
        $('#detalle_totales').html(informacion.totales);
        
      }else{
        console.log('No hay Datos')
      } 
      viewProcesar();        
    }, 
    error: function(error){
    }
  });
}

//boton para ctivar o desactivar
function habiltar(){
  if($('#detalle_venta tr').length > 0){
    $('#valor2').attr('disabled','disabled');
  }else{
    $('#btn_facturar_venta_sum').hide();
  }
};
//sesion user
$(document).ready(function(){
    var usuarioid = '<?php echo $this->session->IDUSUARIO ?>';
    searchForDetalle(usuarioid);
  });

$(document).ready(function () {
    $('#suministrosv').DataTable({
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

</script>
</body>
</html> 
