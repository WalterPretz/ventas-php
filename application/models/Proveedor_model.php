<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor_model extends CI_Model {

//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function crearProveedor($nombre, $direccion, $telefono, $tipo,  $correo, $id_usuario){
		$sql = "INSERT INTO proveedor(nombre, direccion, telefono, tipo, correo, estado, id_usuario)
				VALUES (?, ?, ?, ?, ?, ?, ?)";
		$estado = "Activo";

		$valores = array($nombre, $direccion, $telefono, $tipo, $correo,  $estado, $id_usuario);

		$dbres = $this->db->query($sql, $valores);

		return $dbres;
	}

	function seleccionarProveedor() {
		$sql = "SELECT 	id_proveedor, nombre, direccion, telefono, tipo, correo, estado
				FROM 	proveedor 
				WHERE 	estado = 'Activo'
				ORDER BY id_proveedor ASC
				LIMIT 	100";

		$dbres = $this->db->query($sql);

		$rows = $dbres->result_array();

		return $rows;
	}

	function buscarProveedorRegistro($id_proveedor){
        $sql = "SELECT id_proveedor, nombre, direccion, telefono, tipo, correo
				FROM 	proveedor 
                WHERE id_proveedor = ?
                ";

        $dbres = $this->db->query($sql, array($id_proveedor));
        $rows = $dbres->result_array();
        return $rows;
    }

    function anularProveRegistro($id_proveedor){
        is_numeric($id_proveedor) or exit("Número esperado en cliente!");

        $sql = "UPDATE  proveedor
                SET     estado = ?
                WHERE   id_proveedor = ?
                LIMIT   1;";

        $valores = array('Baja', $id_proveedor);
        $dbres = $this->db->query($sql, $valores);
        return $dbres;
    }

    //actualizar proveedro
     function updateProveRegistro($id_proveedor, $nombre, $direccion, $telefono, $tipo, $correo) {
		$sql = "UPDATE proveedor
				SET Nombre = '$nombre', Direccion = '$direccion', Telefono = '$telefono', Tipo = '$tipo',  Correo = '$correo'
				WHERE id_proveedor = '$id_proveedor' "; 

		$dbres = $this->db->query($sql);
		return $dbres;
	}
}