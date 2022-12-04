<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_model extends CI_Model {

//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function crearProducto($codigo, $nombre, $descripcion, $precio_compra, $precio_venta, $existencia, $id_provProducto, $imagen){
		$sql = "INSERT INTO producto(codigo, nombreProducto, descripcion, precio_compra, precio_venta, existencia, id_provProducto, imagen, estado)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$estado = "A";
		$valores = array($codigo, $nombre, $descripcion, $precio_compra, $precio_venta, $existencia, $id_provProducto, $imagen, $estado);
		$dbres = $this->db->query($sql, $valores);
		return $dbres;
	}

	
	function crearControl($id_producto, $fecha_registro, $id_usuario_registro, $fecha_modifica, $id_usuario_modifica){
		$sql = "INSERT INTO control(id_productoControl, fecha_registro, id_usuario_registro, fecha_modifica, id_usuario_modifica)
				VALUES (?, ?, ?, ?, ?)";
		$valores = array($id_producto, $fecha_registro, $id_usuario_registro, $fecha_modifica, $id_usuario_modifica);
		$dbres = $this->db->query($sql, $valores);
		return $dbres;
	}

	function selecIdProductoP($codigo){
		$sql = "SELECT 	id_producto
				FROM 	producto
				WHERE 	codigo = ?
				LIMIT 	1";

		$dbres = $this->db->query($sql, array($codigo));
		$rows = $dbres->result_array();
		return $rows[0]['id_producto'];
	}

	function seleccionarProveedorP() {
		$sql = "SELECT 	id_proveedor, nombre
				FROM 	proveedor
				WHERE	estado = 'Activo'
				LIMIT 	100";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function selCodExistenteProd($codigo) {
		$sql = "SELECT 	codigo
				FROM 	producto
				WHERE 	codigo = ?
				LIMIT 1 ;";

		$dbres = $this->db->query($sql, array($codigo));
		$rows = $dbres->result_array();
		return $rows;
	}
//listgar producto
	function seleccionarProductoRegistrado(){
		$sql = "SELECT p.id_producto id_producto, p.codigo codigo, CONCAT(p.nombreProducto,', ',p.descripcion) as descripcion, p.precio_venta precio, p.existencia existencia, p.imagen as imagen, p.estado estado
				FROM 	producto p
				WHERE	p.estado = 'A'
				ORDER BY p.id_producto DESC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}
	//listar producto detallado
	function descargarDetallado(){
		$sql = "SELECT p.id_producto id_producto, p.codigo codigo, CONCAT(p.nombreProducto,' ,',p.descripcion) as nombreProducto, p.precio_compra precio_compra, p.precio_venta precio_venta, p.existencia existencia, r.nombre proveedor, p.imagen imagen, s.fecha_registro fecha_registro, s.fecha_modifica fecha_modifica,  CONCAT(g.nombre,' ',g.apellido) as nombreU, CONCAT(j.nombre,' ',j.apellido) nombreM, p.estado estado
				FROM 	producto p
				JOIN	proveedor r on p.id_provProducto = r.id_proveedor
				JOIN	control s on p.id_producto = s.id_productoControl
				JOIN	usuario t on s.id_usuario_registro = t.id_usuario
				JOIN 	persona g on g.id_persona = t.persona_id_persona
				JOIN	usuario u on s.id_usuario_modifica = u.id_usuario
				JOIN 	persona j on j.id_persona = u.persona_id_persona
				WHERE	p.estado = 'A'
				ORDER BY p.id_producto DESC
				LIMIT 	1000";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	//buscar producto para colocar en detalle
	function buscarProductoRegistro($id_producto){
		$sql = "SELECT id_producto, codigo, nombreProducto, descripcion, precio_compra, precio_venta as precio, existencia
				FROM 	producto
                WHERE   id_producto = ?
                ";

        $dbres = $this->db->query($sql, array($id_producto));
        $rows = $dbres->result_array();
        return $rows;
	}

	function darBajaProducuto($id_producto){
        is_numeric($id_producto) or exit("Número esperado en cliente!");

        $sql = "UPDATE  producto
                SET     estado = ?
                WHERE   id_producto = ?
                LIMIT   1;";

        $valores = array('B', $id_producto);
        $dbres = $this->db->query($sql, $valores);
        return $dbres;
	}

	//validar codigo al momento de actualizar
	 function seleccionarCodProdu($codigo){
		$sql = "SELECT 	codigo
				FROM 	producto
				WHERE 	codigo = ?
				LIMIT 	1;";

		$dbres = $this->db->query($sql, array($codigo));
		$rows = $dbres->result_array();
		return $rows;
	 }

//actualziar producto
	function actualizarProducto($id_producto, $codigo, $nombreProducto, $descripcion, $precio_compra, $precio_venta, $existencia){
		$sql = "UPDATE producto
				SET Codigo = '$codigo', NombreProducto = '$nombreProducto', Descripcion = '$descripcion', Precio_compra = '$precio_compra', Precio_venta = '$precio_venta', Existencia = '$existencia'
				WHERE id_producto = '$id_producto' "; 

		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function actualizarControl($id_producto, $fecha_modifica, $id_usuario_modifica){
		$sql = "UPDATE control
				SET Fecha_modifica = '$fecha_modifica', Id_usuario_modifica = '$id_usuario_modifica'
				WHERE id_productoControl = '$id_producto'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}
}