<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
?><!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Crear Producto</title>
</head>
<body>
<header>
	<?php $this->load->view('menu'); ?> 
</header>
<div class="espacio">
  <section>
    <div class="row container">
      <div class="col-md-6">
        <h1 style="text-align: right;" class="icon-handbag"></h1>
      </div>
      <div class="col-md-6">
        <h4 style="text-align: left; margin-top: 1%"><i class="fa fa-cubes"></i> Registrar Producto</h4>
      </div>
    </div>
  </section>
  <section class="container">
  <a href="<?=$base_url?>/producto/listar" class="btn btn-warning botones">Listado de Productos</a>
</section>
<hr>
<div class="container">
<section class="formestilo">
  <form class="needs-validation text-center" enctype="multipart/form-data" action="<?=$base_url?>/producto" method="POST">
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="inputEmail4"><i class="fab fa-slack-hash"></i> CÓDIGO</label>
        <input type="text" class="form-control" id="codigo" maxlength="15" required name="codigo" value="<?=$codigo?>" >
      </div>
      <div class="form-group col-md-9 ">
        <label for="inputPassword4"><i class="fa fa-signature"></i> NOMBRE DEL PRODUCTO</label>
        <input type="text" class="form-control levelc" id="validationCustom02" required name="nombre" value="<?=$nombre?>">
      </div>
    </div>
    <div class="form-group">
      <label for="inputAddress"><i class="fa fa-signature"></i> DESCRIPCIÓN</label>
      <input type="text" class="form-control levelc" id="validationCustom03" required maxlength="100" name="descripcion" value="<?=$descripcion?>">
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label for="inputEmail4"><i class="fa fa-money-bill-wave-alt"></i> PRECIO COMPRA</label>
        <input type="num" class="form-control integer decimal-2-places levelc" id="validationCustom01 " required placeholder="00000" maxlength="5" name="precio_compra" value="<?=$precio_compra?>">
      </div>
      <div class="form-group col-md-3">
        <label for="inputPassword4"><i class="fa fa-money-bill-wave-alt"></i> PRECIO VENTA</label>
        <input type="num" class="form-control integer decimal-2-places levelc"  id="validationCustom02" required placeholder="0000" maxlength="5" name="precio_venta" value="<?=$precio_venta?>">
      </div>
      <div class="form-group col-md-2">
        <label for="inputPassword4"><i class="fa fa-layer-group"></i> EXISTENCIA</label>
        <input type="num" class="form-control integer levelc"  id="validationCustom03" required placeholder="0" maxlength="4" name="existencia" value="<?=$existencia?>">
      </div>
      <div class="form-group col-md-4">
        <label for="inputPassword4"><i class="fa fa-building"></i> PROVEEDOR</label>
        <select name="proveedor" id="proveedor" class="form-control selectpicker levelc" data-live-search="true" required></select>
      </div>
    </div>
    <div class="form-row">
        <div class="col-sm-3 col-md-3"></div>
        <div class="col-sm-6 col-md-6">
          <label for="foto" class="text-center"><i class="fa fa-images"></i> Subir Imágen del Producto</label>
          <div class="photo">
            <div class="prevPhoto">
              <span class="delPhoto notBlock">X</span>
              <label for="foto"></label>
            </div>
            <div class="upimg">
              <input type="file" name="foto" id="foto">
            </div>
            <div id="form_alert"></div>
          </div>
        </div>
        <div class="col-sm-3 col-md-3"></div>
      </div>
      <br>
     <center>
        <div class="col-sm-9 mb-3 mb-sm-0">
          <input onclick="mensaje()" type="submit" class="btn btn-primary btn-user btn-block botones" id="guardar" role="button" name="guardar" value="¡Registrar Producto!">
        </div>
      </center>
  </form>
</section>
</div>
<br>
  <footer><?php $this->load->view('footer') ?></footer>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
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
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Seleccionar o llenar todos los campos',
            })
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

//validar tamaños de archivo
  function ValidarTamaño(obj){
    var uploadFile = obj.files[0];
    var sizeByte = obj.files[0].size;
    var siezekiloByte = parseInt(sizeByte / 2048);
    if(siezekiloByte > 100){
        alert.error('El archivo exede el tamaño permitido');
        $(obj).val('');
        return;
    }
    img.src = URL.createObjectURL(uploadFile); 
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

$(function(){
  $.post('<?=$base_url?>/producto/proveedor').done(function(respuesta){
    $('#proveedor').html(respuesta);
  });
});


 //SELEC FOTO PRODUCTO ---------------------
$(document).ready(function(){
    $("#foto").on("change",function(){
      var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');
        
            if(uploadFoto !='')
            {
                var type = foto[0].type;
                var name = foto[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
                {
                    alert.error('Imágen no compatible');                       
                    $("#img").remove();
                    $(".delPhoto").addClass('notBlock');
                    $('#foto').val('');
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        $("#img").remove();
                        $(".delPhoto").removeClass('notBlock');
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                        $(".upimg label").remove();
                        
                    }
              }else{
                alert.error('No seleccionó una imágen');
                $("#img").remove();
              }              
    });

    $('.delPhoto').click(function(){
      $('#foto').val('');
      $(".delPhoto").addClass('notBlock');
      $("#img").remove();

    });

});

  $('#codigo').keyup(function(e){
    e.preventDefault();

    var cod = $(this).val();
    var action = 'buscarCodigo';

    $.ajax({
      url: 'producto/valiData',
      type: "POST",
      async: true,
      data: {action:action,cod:cod},
      
      success: function(response){
        if(response != 'error'){
          var info = $.parseJSON(response); 
            //console.log(info);
          if(info.length > 0){

           //$('#codigo').val(''); 
            $('#guardar').slideUp();
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'El Código que está ingresando ya existe! Ingrese otra.',
            })
          }
          else{
           $('#guardar').slideDown();
          }
        }
      }
    });
  });

</script>
</body>
</html>
