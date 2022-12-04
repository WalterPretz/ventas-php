<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cliente extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Cliente_model');
	}

	private function restringirAcceso() {
		if (!isset($this->session->USUARIO)) {
			redirect("usuario/login");
		}
	}

	function index(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if (isset($_GET['codigo'])) {
			$data['codigo'] = "";
			$data['codigo'] = $_GET['codigo'];
		}
		$data['boton'] = "";
		$data['codigo'] = "";
		$data['nombre'] = "";
		$data['cui'] = "";
		$data['direccion'] = "";
		$data['numero1'] = "";
		$data['numero2'] = "";
		$data['nit'] = "";
		$data['id_usuario'] = $this->session->IDUSUARIO;
		$data['boton'] = "<input class=\"btn btn-outline-primary btn-md botones\" type=\"submit\" role=\"button\" name=\"guardar\" value=\"Guardar\">";

		if (isset($_POST['guardar'])) {
			$data['codigo'] = $_POST['codigo'];
			$data['nombre'] = str_replace(["<",">"], "", $_POST['nombre']); 
			$data['cui'] = str_replace(["<",">"], "", $_POST['cui']); 
			$data['direccion'] = str_replace(["<",">"], "", $_POST['direccion']);
			$data['numero1'] = str_replace(["<",">"], "", $_POST['numero1']);
			$data['numero2'] = str_replace(["<",">"], "", $_POST['numero2']);
			$data['nit'] = str_replace(["<",">"], "", $_POST['nit']);

			$validacion = $this->Cliente_model->seleccionarCliente1($data['codigo']);
			
			if ($validacion == 0 and $data['codigo'] != 0) {
			$this->Cliente_model->crearClienteNuevo($data['codigo'], $data['nombre'], $data['cui'], $data['direccion'], $data['id_usuario'], $data['nit']);

			$id_cliente = $this->Cliente_model->seleccionarIdCliente($data['codigo']);
			$this->Cliente_model->telefono($id_cliente, $data['numero1'], $data['numero2']);

			$data['boton'] = "<a class=\"btn btn-outline-success\" href=\"Cliente\" role=\"button\">Registrar a otro cliente</a>";

			} elseif ($validacion == 1 ) {
				$data['mensaje'] = "<script>alert.error('Código Existente');</script>";
			}

			$data['mensaje'] = "<script>alert.success('Datos guardados exitosamente');</script>";
		}
		$data['codCliente'] = $this->Cliente_model->buscarNumeroCliente();
		$this->load->view('cliente_crear', $data);
	}

	public function listar(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Cliente_model->seleccionarCliente();
		$this->load->view('cliente_listar', $data);
	}

	public function editar($id = 0) {
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		$data['arr'] = $this->Cliente_model->seleccionarClientes($id);
		
		$data['codigo'] = "";
		$data['nombre'] = "";
		$data['cui'] = "";
		$data['direccion'] = "";
		$data['nit'] = "";
		$data['numero1'] = "";
		$data['numero2'] = "";
		$id_cliente = "";

		if (isset($_POST['actualizar'])) {
			$data['codigo'] = $_POST['codigo'];
			$data['nombre'] = $_POST['nombre']; 
			$data['cui'] = $_POST['cui'];
			$data['nit'] = $_POST['nit'];
			$data['direccion'] = $_POST['direccion'];
			$data['numero1'] = $_POST['numero1'];
			$data['numero2'] = $_POST['numero2'];
			$data['id_cliente'] = $_POST['id_clientito'];

			$this->Cliente_model->actualizarCliente($data['id_cliente'], $data['codigo'], $data['nombre'], $data['cui'], $data['direccion'], $data['nit']);
			$this->Cliente_model->actualizarTelefono($data['id_cliente'], $data['numero1'], $data['numero2']);

			redirect("/cliente/listar");
		}
		$this->load->view('cliente_editar', $data);
	}

	//detalle del cliente

	public function det($id = 0){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Cliente_model->seleccionarClientes($id);
		$this->load->view('cliente_detalle', $data);
	}

	public function buscarRegistro(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if(!empty($_POST['id_cliente'])){
        $data['id_cliente'] = $_POST['id_cliente'];
        $arr = $this->Cliente_model->buscarClienteRegis($data['id_cliente']);

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
	
//dar baja al cliente
	function darBajaCli(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if($_POST['action'] == 'eliminarRegi'){
	 		if(!empty($_POST['id_c'])){
	        $data['id_cliente'] = $_POST['id_c'];
	        $arr = $this->Cliente_model->darBajaCliente($data['id_cliente']);
	   		}
	   	}
	}
}
