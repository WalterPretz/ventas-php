<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inicio extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
	}

	private function restringirAcceso() {
		if (!isset($this->session->USUARIO)) {
			redirect("usuario/login");
		}
	}

	public function index(){
		$data['base_url'] = $this->config->item('base_url');
		$this->load->view('inicio', $data);
	}

	public function acerca(){
		$data['base_url'] = $this->config->item('base_url');
		$this->load->view('acerca', $data);
	}

	public function inicio(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$this->load->view('bienvenida', $data);
	}
}
