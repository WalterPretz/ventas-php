<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class producto extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Producto_model');
		$this->load->model('Proveedor_model');
	}

	private function restringirAcceso() {
		if (!isset($this->session->USUARIO)) {
			redirect("usuario/login");
		}
	}

	public function index(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
	
		$data['codigo'] = "";
		$data['nombre'] = "";
		$data['descripcion'] = "";
		$data['precio_compra'] = "";
		$data['precio_venta'] = "";
		$data['existencia'] = "";
		$data['id_provProducto'] = "";
		$data['fecha_registro'] = date("Y-m-d H:i:s");
		$data['id_usuario_registro'] = $this->session->IDUSUARIO;
		$data['fecha_modifica'] = '';
		$data['id_usuario_modifica'] = "1";
		$data['imagen'] = "";
		$data['id_control'] = "";
		$data['mensaje'] = "";
		$dataimg = "";
	
		if (isset($_POST['guardar'])) {

			$dataimg =$_FILES['foto'];
			$nombreFoto = $dataimg['name'];
			$type = $dataimg['type'];
			$url_temp = $dataimg['tmp_name'];

			$destino = 'recursos/upload/';
			$img_nombre = 'img_'.date('d-m-Y_H-m-s');
			$imgProducto = $img_nombre.'.jpg';
			$src = $destino.$imgProducto;
			move_uploaded_file($url_temp, $src);

			$data['codigo'] = $_POST['codigo'];
			$data['nombre'] = str_replace(["<",">"], "", $_POST['nombre']);
			$data['descripcion']= str_replace(["<",">"], "", $_POST['descripcion']); 
			$data['precio_compra'] = $_POST['precio_compra'];
			$data['precio_venta'] = $_POST['precio_venta'];
			$data['existencia'] = $_POST['existencia'];
			$data['id_provProducto'] = $_POST['proveedor'];
			$data['imagen'] = $imgProducto;

				//Todos los datos son correctos, guardar en la BD.
			$this->Producto_model->crearProducto($data['codigo'], $data['nombre'], $data['descripcion'], $data['precio_compra'], $data['precio_venta'], $data['existencia'], $data['id_provProducto'], $data['imagen']);

			$id_producto = $this->Producto_model->selecIdProductoP($data['codigo']);
				$this->Producto_model->crearControl($id_producto, $data['fecha_registro'], $data['id_usuario_registro'], $data['fecha_modifica'], $data['id_usuario_modifica']);
			redirect("/producto/listar");
		}

		$this->load->view('producto_crear', $data);
	}

	//funcion para buscar al proveedor en la base de datos
	function proveedor(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['proveedor'] =  $this->Producto_model->seleccionarProveedorP();
		echo '<option selected disabled value="">Buscar</option>';
		foreach ($data['proveedor'] as $key) {
		echo '<option value="'.$key['id_proveedor'].'">'.$key['nombre'].'</option>'."\n";
		}
	}

	function valiData(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

			if($_POST['action'] == 'buscarCodigo'){

	        $data['codigo'] = $_POST['cod'];

	        $arr = $this->Producto_model->selCodExistenteProd($data['codigo']);

	            $result = $arr;
	            $data = '';
	            if($result > 0){
	              $data = $arr;
	            }else{
	              $data = 0;
	            }
	        echo json_encode($data, JSON_UNESCAPED_UNICODE);
	     }
	}

	public function listar () {
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		$data['arr'] = $this->Producto_model->seleccionarProductoRegistrado();
		$this->load->view('producto_listar', $data);

	}

	function detalleGeneral(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		$data['arr'] = $this->Producto_model->descargarDetallado();
		$this->load->view('producto_listar_detallado', $data);
	}

	//buscar info del productos a ser eliminador
	function buscarRegistroProducto(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if(!empty($_POST['id_producto'])){
        $data['id_producto'] = $_POST['id_producto'];
        $arr = $this->Producto_model->buscarProductoRegistro($data['id_producto']);

            $result = $arr;
            $data = '';
            if($result > 0){
              $data = $arr;
            }else{
              $data = 0;
            }
        	echo json_encode($data, JSON_UNESCAPED_UNICODE);
      	}
    	exit;
	}

	function daraBajaProd(){
		$this->restringirAcceso();
		if($_POST['action'] == 'eliminarRegi'){
		    if(!empty($_POST['id_prod'])){
	          $data['id_producto'] = $_POST['id_prod'];
	          $arr = $this->Producto_model->darBajaProducuto($data['id_producto']);
	      
	          $resultado = $arr;
	          	if($resultado > 0){
	            	$data = $arr;
	            	echo json_encode($data, JSON_UNESCAPED_UNICODE);
	          	}
		    }
		}
	}

	public function actualizarProducto(){
		$this->restringirAcceso();

		if(($_POST['action'] == 'updateRegi') & (empty($_POST['id_producto'])) ){
			echo "error";
		}else {

		$data['id_producto'] = $_POST['id_producto'];
		$data['codigo'] = $_POST['codigoup'];
		$data['nombreProducto'] = $_POST['nombreup'];
		$data['descripcion'] = $_POST['descripcionup'];
		$data['precio_compra'] = $_POST['precioc'];
		$data['precio_venta'] = $_POST['preciov'];
		$data['existencia'] = $_POST['existenciaup'];
		$data['fecha_modifica'] = date("Y-m-d H:i:s");
		$data['id_usuario_modifica'] = $this->session->IDUSUARIO;

		//Todos los datos son correctos, guardar en la BD.
			$this->Producto_model->actualizarProducto($data['id_producto'], $data['codigo'], $data['nombreProducto'], $data['descripcion'], $data['precio_compra'], $data['precio_venta'], $data['existencia']);

		$arr = 	$this->Producto_model->actualizarControl($data['id_producto'], $data['fecha_modifica'], $data['id_usuario_modifica']);

		$result = '1';
        $data1 = '';
        if($result > 0){
          $data1 = $arr;
        }else{
          $data1 = 0;
        }
      	echo json_encode($data1, JSON_UNESCAPED_UNICODE);
		} 

	}



}