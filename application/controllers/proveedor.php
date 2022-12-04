<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class proveedor extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
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
	
		$data['boton'] = "";
		$data['nombre'] = "";
		$data['direccion'] = "";
		$data['telefono'] = "";
		$data['tipo'] = "";
		$data['correo'] = "";
		$data['id_usuario'] = $this->session->IDUSUARIO;
		$data['boton'] = "<input class=\"btn btn-outline-primary btn-md botones\" type=\"submit\" role=\"button\" name=\"guardar\" value=\"Guardar\">";

		if (isset($_POST['guardar'])) {
			$data['nombre'] = str_replace(["<",">"], "", $_POST['nombre']); 
			$data['direccion'] = str_replace(["<",">"], "", $_POST['direccion']);
			$data['telefono'] = str_replace(["<",">"], "", $_POST['telefono']);
			$data['tipo'] = str_replace(["<",">"], "", $_POST['tipo']);
			$data['correo'] = str_replace(["<",">"], "", $_POST['correo']);
			
			$this->Proveedor_model->crearProveedor($data['nombre'], $data['direccion'], $data['telefono'], $data['tipo'], $data['correo'], $data['id_usuario']);

			$data['mensaje'] = "<script>alertify.set('notifier','position', 'top-right');alertify.success('Datos guardados exitosamente');</script>";
			$data['boton'] = "<a class=\"btn btn-outline-success\" href=\"proveedor\" role=\"button\">Inscribir otro proveedor</a>";
			}

		$this->load->view('proveedor_crear', $data);
	}

	function listar() {
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Proveedor_model->seleccionarProveedor();
		$this->load->view('proveedor_listar', $data);
	}

	function buscarRegistro(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if(!empty($_POST['id_proveedor'])){
        $data['id_proveedor'] = $_POST['id_proveedor'];
        $arr = $this->Proveedor_model->buscarProveedorRegistro($data['id_proveedor']);

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

	function cambioEstadoProveedor(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if($_POST['action'] == 'eliminarRegi'){
	      if(!empty($_POST['id_prov'])){
	          $data['id_proveedor'] = $_POST['id_prov'];
	          $arr = $this->Proveedor_model->anularProveRegistro($data['id_proveedor']);
	      
	          $resultado = $arr;
	          if($resultado > 0){
	            $data = $arr;
	            echo json_encode($data, JSON_UNESCAPED_UNICODE);
	          }
	        }
	     }
	}

	function editarProveedor(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if($_POST['action'] == 'update'){
	      if(!empty($_POST['id_proveedor'])){
	          	$data['id_proveedor'] = $_POST['id_proveedor'];
	          	$data['nombre'] =  $_POST['nombreE']; 
				$data['direccion'] =  $_POST['direccionE'];
				$data['telefono'] =  $_POST['telefonoE'];
				$data['tipo'] =  $_POST['tipoE'];
				$data['correo'] =  $_POST['correoE'];

	          $arr = $this->Proveedor_model->updateProveRegistro($data['id_proveedor'], $data['nombre'], $data['direccion'], $data['telefono'], $data['tipo'], $data['correo']);
	      
	          $resultado = $arr;
	          if($resultado > 0){
	            $data = $arr;
	            echo json_encode($data, JSON_UNESCAPED_UNICODE);
	          }
	        }
	     }
	}
	
}
