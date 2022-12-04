<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class venta extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Venta_model');
		$this->load->model('Cliente_model');
	}

	private function restringirAcceso() {
		if (!isset($this->session->USUARIO)) {
			redirect("usuario/login");
		}
	}

	public function index(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

	}

	public function crear()	{
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['codVentaSum'] = $this->Venta_model->buscarNumeroVsum();
		$data['codCliente'] = $this->Cliente_model->buscarNumeroCliente();
		$data['sumin'] = $this->Venta_model->Selec_ProductoSuministro();
		$this->load->view('venta_crear', $data);
	}

	//buscar  producto para colocar en detalles
	function buscarProductoRe(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if(!empty($_POST['id_producto'])){
        $data['id_producto'] = $_POST['id_producto'];
        $arr = $this->Venta_model->buscarProductoRegis($data['id_producto']);

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

	//agregar producto a detalle
	function agregarAlDetalleProd(){
		$this->restringirAcceso();
    
     if($_POST['action'] == 'addProductoDetalle'){
     	 //print_r($_POST);
        $data['codigo'] = $_POST['producto'];
        $data['cantidad'] = $_POST['cantidad'];
        $data['descuento'] = $_POST['descuento'];
        $data['token_user'] = ($this->session->IDUSUARIO);

        $arr = $this->Venta_model->AgregarServicioD($data['codigo'], $data['cantidad'], $data['descuento'], $data['token_user']);
        $result = $arr;

        $detalleTabla = '';
        $sub_total    = 0;
        $iva          = 0;
        $total        = 0;
        $arrayData    = array();

        if ($result > 0) {
          foreach ($arr as $b) {
          $precioTotal = round(($b['cantidad'] * $b['precio_venta'])-$b['descuento'], 2);
          $sub_total = round($sub_total + $precioTotal, 2);
          $total = round($total + $precioTotal, 2);
          
          $detalleTabla .=  "<tr>
              <td>".$b['codigo']."</td>
              <td class='textcenter'>".$b['cantidad']."</td>
              <td>".$b['nombreProducto'].", ".$b['descripcion']."</td>
              <td class='textright'>".$b['precio_venta']."</td>
              <td class='textright'>".$b['descuento']."</td>
              
              <td class='textright'>".$precioTotal."</td>
              <td>
              <center><a class='link_delete btn btn-danger btn-sm' href='#' onclick='event.preventDefault(); del_product_detalle(".$b['correlativo'].")'><i class='fa fa-trash' style='font-weight: bold;'></i></a></center>
              </td>
          </tr>";
          }
        }

        $impuesto = round($sub_total * ($iva / 100), 2);
        $tl_sniva = round($sub_total - $impuesto, 2);
        $total    = round($tl_sniva + $impuesto, 2);
       
        $detalleTotales = '
        <tr>
          <td colspan="6" class="textright">SUBTOTAL Q.</td> 
          <td class="textright">'.$tl_sniva.'</td>   
        </tr>
        <tr>
          <td colspan="6" class="textright">TOTAL Q.</td> 
          <td class="textright">'.$total.'</td>   
        </tr>
        ';

        $arrayData['detalle'] = $detalleTabla;
        $arrayData['totales'] = $detalleTotales;
        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);

    	}
	}

	public function eliminarDetalle(){
		$this->restringirAcceso();
	    if($_POST['action'] == 'del_product_detalle'){
	      if(empty($_POST['id_detalle'])){
	        echo "error";
	      }else{
	        $data['id_detalle'] = $_POST['id_detalle'];
	        $data['token'] = ($this->session->IDUSUARIO);

	        $arr = $this->Venta_model->ElimiarServicioD($data['id_detalle'], $data['token']);
	        $result = $arr;

	        $detalleTabla = '';
	        $sub_total    = 0;
	        $iva          = 0;
	        $total        = 0;
	        $arrayData    = array();

	        if ($result > 0) {
	          foreach ($arr as $b) {
	          $precioTotal = round(($b['cantidad'] * $b['precio_venta'])-$b['descuento'], 2);
	          $sub_total = round($sub_total + $precioTotal, 2);
	          $total = round($total + $precioTotal, 2);
	          
	          $detalleTabla .=  "<tr>
	              <td>".$b['codigo']."</td>
	              <td class='textcenter'>".$b['cantidad']."</td>
	              <td>".$b['nombreProducto'].", ".$b['descripcion']."</td>
	              <td class='textright'>".$b['precio_venta']."</td>
	              <td class='textright'>".$b['descuento']."</td>

	              <td class='textright'>".$precioTotal."</td>
	              <td>
	              <center><a class='link_delete btn btn-danger btn-sm' href='#' onclick='event.preventDefault(); del_product_detalle(".$b['correlativo'].")'><i class='fa fa-trash' style='font-weight: bold;'></i></a></center>
	              </td>
	          </tr>";
	          }
	        }

	        $impuesto = round($sub_total * ($iva / 100), 2);
	        $tl_sniva = round($sub_total - $impuesto, 2);
	        $total    = round($tl_sniva + $impuesto, 2);
	       
	        $detalleTotales = '
	        <tr>
	          <td colspan="6" class="textright">SUBTOTAL Q.</td> 
	          <td class="textright">'.$tl_sniva.'</td>   
	        </tr>
	        <tr>
	          <td colspan="6" class="textright">TOTAL Q.</td> 
	          <td class="textright">'.$total.'</td>   
	        </tr>
	        ';

	        $arrayData['detalle'] = $detalleTabla;
	        $arrayData['totales'] = $detalleTotales;
	        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
	      }
	    }
	}

	function guardarVentaRealizada(){
		$this->restringirAcceso();
    
	    if(($_POST['action'] == 'procesarComprobante') & (empty($_POST['idClient'])) ){
			echo "error";
			}else {

	      $data['id_cliente'] = $_POST['idClient'];
		    $data['token'] = ($this->session->IDUSUARIO);
		    $data['id_usuario'] = ($this->session->IDUSUARIO);
		    $data['tipo'] = 'V';

		    $this->Cliente_model->asignarVenta($data['id_cliente']); 
		    $resultado = $this->Venta_model->traerComprobanteV($this->session->IDUSUARIO);
	      
	      	if($resultado > 0){
	        	$procesarVenta = $this->Venta_model->procesarComprobanteV($data['id_usuario'], $data['id_cliente'], $data['token'], $data['tipo']);

	        	$respuesta = $procesarVenta;
	        	if($respuesta > 0){
	          		$data = $procesarVenta;
	          		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	        	}else{
	          	echo "error";
	        	}
	      	}else{
	        echo "error";
	      }
	    }
	}

	function mostrarDatos(){
	$this->restringirAcceso();
	  if($_POST['action'] == 'searchForDetalle'){
	      if(empty($_POST['user'])){
	        echo "error";
	      }else{
	        $data['token_user'] = ($this->session->IDUSUARIO);

	        $arr = $this->Venta_model->traerServicioC($this->session->IDUSUARIO);
	        $result = $arr;

	        $detalleTabla = '';
	        $sub_total    = 0;
	        $iva          = 0;
	        $total        = 0;
	        $arrayData    = array();

	        if ($result > 0) {
	          foreach ($arr as $b) {
	          $precioTotal = round(($b['cantidad'] * $b['precio_venta'])-$b['descuento'], 2);
	          $sub_total = round($sub_total + $precioTotal, 2);
	          $total = round($total + $precioTotal, 2);
	          
	          $detalleTabla .=  "<tr>
	              <td>".$b['codigo']."</td>
	              <td class='textcenter'>".$b['cantidad']."</td>
	              <td>".$b['nombreProducto'].", ".$b['descripcion']."</td>
	              <td class='textright'>".$b['precio_venta']."</td>
	              <td class='textright'>".$b['descuento']."</td>
	         
	              <td class='textright'>".$precioTotal."</td>
	              <td>
	              <center><a class='link_delete btn btn-danger btn-sm' href='#' onclick='event.preventDefault(); del_product_detalle(".$b['correlativo'].")'><i class='fa fa-trash' style='font-weight: bold;'></i></a></center>
	              </td>
	          </tr>";
	          }
	        }

	        $impuesto = round($sub_total * ($iva / 100), 2);
	        $tl_sniva = round($sub_total - $impuesto, 2);
	        $total    = round($tl_sniva + $impuesto, 2);
	       
	        $detalleTotales = '
	        <tr>
	          <td colspan="6" class="textright">SUBTOTAL Q.</td> 
	          <td class="textright">'.$tl_sniva.'</td>   
	        </tr>
	        <tr>
	          <td colspan="6" class="textright">TOTAL Q.</td> 
	          <td class="textright">'.$total.'</td>   
	        </tr>
	        ';

	        $arrayData['detalle'] = $detalleTabla;
	        $arrayData['totales'] = $detalleTotales;
	        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
	      }
	    }
	}

	//cancelar venta en proceso
	public function eliminarDetalleV(){
		$this->restringirAcceso();
    if($_POST['action'] == 'anularVenta'){

      $data['token'] = ($this->session->IDUSUARIO);

      $eliminar = $this->Venta_model->elimiarDetalleVentaProceso($data['token']);
     
      if($eliminar){
        echo "Ok";
      }else{
        echo "error";
      }
    }
	}

//anular comprobante seleccionado
	  function elimiarDetalleCompro(){
	    $this->restringirAcceso();
	    $data['noComprob'] = $_POST['noComprob'];
	    $arr = $this->Venta_model->anularComprobSel($data['noComprob']);
	    
	    $resultado = $arr;
	    if($resultado > 0){
	      $data = $arr;
	      echo json_encode($data, JSON_UNESCAPED_UNICODE);
	    }

	}
	//////////////////SECCION CLIENTE
	function buscarCliente(){
		$this->restringirAcceso();
	   	if($_POST['action'] == 'buscarCliente'){

      if(!empty($_POST['cliente'])){
        $data['cui'] = $_POST['cliente'];
        $arr = $this->Cliente_model->buscarClienteRegistrado($data['cui']);

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
	}

	//buscar cliente por nit
	public function buscarClienteNit()	{
		$this->restringirAcceso();
	   	if($_POST['action'] == 'buscarClienteNit'){

      if(!empty($_POST['cliente'])){
        $data['nit'] = $_POST['cliente'];
        $arr = $this->Cliente_model->buscarClienteNitRegistrado($data['nit']);

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
	}
	function crearCliente(){
		$this->restringirAcceso(); 
	    if($_POST['action'] == 'agregarCliente'){

	      $data['codigo'] = $_POST['cod_cliente'];
	      $data['cui'] = $_POST['cui_cliente'];
	      $data['nombre'] = $_POST['nom_cliente'];
	      $data['numero1'] = $_POST['tel_cliente'];
	      $data['numero2'] = $_POST['tel1_cliente'];
	      $data['direccion'] = $_POST['dir_cliente'];
	      $data['nit'] = $_POST['nit_cliente'];
	      $data['id_usuario'] = ($this->session->IDUSUARIO);

	      $arr = $this->Cliente_model->crearClienteNuevo($data['codigo'], $data['nombre'], $data['cui'], $data['direccion'], $data['id_usuario'], $data['nit']);
	      $id_cliente = $this->Cliente_model->seleccionarIdCliente($data['codigo']);
	      $this->Cliente_model->telefono($id_cliente, $data['numero1'], $data['numero2']);

	      $result = $id_cliente;
	            $data = '';
	            if($result > 0){
	              $data = $id_cliente;
	            }else{
	              $data = 0;
	            }

	        echo json_encode($data, JSON_UNESCAPED_UNICODE);
	      }
		}

		function listar(){
			$this->restringirAcceso();
			$data['base_url'] = $this->config->item('base_url');
			$data['arr'] = $this->Venta_model->seleccionarVentaListar();
			$this->load->view('venta_listar', $data);
		}

		public function buscarRegistroVenta()	{
			$this->restringirAcceso();
	    $data['base_url'] = $this->config->item('base_url');

	    if(!empty($_POST['id_comprobante'])){
	        $data['id_comprobante'] = $_POST['id_comprobante'];
	        $arr = $this->Venta_model->buscarCotizacionRegistro($data['id_comprobante']);

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

		function darBajaVenta(){
				$this->restringirAcceso();
	    	$data['base_url'] = $this->config->item('base_url');

	    	if($_POST['action'] == 'eliminarRegi'){
		      if(!empty($_POST['id_vsum'])){
		          $data['id_comprobante'] = $_POST['id_vsum'];
		          $data['id_cliente'] = $_POST['id_cli'];
		          $arr = $this->Venta_model->darBajaClienteCotizacion($data['id_cliente']);
		          $arr = $this->Venta_model->anularComproCotiza($data['id_comprobante']);
		      
		          $resultado = $arr;
		          if($resultado > 0){
		            $data = $arr;
		            echo json_encode($data, JSON_UNESCAPED_UNICODE);
		          }
		        }
      	}
		}
		//vizualizar la venta realizada
		public function mostrar($id = 0)	{
			$this->restringirAcceso();
			$data['base_url'] = $this->config->item('base_url');
			$data['compro'] = $this->Venta_model->pdfComprobante($id);

			$this->load->view('venta_mostrar', $data);
		}
}
