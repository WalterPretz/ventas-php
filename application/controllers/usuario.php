<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuario extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Usuario_model');
	}

	private function restringirAcceso() {
		if (!isset($this->session->USUARIO)) {
			redirect("usuario/login");
		}
	}

	public function index(){
		$data['base_url'] = $this->config->item('base_url');
	}

	public function login() {
		$data['base_url'] = $this->config->item('base_url');

		if (isset($this->session->USUARIO)) {
			redirect('/inicio'); // /controller/method
		}

		if ($this->input->post('login') == 'Ingresar') {
			$usuario = $this->input->post('usuario');
			$clave = $this->input->post('clave');
			$id = $this->Usuario_model->autenticarUsuario($usuario, $clave);
			if ($id > 0) {
				//Establecer variables de sesion
				$this->session->USUARIO = $usuario;
				$this->session->IDUSUARIO = $id[0]['id_usuario'];
				$this->session->ROL = $id[0]['rol'];
				$this->session->NOMBRE = $id[0]['nombre'];
				redirect("inicio/inicio");
			} else {
				$data["mensaje"] = "Usuario o clave incorrectos!";
			}
		}

		$this->load->view('login', $data);
	}

	public function logout() {
		$this->session->sess_destroy(); // Destruir todas las variables de sesión
		redirect("/inicio");
	}

	public function crear() {
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		$data['cui'] = "";
		$data['nombre'] = '';
		$data['apellido'] = '';
		$data['fecha_nacimiento'] = '';
		$data['numero1'] = '';
		$data['numero2'] = '';
		$data['direccion'] = '';
		$data['usuario'] = '';
		$data['cargo'] = '';
		$data['rol'] = '';
		$data['email'] = '';
		$data['clave'] = '';
		$data['clave2'] = '';
		$data['mensaje'] = '';

		if (isset($_POST['guardar'])) {
			$data['cui'] = str_replace(["<",">"], "", $_POST['cui']);
			$data['nombre'] = str_replace(["<",">"], "", $_POST['nombre']);
			$data['apellido'] = str_replace(["<",">"], "", $_POST['apellido']);
			$data['fecha_nacimiento'] = str_replace(["<",">"], "", $_POST['fecha_nacimiento']);
			$data['numero1'] = str_replace(["<",">"], "", $_POST['numero1']);
			$data['numero2'] = str_replace(["<",">"], "", $_POST['numero2']);
			$data['direccion'] = str_replace(["<",">"], "", $_POST['direccion']);
			$data['usuario'] = str_replace(["<",">"], "", $_POST['usuario']);
			$data['cargo'] = str_replace(["<",">"], "", $_POST['cargo']);
			$data['rol'] = str_replace(["<",">"], "", $_POST['rol']);
			$data['email'] = str_replace(["<",">"], "", $_POST['email']);
			$data['clave'] = $_POST['clave'];
			$data['clave2'] = $_POST['clave2'];

			if ($data['clave'] != $data['clave2']) {
				$data['mensaje'] = "Las claves no coinciden.";
			} else if (strlen($data['clave']) < 8) {
				$data['mensaje'] = "La clave debe tener al menos 8 caracteres.";
			} else {
				//Todos los datos son correctos, guardar en la BD.
				$this->Usuario_model->crearPersona($data['nombre'], $data['apellido'], $data['fecha_nacimiento'], $data['direccion']);
				$id_persona = $this->Usuario_model->seleccionar_id_persona();//busaca el id de la persona
				$this->Usuario_model->crearPersonaTelefono($data['numero1'], $data['numero2'], $id_persona);
				$this->Usuario_model->crearUsuarioSistema($data['cui'], $data['cargo'], $data['usuario'], $data['clave'], $data['rol'], $data['email'], $id_persona);

				redirect("/usuario/mostrar_insercion/${data['cui']}");
			}
		}
		$this->load->view('usuario_crear', $data);
	}

	public function validar(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		$cuiVerificar = "";
			//Busca a contratista en BD
		$cuiVerificar = $_POST['cui_user'];
		$data['result'] = $this->Usuario_model->seleccionarCuiUsuario($cuiVerificar);
		//verifica si exite el contratista
		$retorno = count($data['result']);
		echo $retorno; //retorna el resultado de la busqueda

	}

	public function mostrar_insercion($cui = 0) {
		$data['base_url'] = $this->config->item('base_url');
		$this->restringirAcceso();

		$data['arr'] = $this->Usuario_model->mostrar_insercion($cui);
		$data['mensaje'] = "Datos ingresados exitosamente";

		if ($cui == 0) {
			redirect("/usuario/crear");
		}
		$this->load->view('usuario_mostrar_detalle', $data);
	}

	public function listar(){
		$data['base_url'] = $this->config->item('base_url');
		$this->restringirAcceso();

		$data['arr'] = $this->Usuario_model->listarUsuarios();
		$this->load->view('usuario_listar', $data);
	}

	function buscarRegistro(){
		$data['base_url'] = $this->config->item('base_url');
		$this->restringirAcceso();

		if(!empty($_POST['id_usuario'])){
        $data['id_usuario'] = $_POST['id_usuario'];
        $arr = $this->Usuario_model->buscarUsuarioRegis($data['id_usuario']);

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

	function buscarRegistroUsuario(){
		$data['base_url'] = $this->config->item('base_url');
		$this->restringirAcceso();

		if(!empty($_POST['id_usuario'])){
        $data['id_usuario'] = $_POST['id_usuario'];
        $arr = $this->Usuario_model->buscarRegisUsuarioActualizar($data['id_usuario']);

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

	function darBajaUser(){
		$data['base_url'] = $this->config->item('base_url');
		$this->restringirAcceso();

		if($_POST['action'] == 'eliminarRegi'){
	 		if(!empty($_POST['id_c'])){
	        $data['id_usuario'] = $_POST['id_c'];
	        $arr = $this->Usuario_model->darBajaUusario($data['id_usuario']);
	   		}
	   	}
	}

	function actualizarUsuario(){
		if(($_POST['action'] == 'actualizar_registro') & (empty($_POST['id_usuarioa'])) ){
			echo "error";
		}else {

		$id_usuario = $_POST['id_usuarioa'];
		$id_persona = $_POST['id_persona'];
		$data['cui'] = $_POST['cui'];
		$data['nombre'] = $_POST['nombre'];
		$data['apellido'] = $_POST['apellido'];
		$data['fecha_nacimiento'] = $_POST['nacimiento'];
		$data['numero1'] = $_POST['numero1'];
		$data['numero2'] = $_POST['numero2'];
		$data['direccion'] = $_POST['direccion'];
		$data['usuario'] = $_POST['usuario'];
		$data['cargo'] = $_POST['cargo'];
		$data['rol'] = $_POST['rol'];
		$data['email'] = $_POST['email'];

		//Todos los datos son correctos, guardar en la BD.
			$this->Usuario_model->actualizarPersona($data['nombre'], $data['apellido'], $data['fecha_nacimiento'], $data['direccion'], $id_persona);
			$this->Usuario_model->actualizarPersonaTelefono($data['numero1'], $data['numero2'], $id_persona);
			$this->Usuario_model->actualizarUsuarioSistema($data['cui'], $data['cargo'], $data['usuario'], $data['clave'], $data['rol'], $data['email'], $id_usuario);

			$result = '1';
        $data1 = '1';
        if($result > 0){
          $data1 = $arr;
        }else{
          $data1 = 0;
        }
      echo json_encode($data1, JSON_UNESCAPED_UNICODE);
		} 
		
	}


}
