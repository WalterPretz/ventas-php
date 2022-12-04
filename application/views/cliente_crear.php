<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
$htmltrow1 = "<tr>
  <td>%s</td>
 </tr>\n";
$htmltrows1 = "";

foreach ($codCliente as $a1) {
  $htmltrows1 .= sprintf($htmltrow1, 
    $a1['id_cli']);
}

?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Crear Cliente</title>
</head>
<body>
<header>
  <?php $this->load->view('menu'); ?> 
<hr class="espacio">
<center><h4>Formulario de Registro de Clientes</h4></center>
<section class="container formestilo">
  <form class="needs-validation" novalidate method="POST" action="<?=$base_url?>/cliente">
  <div class="form-row">
    <div class="col-md-2 mb-2">
      <label for="validationCustom02"><i class="fab fa-slack-hash"></i> Código Cliente</label>
      <?php if ($a1['id_cli'] == null) {?>
     <input type="text" class="form-control" name="codigo" id="codigo" style="text-align: center;" value="1" required readonly>
      <div class="valid-feedback">
         <?php } else {?>
          <input type="text" class="form-control" name="codigo" id="codigo" style="text-align: center;" value="<?php echo $a1['id_cli'] ;?>" required readonly>
      <div class="valid-feedback">
         <?php } ?>
      </div>
    </div>
    <div class="col-md-6 mb-6">
      <label for="validationCustom01"><i class="fa fa-signature"></i> Nombre Completo</label>
      <input type="text" class="ford" id="validationCustom01" name="nombre"  required placeholder="Nombres y Apellidos" required value="<?=$nombre?>">
      <div class="valid-feedback">
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <label for="validationCustom02"><i class="fa fa-id-card"></i> CUI</label>
      <input type="text" class="ford integer" id="validationCustom02" name="cui" placeholder="No. de CUI" minlength="0"> maxlength="13" value="<?=$cui?>">
      <div class="valid-feedback">
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-12">
      <label for="validationCustom02"><i class="fa fa-map-marked-alt"></i> Dirección</label>
      <input type="text" class="ford" id="validationCustom02" name="direccion" required placeholder="Dirección" required value="<?=$direccion?>">
      <div class="valid-feedback">
      </div>
    </div>
  </div>
  <div class="form-row" style="padding-top: 1rem;">
    <div class="col-md-4 mb-4">
      <label for="validationCustom04"><i class="fa fa-address-card"></i> NIT</label>
      <input type="text" class="ford" id="validationCustom09" name="nit" required required maxlength="15" value="<?=$nit?>">
      <div class="valid-feedback">
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <label for="validationCustom04"><i class="fa fa-mobile-alt"></i> 1er. número de Teléfono</label>
      <input type="text" class="ford integer" id="validationCustom04" name="numero1" required placeholder="Teléfono / Celular" required  maxlength="8"  min="1" value="<?=$numero1?>">
      <div class="valid-feedback">
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <label for="validationCustom04"><i class="fa fa-mobile"></i> 2do. número de Teléfono</label>
      <input type="text" class="ford integer" name="numero2" value="" maxlength="8" placeholder="Teléfono / Celular" value="<?=$numero2?>">
  </div>
    </div>
  <br>
  <div>
  <center>
    <td colspan="2">
      <center>
        <div onclick="mensaje()"><?=$boton?></div>
      </center>
    </td>
  </center>
</form>
</section>
<hr>
<section class="container">
  <a href="<?=$base_url?>/cliente/listar" class="badge badge-pill badge-primary botones"><i class="icon-user fa-md"></i> Listado de Cliente</a>
  <a href="<?=$base_url?>/venta/crear" class="badge badge-pill badge-success botones"><i class="icon-basket fa-md"></i> Crear Venta</a>
</section>
<br>
  <footer><?php $this->load->view('footer') ?></footer>
</div>
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
              text: 'Recuerde llenar los campos obligatorios!',
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