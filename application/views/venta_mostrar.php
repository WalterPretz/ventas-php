<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Guatemala');
$mensaje = isset($mensaje) ? $mensaje : "";

$sub_total    = 0;
$total        = 0;

if (count($compro) < 1) {
  $mensaje = "<script>alert.success('No hay ningún usuario registrado');</script>";
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
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
       </tr>\n";
$htmltrows = "";

foreach ($compro as $a) {
$htmltrows .= sprintf($htmltrow, 
    $a['id_comprobante'], $a['fecha'], $a['hora'], $a['nombreU'], $a['nombreT'], $a['direccion'], $a['nit'], $a['telefono'], $a['codigo'], $a['nombreP'],$a['descripcion'],$a['cantidad'], $a['precio_venta'],$a['descuento']);
}
?><!DOCTYPE html>
<html lang="es">
<link rel="icon" href="/ventas-umg/recursos/img/w.ico">
<style type="text/css">

@import url('/ventas-umg/recursos/font/BrixSansRegular.css');
@import url('/ventas-umg/recursos/font/BrixSansBlack.css');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
p, label, span, table{
    font-family: 'BrixSansRegular';
    font-size: 13pt;
}

@media print {
  p, label, span, table {
    font-size: 9pt;
  }
}


.h2{
    font-family: 'BrixSansBlack';
    font-size: 18pt;
}
.h3{
    font-family: 'BrixSansBlack';
    font-size: 12pt;
    display: block;
    background: #0303C6;
    color: #FFF;
    text-align: center;
    padding: 3px;
    margin-bottom: 5px;
}
#page_pdf{
    width: 95%;
    margin: 15px auto 10px auto;
}

#factura_head, #factura_cliente, #factura_detalle{
    width: 100%;
    margin-bottom: 10px;
}
.logo_factura{
    width: 25%;
}
.info_empresa{
    width: 50%;
    text-align: center;
}
.info_factura{
    width: 25%;
}
.info_cliente{
    width: 100%;
}
.datos_cliente{
    width: 100%;
}
.datos_cliente tr td{
    width: 50%;
}
.datos_cliente{
    padding: 10px 10px 0 10px;
}
.datos_cliente label{
    width: 75px;
    display: inline-block;
}
.datos_cliente p{
    display: inline-block;
}

.textright{
    text-align: right;
}
.textleft{
    text-align: left;
}
.textcenter{
    text-align: center;
}
.round{
    border-radius: 10px;
    border: 1px solid #0a4661;
    overflow: hidden;
    padding-bottom: 15px;
}
.round p{
    padding: 0 15px;
}

#factura_detalle{
    border-collapse: collapse;
}
#factura_detalle thead th{
    background: #000964;
    color: #FFF;
    padding: 5px;
}
#detalle_productos tr:nth-child(even) {
    background: #ededed;
}
#detalle_totales span{
    font-family: 'BrixSansBlack';
}
.nota{
    font-size: 8pt;
}
.label_gracias{
    font-family: verdana;
    font-weight: bold;
    font-style: italic;
    text-align: center;
    margin-top: 20px;
}
.anulada{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translateX(-50%) translateY(-50%);
}
@media print {
  .oculalimprimir {
    display: none;
  }
}

@media print{
    #mostrarimprimir{
    display: block !important;
    }
}
.botones {
  border-radius: 1.5rem;
  -webkit-box-shadow: 2px 2px 5px #999;
  background-color: #00079C;
  color: #fff;
}
.btn{
    border-radius: 10px;
    padding: 10px;
    margin: 5px;
}
.footer {
  height: 3rem;
  background-color: #e2e2e2;
  text-align: center;
  padding-top: 15px;
  font-weight: bold;
  font-size: 14px;
}
.aho{
    font-family: 'BrixSansBlack';
    color: blue;
}

@media (min-width: 576px) {
  .container {
    max-width: 540px;
  }
}

@media (min-width: 768px) {
  .container {
    max-width: 720px;
  }
}

@media (min-width: 992px) {
  .container {
    max-width: 960px;
  }
}

@media (min-width: 1200px) {
  .container {
    max-width: 1140px;
  }
}

.container-fluid, .container-sm, .container-md, .container-lg, .container-xl {
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

@media (min-width: 576px) {
  .container, .container-sm {
    max-width: 540px;
  }
}

@media (min-width: 768px) {
  .container, .container-sm, .container-md {
    max-width: 720px;
  }
}

@media (min-width: 992px) {
  .container, .container-sm, .container-md, .container-lg {
    max-width: 960px;
  }
}

@media (min-width: 1200px) {
  .container, .container-sm, .container-md, .container-lg, .container-xl {
    max-width: 1140px;
  }
}
.form-control {
  display: block;
  width: 100%;
  height: calc(1em + 0.75rem + 2px);
  padding: 0.2rem 0.5rem;
  font-size: 12px;
  line-height: 1.5;
  color: #000000;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #000964;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
  .form-control {
    transition: none;
  }
}

.form-control::-ms-expand {
  background-color: transparent;
  border: 0;
}

.form-control:-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 #495057;
}

.form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color: #80bdff;
  outline: 0;
  
}

.form-control::-webkit-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control::-moz-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control:-ms-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control::-ms-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control::placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control:disabled, .form-control[readonly] {
  background-color: #e9ecef;
  opacity: 1;
}

select.form-control:focus::-ms-value {
  color: #495057;
  background-color: #fff;
}

.form-control-file,
.form-control-range {
  display: block;
  width: 100%;
}

.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
.col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm,
.col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
.col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg,
.col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
.col-xl-auto {
  position: relative;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
}
.col-sm-2 {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
  }
.col-sm-4 {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
  }
.col-sm-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }

 .col-sm-7 {
    -ms-flex: 0 0 58.333333%;
    flex: 0 0 58.333333%;
    max-width: 58.333333%;
}

.col-sm-1 {
    -ms-flex: 0 0 8.333333%;
    flex: 0 0 8.333333%;
    max-width: 8.333333%;
    }

.form-row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -5px;
  margin-left: -5px;
}

.form-row > .col,
.form-row > [class*="col-"] {
  padding-right: 5px;
  padding-left: 5px;
}

</style>
<head>
    <meta charset="UTF-8">
    <title>Venta_No._<?php echo $a['id_comprobante'] ;?>_<?php echo $a['fecha']; ?></title>
</head>
<body>
<?php 
$number = $a['id_comprobante'];
$length = 10;
$string = substr(str_repeat(0, $length).$number, - $length);
; ?>

<div id="page_pdf">
    <table id="factura_head">
        <tr>
            <td class="logo_factura">
                <div>
                    <img src="/ventas-umg/recursos/img/172.png" height="100">
                </div>
            </td>
            <td class="info_empresa">
                <div>
                    <div><strong><h3>UMG VENTAS</h3></strong></div>
                    <div class="form-group col-md-9">
                    <h3>4ta. Calle Final, Zona 1, Totonicapán, Guatemala</h3>
                  </div>
                  <h4 id="direccionSeleccionado"></h4>
                    <div>Tels. 47162720 / 7766-2954</div>
                  </div>
            </td>
            <td class="info_factura">
                <div class="round">
                    <span class="h3">COMPROBANTE</span>
                    <p>No. Fac: <strong style="color: red;"> <?php echo $string ;?></strong></p>
                    <p>Fecha: <?php echo $a['fecha']; ?></p>
                    <p>Hora: <?php echo $a['hora']; ?></p>
                    <p>Ven: <?php echo $a['nombreU']; ?></p>
                </div>
            </td>
        </tr>
    </table>
    <table id="factura_cliente">
        <tr>
            <td class="info_cliente">
                <div class="round">
                    <table class="datos_cliente">
                        <tr>
                            <td><label>Nit:</label> <p><?php echo $a['nit']; ?></p></td>
                        </tr>
                        <tr>
                            <td><label>Teléfono:</label> <p><?php echo $a['telefono']; ?></p></td>
                        </tr>
                        <tr>
                            <td><label>Nombre:</label> <p><?php echo $a['nombreT']; ?></p></td>
                        </tr>
                        <tr>
                            <td><label>Dirección:</label> <p><?php echo $a['direccion']; ?></p></td>
                        </tr>
                    </table>
                </div>
            </td>

        </tr>
    </table>
    <table id="factura_detalle">
    <thead>
        <tr>
        <th width="75px">CÓD</th>
        <th width="50px">CANT</th>
        <th class="textleft" width="450px">DESCRIPCIÓN</th>
        <th class="textright" width="130px">P/UNITARIO</th>
        <th class="textright" width="130px">DESCUENTO</th>
        <th class="textright" width="130px">PRECIO TOTAL</th>
      </tr>
    </thead>
    <!--PDESC-->
    <?php foreach ($compro as $a){ 
        $precioTotal = round(($a['cantidad'] * $a['precio_venta']) - $a['descuento'], 2);
        $sub_total = round($sub_total + $precioTotal, 2);
        $total = round($total + $precioTotal, 2);
    ?> 
        <tbody id="detalle_productos">
            <tr>
                <td class="textcenter"><?php echo $a['codigo'] ;?></td>
                <td class="textcenter"><?php echo $a['cantidad'] ;?></td>
                <td><?php echo $a['nombreP'] ;?>, <?php echo $a['descripcion'] ;?></td>
                <td class="textright">Q. <?php echo number_format($a['precio_venta'],2, '.', ' ') ;?></td>
                <td class="textright">Q. <?php echo number_format($a['descuento'],2, '.', ' ') ;?></td>
                <td class="textright">Q. <?php echo number_format($precioTotal,2, '.', ' ') ;?></td>
            </tr>
        <?php } ?>
        </tbody>
    </div>
    </table>
<!--Incluímos la clase pago  -->

<?php

    $totalpagar = $total;
    require_once("recursos/numLetras/CifrasEnLetras.php");
    $v=new CifrasEnLetras(); 
    //Convertimos el total en letras
    $letra=($v->convertirEurosEnLetras($totalpagar));
?>
<center>___________________________________________________________________________________________</center>
<br>
<div>
    <div class="form-row">
        <div class="col-sm-2">
            <h4 style="text-align: right; padding-top: 6px; font-family: 'BrixSansBlack'" > Total en letras: </h4>
        </div>
        <div class="col-sm-7"> 
            <input type="text" class="form-control negro" value="<?php echo $letra; ?>" disabled>
        </div>
        <div class="col-sm-1">
            <h5 style="text-align: right; padding-top: 6px; font-family: 'BrixSansBlack'" >TOTAL</h5>
        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control negro" style="text-align: right;" required value="Q. <?php echo number_format($total,2, '.', ' ') ;?>" disabled>
        </div>
    </div>
</div>
<center>___________________________________________________________________________________________</center>
    <div>
        <h5 class="label_gracias">Gracias por preferirnos, esperamos servirle pronto!</h5>
        <br>        
    </div>
    <center>
      <a class='btn btn-primary btn-lg botones oculalimprimir' href="<?=$base_url?>/venta/listar">Regresar</a>
      <a class='btn btn-success btn-lg botones oculalimprimir' onclick="window.print('')" href="#"><i class="icon icon-printer" style="color: #fff;"></i> Imprimir</a>
  </center>
</div>
<div>
    <section id="mostrarimprimir" style="display: none">
        <center>
        <img src="/ventas-umg/recursos/img/w.ico" height="50">
        </center>
        <center>
        <h3 class="aho">AHORRO - CALIDAD - BUEN PRECIO</h3>
        </center>
    </section>
</div>
<br>
<footer class="footer">
  <p>Ingeniería en Sistemas UMG | Walter Pretzantzín </p>
</footer>
</body>
</html>