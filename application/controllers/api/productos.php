<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'libraries/REST_Controller.php';

class Productos extends REST_Controller{

	public function __construct()	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Productos_model');

	}

	public function index_get(){
		$productos =  $this->Productos_model->seleccionarProductoRegistrado();

		if(count($productos) > 0) {
			$this->response(array(
				"estado" => 1,
				"mensaje" => "Productos encontrados",
				"productos" => $productos
			), REST_Controller::HTTP_OK);
		} else {
			$this->response(array(
				"estado" => 1,
				"mensaje" => "Productos no encontrados",
				"productos" => $productos
			), REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function unicoproducto_get(){
		$producto =  $this->Productos_model->seleccionarUnicoProducto();

		if(count($producto) > 0) {
			$this->response(array(
				"mensaje" => "Producto encontrado",
				"estado" => 1,
				"producto" => $producto
			), REST_Controller::HTTP_OK);
		} else {
			$this->response(array(
				"estado" => 1,
				"mensaje" => "Producto no encontrado",
				"producto" => $producto
			), REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
?>