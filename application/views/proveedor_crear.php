<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
?><!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Crear Proveedor</title>
</head>
<body>
<header>
	<?php $this->load->view('menu'); ?>
</header>
<div class="caracteristica-icon text-center espacio">
</div>
</header><hr class="hr2">
<center class="h4" style="color:#00A6BF" ><i class="fa fa-building"></i> Formulario de Registro de Proveedor</center>
<section>
<div class="container fondoF1 formestilo">
  <form class="needs-validation" novalidate  action="<?=$base_url?>/proveedor" method="POST">
  <div class="form-row">
    <div class="col-sm-6 col-md-6">
      <label for="validationCustom01"><i class="fa fa-signature"></i> Nombre del Proveedor</label>
      <input type="text" class="form-control" id="validationCustom01" required placeholder="Nombre completo" name="nombre" value="<?=$nombre?>">
      <div class="valid-feedback" minlength="7">
      </div>
    </div>
    <div class="form-group col-sm-6 col-md-6">
      <label for="validationCustom02"><i class="fa fa-map-marked-alt"></i> Direción</label>
      <input type="text" class="form-control" id="validationCustom02" required placeholder="Dirección"  name="direccion" value="<?=$direccion?>">
      <div class="valid-feedback">
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-sm-4 col-md-4">
      <label for="validationCustom03"><i class="fa fa-phone-alt"></i> Teléfono</label>
      <input type="text" class="form-control integer" id="validationCustom03" name="telefono" value="<?=$telefono?>" maxlength="8"  min="7" required placeholder="00000000">
      <div class="valid-feedback">
      </div>
    </div>
    <div class="col-sm-4 col-md-4">
      <label for="validationCustom04"><i class="fa fa-cubes"></i> Tipo de Producto</label>
      <select class="custom-select" id="validationCustom04" required  name="tipo" value="<?=$tipo?>">
        <option selected value="">Seleccionar</option>
        <option>Conveniencia</option>
        <option>Compra</option>
        <option>Especialidad</option>
        <option>No Buscados</option>
        <option>Materiales y Refacciones</option>
        <option>Suministros y Servicios</option>
        <div class="valid-feedback"><i class="fa fa-check"></i></div>
      </select>
    </div>
    <div class="col-sm-4 col-md-4">
      <label for="validationCustom03"><i class="fa fa-envelope"></i> Correo</label>
      <input type="email" class="form-control" id="validationCustom06" name="correo" value="<?=$correo?>" maxlength="30"  >
      <div class="valid-feedback">
      </div>
    </div>
  </div>
  <br> <br> <br>
  <div class="form-row">
    <div class="col-sm-4 col-md-4"></div>
    <div class="col-sm-4 col-md-4">
      <center>
        <div onclick="mensaje()"><?=$boton?></div>
      </center>
    </div>
    <div class="col-sm-4 col-md-4"></div>
  </div>
  <br>
</form>
</div>
</section>
<br>
<section class="container">
  <a href="<?=$base_url?>/proveedor/listar" class="badge badge-pill badge-warning botones"><i class="icon-user fa-md" style=" font-weight: bold;"></i> Listado de proveedores</a>
</section>
<br><br><br>
	<footer><?php $this->load->view('footer') ?></footer>
</body>
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
              text: 'Seleccionar o llenar los campos obligatorios',
            })
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

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
  }
</script>
</html>
