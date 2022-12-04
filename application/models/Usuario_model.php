<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {

//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function autenticarUsuario($txtusuario, $txtClave) {
		$sql = "SELECT 	id_usuario, usuario, hash_clave, salt, rol
				FROM 	usuario
				WHERE 	usuario = ? AND estado = 'A'
				LIMIT 	1;";

		$dbres = $this->db->query($sql, array($txtusuario));
		$rows = $dbres->result_array();

		if (count($rows) < 1) // El usuario no existe o no está activo
			return 0;

		$id = $rows[0]['id_usuario'];
		$salt = $rows[0]['salt'];
		$hashClave = hash('sha256', $txtClave.$salt); // Calcular sha512 de clave + salt

		$sql = "SELECT 	a.id_usuario as id_usuario, a.usuario as usuario, CONCAT(b.nombre,' ',b.apellido) as nombre, a.hash_clave as hash_clave, a.salt as salt, a.rol as rol
		FROM 	usuario a
		JOIN 	persona b on a.persona_id_persona = b.id_persona
		WHERE 	a.id_usuario = ? AND a.hash_clave = ?
		LIMIT 	1;";

		$dbres = $this->db->query($sql, array($id, $hashClave));
		$rows = $dbres->result_array();

		if (count($rows) > 0) {
			return $rows; // El usuario existe y cumple con la clave
		}

		return 0; // El usuario existe pero no cumple la clave
	}

	function crearPersona($nombre, $apellido, $fecha_nacimiento, $direccion) {
		$sql = "INSERT INTO persona(nombre, apellido, fecha_nacimiento, direccion)
				VALUES (?, ?, ?, ?)";

		$valores = array($nombre, $apellido, $fecha_nacimiento, $direccion);
		$dbres = $this->db->query($sql, $valores);
		return $dbres;
	}

	function crearPersonaTelefono($numero1, $numero2, $id_persona) {
		$sql = "INSERT INTO telefono(numero1, numero2, persona_id_persona)
				VALUES (?, ?, ?)";

		$valores = array($numero1, $numero2, $id_persona);
		$dbres = $this->db->query($sql, $valores);
		return $dbres;
	}
//busca el ultimo dato ingresado para tomar su id
	function seleccionar_id_persona() {
		$sql = "SELECT MAX(id_persona) as id_persona 
				FROM persona
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['id_persona'];
	}
//buscar usuario con cui para validad si  ya se encuetra registrado
	function seleccionarCuiUsuario($cui) {
		$sql = "SELECT 	cui
						FROM 	usuario
						WHERE 	cui = ?
						LIMIT 1 ;";

		$dbres = $this->db->query($sql, array($cui));

		$rows = $dbres->result_array();
		return $rows;
	}

	function crearUsuarioSistema($cui, $cargo, $usuario, $clave, $rol, $email, $id_persona) {
		$sql = "INSERT INTO usuario(cui, cargo, usuario, hash_clave, salt, estado, rol, email, persona_id_persona)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$salt = rand(0,999999); //calcular un número aleatorio
		$hash_clave = hash('sha256', $clave.$salt); //calcular el hash de clave + salt
		$estado = "A";

		$valores = array($cui, $cargo, $usuario, $hash_clave, $salt, $estado, $rol, $email, $id_persona);
		$dbres = $this->db->query($sql, $valores);
		return $dbres;
	}

	function validarUsuario($usuario, $cui) {
	$sql = "SELECT usuario, cui
			FROM 	usuario
			WHERE 	usuario = ? or cui = ?
			LIMIT 	1;";

	$dbres = $this->db->query($sql, array($Usuario, $cui));
	$rows = $dbres->result_array();
	return $rows;
	}

	function mostrar_insercion($cui){
		$sql = "SELECT u.id_usuario as id_usuario, u.cui as cui, u.cargo as cargo, u.usuario as usuario, u.rol as rol,  CONCAT(p.nombre,' ',p.apellido) as nombre,  DATE_FORMAT(p.fecha_nacimiento, '%d/%m/%Y') as nacimiento, p.direccion as direccion, t.numero1 as numero1, t.numero2 as numero2, u.email as email
						FROM usuario u
						JOIN persona p on u.persona_id_persona = p.id_persona
						JOIN telefono t on t.persona_id_persona = p.id_persona
						WHERE cui = ?
						LIMIT 	1";

			$dbres = $this->db->query($sql, array($cui));
			$rows = $dbres->result_array();
			return $rows;
	}

	function listarUsuarios(){
		$sql = "SELECT 	a.id_usuario as id_usuario, CONCAT(b.nombre,' ',b.apellido) as nombre, a.cui as cui, t.numero1 as numero, a.usuario as usuario, a.rol as rol
				FROM 	usuario a
				JOIN 	persona b on a.persona_id_persona = b.id_persona
				JOIN 	telefono t on t.persona_id_persona = b.id_persona
				WHERE 	estado = 'A'
				ORDER BY a.id_usuario DESC
				LIMIT 	100";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	//buscar al usuario antes de darle baja
	function buscarUsuarioRegis($id_usuario){
		$sql = "SELECT a.id_usuario as id_usuario, CONCAT(b.nombre,' ',b.apellido) as nombre, a.cui as cui, t.numero1 as numero, a.usuario as usuario, a.rol as rol
				FROM 	usuario a
				JOIN 	persona b on a.persona_id_persona = b.id_persona
				JOIN 	telefono t on t.persona_id_persona = b.id_persona
                WHERE   id_usuario = ?
                ";

        $dbres = $this->db->query($sql, array($id_usuario));
        $rows = $dbres->result_array();
        return $rows;
	}

	function darBajaUusario($id_usuario){
		is_numeric($id_usuario) or exit("Número esperado!");

		$sql = "UPDATE 	usuario
				SET 	estado = ?
				WHERE 	id_usuario = ?
				LIMIT 	1;";

		$valores = array('B', $id_usuario);
		$dbres = $this->db->query($sql, $valores);
		return $dbres;
	}

	//obtrener datos para actualizar al usuario seleccionador

	function buscarRegisUsuarioActualizar($id_usuario){
		$sql = "SELECT u.id_usuario as id_usuario, p.id_persona as id_persona, u.cui as cui, u.cargo as cargo, u.usuario as usuario, u.rol as rol,  p.nombre as nombre, p.apellido as apellido,  p.fecha_nacimiento as nacimiento, p.direccion as direccion, t.numero1 as numero1, t.numero2 as numero2, u.email as email
						FROM usuario u
						JOIN persona p on u.persona_id_persona = p.id_persona
						JOIN telefono t on t.persona_id_persona = p.id_persona
                WHERE   u.id_usuario = ?
                ";

        $dbres = $this->db->query($sql, array($id_usuario));
        $rows = $dbres->result_array();
        return $rows;
	}
//actualizar datos del usuario seleccionado
	function actualizarUsuarioSistema($cui, $cargo, $usuario, $clave, $rol, $email, $id_usuario) {
			$sql = "UPDATE usuario
					SET cui = '$cui', cargo = '$cargo', usuario= '$usuario', rol = '$rol', email = '$email'
					WHERE id_usuario = '$id_usuario' ";

			$dbres = $this->db->query($sql);
			return $dbres;
	}

	function actualizarPersonaTelefono($numero1, $numero2, $id_persona) {
		$sql = "UPDATE telefono
		SET numero1 = '$numero1', numero2 = '$numero2'
		WHERE persona_id_persona = '$id_persona' ";

		$dbres = $this->db->query($sql);
		return $dbres;

	}

	function actualizarPersona($nombre, $apellido, $fecha_nacimiento, $direccion, $id_persona) {
		$sql = "UPDATE persona
		SET nombre = '$nombre', apellido = '$apellido', fecha_nacimiento = '$fecha_nacimiento', direccion = '$direccion'
		WHERE id_persona = '$id_persona' ";

		$dbres = $this->db->query($sql);
		return $dbres;
	}


}