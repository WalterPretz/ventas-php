<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venta_model extends CI_Model {

//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	
	//buscar el numero de ventas
	function buscarNumeroVsum(){
		$sql = "SELECT MAX(id_comprobante)+1 as id
				FROM 	comprobante
				";
		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

    function Selec_ProductoSuministro(){
		$sql = "SELECT a.id_producto, a.codigo, CONCAT(a.nombreProducto,', ',a.descripcion) as nombreP, a.precio_venta as precio, a.existencia, a.imagen
				FROM 	producto a 
				WHERE 	a.estado = 'A' and a.existencia > '0'
		    	ORDER BY a.precio_venta DESC
				LIMIT 	1000";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	//buscar producto para colocar en detalle
	function buscarProductoRegis($id_producto){
		$sql = "SELECT id_producto, codigo, nombreProducto as nombreP, descripcion, precio_venta as precio, existencia
				FROM 	producto
                WHERE   id_producto = ?
                ";

        $dbres = $this->db->query($sql, array($id_producto));
        $rows = $dbres->result_array();
        return $rows;
	}

	//agreagar al detalles llamando al procedimiento almacenado
	 ////SECCION_PRODUCTO/////////////////////productodetalle
    function AgregarServicioD($codigo, $cantidad, $descuento, $token_user){
        $sql = "CALL add_detalle_temp($codigo, $cantidad, $descuento, '$token_user')";
        $dbres = $this->db->query($sql, $codigo, $cantidad, $descuento, $token_user);
        $rows = $dbres->result_array();
        return $rows;
    }

    //traer datos del id del usuario que esta creando la venta
     //trae los datos de la table detalle temp
    function traerServicioC($id_user){
        $sql = "SELECT a.correlativo,a.token_user,a.cantidad,a.precio_venta,a.descuento,p.codigo,p.nombreProducto,p.descripcion
                FROM detalle_temp a
                JOIN producto p on a.codproducto = p.id_producto
                WHERE token_user = $id_user
               ";
               
        $dbres = $this->db->query($sql);
        $rows = $dbres->result_array();
        return $rows;
    }

    //eliminar detalle
     function ElimiarServicioD($id_detalle, $token){
        $sql = "CALL del_detalle_temp($id_detalle, '$token')";
        $dbres = $this->db->query($sql, $id_detalle, $token);
        $rows = $dbres->result_array();
        return $rows;
    }

    //eliminar dettalle temporal
     function elimiarDetalleVentaProceso($token){
        $sql = "DELETE FROM detalle_temp
                WHERE token_user = '$token'
                ";    
        $rows = $this->db->query($sql);
        return $rows;
    }

     //Agregar venta  al cliente para no eliminar
	function crearVentaSCliente($id_cliente){
		is_numeric($id_cliente) or exit("Número esperado en cliente!");

		$sql = "UPDATE 	cliente
				SET 	vsum = ?
				WHERE 	id_cliente = ?
				LIMIT 	1;";

		$valores = array('VS', $id_cliente);
		$dbres = $this->db->query($sql, $valores);
		return $dbres;
	}

	// traer datos de los prouctos agregados a detalle
    function traerComprobanteV($token_user){
        $sql = "SELECT *
                FROM detalle_temp
                WHERE token_user = '$token_user'
                ";
               
        $dbres = $this->db->query($sql);
        $rows = $dbres->result_array();
        return $rows;
    }

    //procesar el comprobante de los materiales entregados al técnico
    function procesarComprobanteV($id_usuario, $id_cliente, $token, $tipo){
        $sql = "CALL procesar_entrega($id_usuario, $id_cliente, '$token', '$tipo')";
        $dbres = $this->db->query($sql, $id_usuario, $id_cliente, $token, $tipo);
        $rows = $dbres->result_array();
        return $rows;
    }

     //anula el comprobante seleccionado
    function anularComprobSel($noComprob){
        $sql = "CALL anular_comprobante($noComprob)";
        $dbres = $this->db->query($sql, $noComprob);
        $rows = $dbres->result_array();
        return $rows;
    }

    //LISTAR todas la ventas realizadas
    function seleccionarVentaListar(){
        $sql = "SELECT a.id_comprobante as id_comprobante, DATE_FORMAT(a.fecha, '%d/%m/%Y %h:%m:%s %p') as fecha, CONCAT(p.nombre,' ',p.apellido) as usuario, a.id_cliente as id_cliente, c.nombre as nombreCliente, a.totalComprobante as total, a.estado as estado
                FROM comprobante a
                JOIN usuario b on a.id_usuario = b.id_usuario 
                JOIN persona p on p.id_persona = b.persona_id_persona
                JOIN cliente c on a.id_cliente = c.id_cliente
                where a.tipo = 'V' and a.estado = '1'
               
                ORDER BY a.id_comprobante DESC
               ";
               
        $dbres = $this->db->query($sql);
        $rows = $dbres->result_array();
        return $rows;
    }

   //buscar datos de la cotizacion para dar baja despues
    function buscarCotizacionRegistro($id_comprobante){
        $sql = "SELECT a.id_comprobante as id_comprobante, DATE_FORMAT(a.fecha, '%d/%m/%Y %h:%m:%s %p') as fecha, a.id_cliente as id_cliente, c.nombre as nombreCliente, a.totalComprobante as total, a.estado as estado
                FROM comprobante a
                JOIN cliente c on a.id_cliente = c.id_cliente
                WHERE a.id_comprobante = ?
                ";

        $dbres = $this->db->query($sql, array($id_comprobante));
        $rows = $dbres->result_array();
        return $rows;
    }

    //dar baja en la cotizacion del cliente 
    function darBajaClienteCotizacion($id_cliente){
        is_numeric($id_cliente) or exit("Número esperado!");

        $sql = "UPDATE  cliente
                SET     venta = ?
                WHERE   id_cliente = ?
                LIMIT   1;";

        $valores = array('', $id_cliente);
        $dbres = $this->db->query($sql, $valores);
        return $dbres;
    }

    //cambiar estado de la cotizacion
    function anularComproCotiza($id_comprobante){
        is_numeric($id_comprobante) or exit("Número esperado en cliente!");

        $sql = "CALL anular_comprobante($id_comprobante)";
        $dbres = $this->db->query($sql, $id_comprobante);
        $rows = $dbres->result_array();
        return $rows;
    }

     //generar pdf
    function pdfComprobante($id){
        $sql = "SELECT a.id_comprobante, DATE_FORMAT(a.fecha, '%d/%m/%Y') as fecha, DATE_FORMAT(a.fecha,'%H:%i:%s') as  hora, w.nombre as nombreU,a.id_cliente, c.direccion, c.nombre as nombreT, c.nit as nit, t.numero1 as telefono, p.codigo, p.nombreProducto nombreP, p.descripcion, d.cantidad, d.precio_venta, d.descuento, a.estado
                FROM comprobante a
                JOIN usuario b on a.id_usuario = b.id_usuario 
                JOIN persona w on w.id_persona = b.persona_id_persona
                JOIN cliente c on a.id_cliente = c.id_cliente
                JOIN telefonoc t on c.id_cliente = t.id_cliente_tel
                JOIN detallecomprobante d on a.id_comprobante = d.com_id_comprobante
                JOIN producto p on d.prod_id_producto = p.id_producto
                WHERE a.id_comprobante = $id and a.estado != 10
               ";
               
        $dbres = $this->db->query($sql, $id);
        $rows = $dbres->result_array();
        return $rows;
    }



}