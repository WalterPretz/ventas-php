<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<script type="text/javascript" src="<?=$base_url?>/recursos/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$base_url?>/recursos/js/bootstrap.min.js"/></script>
<script type="text/javascript" src="<?=$base_url?>/recursos/jquery-numeric-master/jquery.numeric.min.js"></script>
<script type="text/javascript" src="<?=$base_url?>/recursos/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="<?=$base_url?>/recursos/SweetAlert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?=$base_url?>/recursos/SweetAlert/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?=$base_url?>/recursos/js/popper.min.js"></script>
<script type="text/javascript" src="<?=$base_url?>/recursos/fontAwesome/js/all.min.js"></script>


<link rel="icon" href="<?=$base_url?>/recursos/img/w.ico">
<link href="<?=$base_url?>/recursos/css/bootstrap.min.css" rel="stylesheet"/>
<link type="text/css" href="<?=$base_url?>/recursos/fontAwesome/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=$base_url?>/recursos/DataTables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>/recursos/SweetAlert/sweetalert2.min.css"/>

<style type="text/css" media="screen">
.espacio{
	padding-top: 3.8rem;
}
.menu{
	background-color: #004FC5;
  box-shadow: 0px 0px 10px #FF0000;
}
#footer{
	background-color: #E9E9E9;
}
.texf{
	color: blue;
}

@media (max-width: 399px) {
  .imagen {
    height: 200px;
  }
}

@media (min-width: 400px) {
  .imagen {
    height: 300px;
  }
}

/*acerca*/
.showcase .showcase-text {
  padding: 3rem;
}

.showcase .showcase-img {
  min-height: 30rem;
  background-size: cover;
}

@media (min-width: 768px) {
  .showcase .showcase-text {
    padding: 7rem;
  }
}

.fondoace{
	background-color: #E0F4FE
}

.card {
    box-shadow: 2px 5px 10px #777;
}

/*log*/
.abs-center {
  display: flex;
  align-items: center;
  justify-content: center;
}
.container-fluid {
  width: 100%;
  padding-right: 0.75rem;
  padding-left: 0.75rem;
  margin-right: auto;
  margin-left: auto;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin-right: -0.75rem;
  margin-left: -0.75rem;
}

.fondoLogin{
  border-radius: 1rem;
  background-color: #fff;
}

.form-container{
  border: 1px solid blue;
  padding: 50px 60px;

-webkit-box-shadow: 2px 2px 5px #999;
-moz-box-shadow: 2px 2px 5px #999;
}
/*estilo de form de registro*/
.formestilo{
  padding: 1rem;
  border-radius: 10px;
  border: 2px solid;
  border-color: blue;

  -webkit-box-shadow: 2px 2px 5px #999;
  -moz-box-shadow: 2px 2px 5px #999;
}

.divespa{
  padding-top: 1.5rem;
}

/*para los divs*/
.ford {
  display: block;
  width: 100%;
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  border: #fff;
  color: #495057;
  border-color: #fff;
  background-color: #fff;
  border-bottom:  solid 2px blue;

}

@media (prefers-reduced-motion: reduce) {
  .ford {
    transition: none;
  }
}

.ford::-ms-expand {
  background-color: transparent;

}

.ford:-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 #495057;
}

.ford:focus {
  color: #000;
  background-color: #FEFFF7;
  border-bottom: solid red; 
  outline: 0;
}

.ford::-webkit-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.ford::-moz-placeholder {
  color: #6c757d;
  opacity: 1;
}

.ford:-ms-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.ford::-ms-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.ford::placeholder {
  color: #6c757d;
  opacity: 1;
}


input[type="date"].ford,
input[type="time"].ford,
input[type="datetime-local"].ford,
input[type="month"].ford {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

select.ford:focus::-ms-value {
  color: #495057;
  background-color: #fff;
}
.margeninferior{
  margin-bottom: -5px;
}

.usuario{
  padding: 18px;
  border-radius: 10px;
  border: solid 2px green;
  -webkit-box-shadow: 2px 2px 5px #999;
}

.entidad{
  padding: 18px;
  border-radius: 10px;
  border: solid 2px #5C2605;
  -webkit-box-shadow: 2px 2px 5px #999;
}
.quiejasec{
  padding: 18px;
  border-radius: 10px;
  border: solid 2px #AF0000;
  -webkit-box-shadow: 2px 2px 5px #999;
}

/*btn radio*/
input[type=radio] {
    width: 8%;
    height: 1rem;
}

/*estilo de los forms para avence*/

.form-step{
  display: none;
  transform-origin: top;
 
}


.form-step-active{
  display: block;
}

.progressbar{
  position: relative;
  display: flex;
  justify-content: space-between;
  counter-reset: step;
}

.progressbar::before, .progreso{
  content: "";
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  height: 4px;
  width: 100%;
  background-color: #dcdcdc;
  z-index: -1;
}
.progreso{
  background-color: #010DA6;
  width: 0%;
  transition: 0.3s;
}

.progress-step{
  width: 2.1875rem;
  height: 2.1875rem;
  background-color: #dcdcdc;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.progress-step::before {
  counter-increment: step;
  content: counter(step);
}

.progress-step::after{
  content: attr(data-title);
  position: absolute;
  top: calc(100% + 0.5rem);
  font-size: 0.85rem;
  color: #666;
}

.progress-step-active{
  background-color: #010DA6;
  color: #fff;
  font-weight: bold;
}

.btnsig{
  display: none;
}

/*Sección imagen de la factura*/
.prevPhoto {
    display: flex;
    justify-content: space-between;
    width: 160px;
    height: 150px;
    border: 1px solid #CCC;
    position: relative;
    cursor: pointer;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    margin: auto;
}
.prevPhoto label{
  cursor: pointer;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 2;
}
.prevPhoto img{
  width: 100%;
  height: 100%;
}
.upimg, .notBlock{
  display: none !important;
}

.delPhoto{
  color: #FFF;
  display: -webkit-flex;
  display: -moz-flex;
  display: -ms-flex;
  display: -o-flex;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  width: 25px;
  height: 25px;
  background: red;
  position: absolute;
  right: -10px;
  top: -10px;
  z-index: 10;
}

.resul{
  font-weight: bold;
  color: #000;
}

.result{
  color: red;
  font-weight: bold;
}




</style>