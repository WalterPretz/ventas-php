<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
if (count($arr) < 1) {
  $mensaje = "<script>alert.error('No hay datos del Cliente');</script>";
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
        <td>%s</td>
        <td>%s</td>
        </tr>";
$htmltrows = "";

foreach ($arr as $a) {
  $id_cliente = $a['id_cliente'];  $htmltrows .= sprintf($htmltrow,
    $a['codigo'], $a['nombre'], htmlspecialchars($a['cui']), htmlspecialchars($a['direccion']),
     htmlspecialchars($a['numero1']), htmlspecialchars($a['numero2']), htmlspecialchars($a['estado']), htmlspecialchars($a['nombre1']), htmlspecialchars($a['nit']), $a['venta']);
}
?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Detalle Cliente</title>
</head>
<body>
  <?php $this->load->view('menu'); ?>
<div class="container-fluid">
  <header class="espacio">
    <br>
    <h3><i class="fa fa-user-cog"></i> Detalle del Cliente</h3>
  </header>
  <br>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <th>Código</th>
        <th>Nombre del Cliente</th>
        <th class='text-center'>CUI</th>
        <th>Dirección</th>
        <th class='text-center'>No. Tel 1</th>
        <th class='text-center'>No. Tel 2</th>
      </thead>
      <tbody>
        <?php
          foreach ($arr as $a){
         ?>
          <tr>
            <td class="text-center"><?php echo $a['codigo'] ;?></td>
            <td class="text-center"><?php echo $a['nombre'] ;?></td>
            <td class="text-center"><?php echo $a['cui'] ;?></td>
            <td class="text-center"><?php echo $a['direccion'] ;?></td>
            <td class="text-center"><?php echo $a['numero1'] ;?></td>
            <td class="text-center"><?php echo $a['numero2'] ;?></td>
          </tr>
         <?php } ?>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">Estado del Cliente</th>
        <th class="text-center">Quién Registró</th>
        <th class='text-center'>NIT</th>
        <th class='text-center'>Tiene Venta?</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($arr as $a){
         ?>
        <tr>
            <td>
              <?php if($a['estado'] == 'A'){ ;?>
                <h6 class="text-center" style="color: blue;"><i class="fa fa-star"></i> Cliente Activo</h6>
              <?php } else { ;?>
                <h6 class="text-center">--</h6>
              <?php }; ?>
            </td>
            <td class="text-center"><?php echo $a['nombre1'] ;?></td>
            <td class="text-center"><?php echo $a['nit'] ;?></td>
            <td>
            <?php if ($a['venta'] == 'V') { ?>
            <center><h6 style="color: red"><i class="fa fa-cart-plus"></i> Tiene venta registrada</h6></center>
            <?php } else {?>
              <center><h6 style="color: green"><i class="fa fa-check"></i> Sin venta</h6></center>
            <?php } ?>
          </td>
        </tr>
         <?php } ?>
      </tbody>
    </table>
    <br>
    <center>
      <a class='btn btn-primary btn-lg' href="<?=$base_url?>/cliente/listar">Listo</a></center>
    <div class="label label-danger label-md" onclick="$(this).hide(1000)"><?=$mensaje?></div>
  </div><br><br>
</div>
  <footer><?php $this->load->view('footer') ?></footer>
</body>
</html>
