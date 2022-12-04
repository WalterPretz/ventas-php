<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

if (count($arr) < 1) {
  $mensaje = "<script>alertify.set('notifier','position', 'top-right');alertify.success('No hay ningún Producto registrado');</script>";
}

$htmltrow = "<tr>
        <td>%s</td> 
        <td>%s</td>
        <td>Q. %s.00</td>
        <td>Q. %s.00</td>
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
  htmlspecialchars($a['codigo']), htmlspecialchars($a['nombreProducto']),  number_format($a['precio_compra']),  number_format($a['precio_venta']), $a['existencia'], htmlspecialchars($a['proveedor']), $a['fecha_registro'], $a['nombreU'], $a['fecha_modifica'], $a['nombreM']);
}
?><!DOCTYPE html>
<html lang="es">
<style>
th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;
}
#t01 tr:nth-child(even) {
  background-color: #eee;
}
#t01 tr:nth-child(odd) {
 background-color: #fff;
}
#t01 th {
  background-color: #0E1154; 
  color: white;
}
</style>
<head>
  <?php $this->load->view('header'); ?>
  <title>Productos Detalles</title>
</head>
<body>
  <?php $this->load->view('menu'); ?>
<header class="espacio">
  <h3 style="text-align: center; color: #03064A">Listado detallado de productos registrados en el sistema</h3>
</header>
<a href="javascript:history.back()" class="btn btn-primary" type="button"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
<br>
<section class="container-fluid">
  <div class="table-responsive">
    <table class="table table-bordered" id="productos">
    <thead> 
      <tr id="letra_info" class="iconost">
        <th>CODIGO</th>
        <th>DESCRIPCIÓN</th>
        <th>PRECIO COMPRA</th>
        <th>PRECIO VENTA</th>
        <th>CANT</th>
        <th>PROVEEDOR</th>
        <th>FECHA REGISTRO</th>
        <th>QUIÉN REGISTRÓ</th>
        <th>FECHA MODIFICACIÓN</th>
        <th>QUIÉN MODIFICÓ</th>
      </tr>
    </thead>
    <tbody>
      <?=$htmltrows?>
    </tbody>
    </table>
  </div>
</section>
<a href="javascript:history.back()" class="btn btn-primary" type="button"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
<h4 class="text-center">Totonicapán, <?=date("d/m/Y | h:i:s a")?>.</h4>
<br>
<footer class="oculalimprimir"><?php $this->load->view('footer') ?></footer>
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
</script>
</body>
</html>

