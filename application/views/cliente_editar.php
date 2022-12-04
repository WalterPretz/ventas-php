<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

foreach ($arr as $key) {
  $codigo = $key['codigo'];
  $nombre = $key['nombre'];
  $cui = $key['cui'];
  $direccion = $key['direccion'];
  $nit = $key['nit'];
  $numero1 = $key['numero1'];
  $numero2 = $key['numero2'];
  $id_cliente = $key['id_cliente'];
}

?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Editar Proveedor</title>
</head>
<body>
<header>
<?php $this->load->view('menu'); ?>
</header>
<br>
 <div class="caracteristica-icon text-center espacio">
  <div class="text-center icon-user-following"></div><h4><i class="fa fa-user-edit"></i> Editar Datos del Cliente</h4>
</div>
</header><br>

<section>
<div class="container formestilo">
  <form class="needs-validation" novalidate  action="<?=$base_url?>/cliente/editar" method="POST">
    <div class="form-row">
    <div class="col-sm-2">
      <label for="validationCustom02">Código</label>
      <input type="text" class="form-control resul" name="codigo" required value="<?=$codigo?>" readonly>
      <div class="valid-feedback">
      </div>
    </div>
    <div class="col-sm-6">
      <label for="validationCustom01">Nombre Completo</label>
      <input type="text" class="ford resul" id="validationCustom01" name="nombre"  required placeholder="Nombres y Apellidos" required value="<?=$nombre?>">
      <div class="valid-feedback">
      </div>
    </div>
    <div class="col-sm-2">
      <label for="validationCustom02">CUI</label>
      <input type="text" class="ford resul integer" id="validationCustom02" name="cui" required placeholder="No. de CUI" required maxlength="13" value="<?=$cui?>">
      <div class="valid-feedback">
      </div>
    </div>
    <div class="col-sm-2">
      <label for="validationCustom02">NIT</label>
      <input type="text" class="ford resul integer" id="validationCustom02" name="nit" required maxlength="13" value="<?=$nit?>">
      <div class="valid-feedback">
      </div>
    </div>
  </div>
  <div class="form-row" style="padding-top: 2rem;">
    <div class="col-md-6 mb-6">
      <label for="validationCustom02">Dirección</label>
      <input type="text" class="ford resul" id="validationCustom02" name="direccion" required placeholder="Dirección" required value="<?=$direccion?>">
      <div class="valid-feedback">
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">1er. número de Teléfono</label>
      <input type="text" class="ford resul integer" id="validationCustom04" name="numero1" required placeholder="Teléfono / Celular" required placeholder="00000000" maxlength="8"  min="7" value="<?=$numero1?>">
      <div class="valid-feedback">
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">2do. número de Teléfono</label>
      <input type="text" class="ford resul integer" id="validationCustom04" name="numero2" maxlength="8"  required placeholder="Teléfono / Celular" value="<?=$numero2?>">
  </div>
    </div>
  <br>
  <center>
    <td colspan="2">
      <center>
        <input  type="hidden"  name="id_clientito" value="<?=$id_cliente?>">
        <input class="btn btn-primary btn-md" type="submit" role="button" name="actualizar" value="Actualizar">
      </center>
    </td>
  </center>
</form>
<?php $mensaje ?>
<div class="label label-danger label-md" onclick="$(this).hide(1000)"><?=$mensaje?></div>
</div>
</section>
<br><br><br><br>
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
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>
</html>
