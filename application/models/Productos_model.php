<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos_model extends CI_Model {

//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function seleccionarProductoRegistrado(){
		$sql = "SELECT p.id_producto id_producto, p.codigo codigo, CONCAT(p.nombreProducto,', ',p.descripcion) as descripcion, p.precio_venta precio, p.existencia existencia, p.imagen as imagen, p.estado estado
				FROM 	producto p
				WHERE	p.estado = 'A'
				ORDER BY p.id_producto DESC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	public function seleccionarUnicoProducto(){
		$sql = "SELECT p.id_producto id_producto, p.codigo codigo, CONCAT(p.nombreProducto,', ',p.descripcion) as descripcion, p.precio_venta precio, p.existencia existencia, p.imagen as imagen, p.estado estado
				FROM 	producto p
				WHERE	p.estado = 'A' and p.id_producto = '28'
				ORDER BY p.id_producto DESC
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}


}