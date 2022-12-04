<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente_model extends CI_Model {

//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}


	//cliente
	function buscarNumeroCliente(){
        $sql = "SELECT MAX(id_cliente)+1 as id_cli
                FROM cliente
                ";
        $dbres = $this->db->query($sql);
        $rows = $dbres->result_array();
        return $rows;
    }  

//crear cliente
	 function crearClienteNuevo($codigo, $nombre, $cui, $direccion, $id_usuario, $nit){
        $sql = "INSERT INTO cliente(codigo, nombre, cui, direccion, estado, id_usuario, nit)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $estado = "A";
        $valores = array($codigo, $nombre, $cui, $direccion, $estado, $id_usuario, $nit);
        $dbres = $this->db->query($sql, $valores);
        return $dbres;
    }

    //Para validar cliente creado
    function seleccionarIdCliente($codigo){
        $sql = "SELECT  id_cliente
                FROM    cliente
                WHERE   codigo = ?
                ";

        $dbres = $this->db->query($sql, array($codigo));
        $rows = $dbres->result_array();
        return $rows[0]['id_cliente'];
    }

    //editar datos del cliente seleccionado
    function seleccionarCliente1($codigo) {
        $sql = "SELECT  codigo
                FROM    cliente
                WHERE   codigo = ?
                LIMIT 1 ;";

        $dbres = $this->db->query($sql, array($codigo));
        $rows = $dbres->result_array();

        if (count($rows) == 0){
            return 0;
        }else{
            return 1;
        }
    }

    function telefono($id_cliente, $numero1, $numero2){
        $sql = "INSERT INTO telefonoc(id_cliente_tel, numero1, numero2)
                    VALUES (?, ?, ?)";
        $valores = array($id_cliente, $numero1, $numero2);
        $dbres = $this->db->query($sql, $valores);
        return $dbres;
    }

    //buscar cliente para asignarle la venta
    function buscarClienteRegistrado($cui){
        $sql = "SELECT f.id_cliente, f.codigo, f.nombre, e.numero1, e.numero2, f.direccion, f.nit
                FROM    cliente f
                JOIN    telefonoc e on e.id_cliente_tel = f.id_cliente 
                WHERE cui LIKE '$cui'
        ";

        $dbres = $this->db->query($sql,$cui);
        $rows = $dbres->result_array();
        return $rows;
    }

    //buscar cliente por nit
    function buscarClienteNitRegistrado($nit){
        $sql = "SELECT f.id_cliente, f.codigo, f.nombre, f.cui, e.numero1, e.numero2, f.direccion
                FROM    cliente f
                JOIN    telefonoc e on e.id_cliente_tel = f.id_cliente 
                WHERE f.nit LIKE '$nit'
        ";

        $dbres = $this->db->query($sql, $nit);
        $rows = $dbres->result_array();
        return $rows;
    }
    //listar clientes
    function seleccionarCliente(){
		$sql = "SELECT 	f.id_cliente id_cliente, f.codigo codigo, f.nombre nombre, f.direccion direccion, f.estado estado, e.numero1 numero1, e.numero2 numero2
				FROM 	cliente f
				JOIN	telefonoc e on e.id_cliente_tel = f.id_cliente 
				WHERE 	estado = 'A'
				ORDER BY id_cliente DESC
				LIMIT 	50";
		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

    ///////////////////// para ver a detalle los datos del cliente seleccionado
    function seleccionarClientes($id){
        $sql = "SELECT  w.id_cliente, w.codigo, w.nombre, w.cui, w.direccion, w.estado, x.id_usuario id_usuario, CONCAT(p.nombre,' ',p.apellido) as nombre1, y.id_cliente_tel id_cliente_tel, y.numero1 numero1, y.numero2 numero2, w.nit as nit, w.venta as venta
                FROM    cliente w
                JOIN    usuario x on w.id_usuario = x.id_usuario
                JOIN    persona p on p.id_persona = x.id_usuario
                JOIN    telefonoc y on y.id_cliente_tel = w.id_cliente
                where   id_cliente = ?
                LIMIT   1";
        $dbres = $this->db->query($sql, $id);
        $rows = $dbres->result_array();
        return $rows;
    }

    //actualizar datos del cliente
    function actualizarCliente($id, $codigo, $nombre, $cui, $direccion, $nit) {
        $sql = "UPDATE  cliente
                SET     Codigo = '$codigo', Nombre = '$nombre', Cui = '$cui', Direccion = '$direccion', Nit = '$nit'
                WHERE   id_cliente = '$id' "; 

        $dbres = $this->db->query($sql);
        return $dbres;
    }

    function actualizarTelefono($id, $numero1, $numero2) {
        $sql = "UPDATE  telefonoc
                SET     numero1 = '$numero1', numero2 = '$numero2'
                WHERE   id_cliente_tel = '$id'";
        $dbres = $this->db->query($sql, $valores);
        return $dbres;
    }

    //darbajacliente
    function buscarClienteRegis($id_cliente){
        $sql = "SELECT id_cliente as codigo, nombre as cliente, cui, direccion, venta
                FROM    cliente
                WHERE   id_cliente = ?
                ";

        $dbres = $this->db->query($sql, array($id_cliente));
        $rows = $dbres->result_array();
        return $rows;
    }

    function darBajaCliente($id_cliente){
        is_numeric($id_cliente) or exit("Número esperado!");

        $sql = "UPDATE  cliente
                SET     estado = ?
                WHERE   id_cliente = ?
                LIMIT   1;";

        $valores = array('B', $id_cliente);
        $dbres = $this->db->query($sql, $valores);
        return $dbres;
    }

    //asignar venta al cliente para no poder elimianr
    function asignarVenta($id_cliente){
        is_numeric($id_cliente) or exit("Número esperado en cliente!");

        $sql = "UPDATE  cliente
                SET     venta = ?
                WHERE   id_cliente = ?
                LIMIT   1;";

        $valores = array('V', $id_cliente);
        $dbres = $this->db->query($sql, $valores);
        return $dbres;
    }
}