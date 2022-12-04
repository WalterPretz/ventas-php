<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Acerca de esta aplicación</title>
</head>
<body>

<div class="espacio fondoace container-fluid">
  <?php $this->load->view('menu'); ?>
  <header class="container-fluid">
    <h3><img width="40" src="<?=$base_url?>/recursos/img/in.png"/> Acerca de...</h3>
  </header>
</div>
 <section class="showcase container-fluid">
    <div class="container-fluid p-0">   
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('<?=$base_url?>/recursos/img/cod.jpg');"></div>
        <div class="col-lg-6 my-auto showcase-text">
        <img src="<?=$base_url?>/recursos/img/172.png" width="120" style="margin-right: 150px"/>
          <h2>Proyecto UMG 2021</h2>
          <p class="lead mb-0">Esta aplicación fue desarrollada como parte del proceso de formación académica de Ingenieros en Sistemas de Información de la Facultad de Ingeniería en Sistemas, Universidad Mariano Gálvez.</p><br>
          <p>Totonicapán, <?=date("Y")?>.</p>
      <p>Prof. Walter Pretzantzín</p>
        </div>
      </div>
    </div>
  </section>
  <footer><?php $this->load->view('footer') ?></footer>
</body>
</html>
