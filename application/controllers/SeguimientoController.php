<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SeguimientoController extends CI_Controller
{

	function __construct()
	{

		parent::__construct();

		$this->load->model('Seguimiento');
		$this->load->library('session');
	}

	public function index()
	{

		$fecha_actual = date("Y-m-d", strtotime(date("Y-m-d") . "+1 days"));
			$hasta=$fecha_actual;
		if ($_GET['fecha'] == 7) {
			$dias = date("Y-m-d", strtotime($fecha_actual . "- 7 days"));
		} else if ($_GET['fecha'] == 15) {
			$dias = date("Y-m-d", strtotime($fecha_actual . "- 15 days"));
		} else if ($_GET['fecha'] == 30) {
			$dias = date("Y-m-d", strtotime($fecha_actual . "- 30 days"));
		} else if ($_GET['fecha'] == "rango") {
		
			$dias = $_GET['desde'];
			$hasta = $_GET['hasta'];
		}

		$origen=1;
		if(!empty($_GET['origen'])){
			$origen=$_GET['origen'];
		}


		$productos = $this->Seguimiento->getProductos($dias, $_GET['parroquia'], $_GET['eje'],$origen,$_GET['fuente']);
		$lista = array();
		foreach ($productos as $key => $value) {
		
			$ProductoPromedio = $this->Seguimiento->getProductosPromedio($dias, $_GET['parroquia'], $_GET['eje'],$value->id,$origen,$_GET['fuente']);
		
			$promedio = $ProductoPromedio[0]->promedio . " Bs";
			if ($_GET['moneda'] == "usd") {
				$promedio = "$ " . number_format($ProductoPromedio[0]->promedio / $ProductoPromedio[0]->tasa, 2, ",", ".");
			}
			
			$data = $this->Seguimiento->listar($value->id, $dias, $_GET['parroquia'], $_GET['eje'], $_GET['moneda'], $_GET['fecha'],$origen);
		$lista[] = array(
				"producto" => $value->producto,
				"promedio" =>  number_format( $promedio  , 2, ",", ".") ,
				"precio" => number_format( $ProductoPromedio[0]->promedio  , 2, ",", "."),
				"id" => $value->id,
				"usd" => number_format($ProductoPromedio[0]->promedio  / $ProductoPromedio[0]->tasa, 2, ",", "."), 
				"datos" => $data
			);


			# code...
		}
		//$data =$this->Seguimiento->listar();


		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($lista));
	}


	public function logout()
	{
		session_destroy();
	
			header('Location: login');
		
        
	}

	public function getProductos(){
		$desde = $_GET['desde'];
		$hasta = $_GET['hasta'];
		$fecha_actual = date("Y-m-d", strtotime(date("Y-m-d") . "+1 days"));
		$hasta=$fecha_actual;
		if ($_GET['fecha'] == 7) {
			$dias = date("Y-m-d", strtotime($fecha_actual . "- 7 days"));
		} else if ($_GET['fecha'] == 15) {
			$dias = date("Y-m-d", strtotime($fecha_actual . "- 15 days"));
		} else if ($_GET['fecha'] == 30) {
			$dias = date("Y-m-d", strtotime($fecha_actual . "- 30 days"));
		} else if ($_GET['fecha'] == "rango") {
		
			$dias  = $_GET['fecha'];
		
		}


		$origen=1;
		if(!empty($_GET['origen'])){
			$origen=$_GET['origen'];
		}

		$lista = array();

		
			$ProductoxParroquia = $this->Seguimiento->getProductosID($dias, $_GET['parroquia'],$origen,$_GET['id'],$_GET['fuente'],$desde,$hasta);
		
		foreach ($ProductoxParroquia as $key => $value) {

		
		
				if($_GET['parroquia']=="promediado"){
					$idparroquia="promediado";
					$parroquia="Promedio General";
				}else{
					$parroquia=$value->parroquia;
					$idparroquia=$value->parroquia_id;
				}
			$data = $this->Seguimiento->listar($_GET['id'], $dias,$idparroquia, "todos", "bs", $_GET['fecha'],$origen,$desde,$hasta);

			$lista[] = array(
				"producto" => $parroquia,
				"promedio" => number_format($value->promedio, 2, ",", "."),
				"precio" =>  number_format($value->promedio, 2, ",", "."),
				"id" => uniqid(),
				"usd" => number_format($value->promedio  / $value->tasa, 2, ",", "."), 
				"datos" => $data
			);
		}

		
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($lista ));

	}
	

	public function getEje()
	{
		$data = $this->Seguimiento->getEje($_GET['id']);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
	public function productos()
	{
		$data = $this->Seguimiento->productos();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
	public function  parroquias()
	{
		$data = $this->Seguimiento->parroquias($_GET['id']);
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function  guardarProducto()
	{
		$objDatos = json_decode(file_get_contents("php://input"));

		$producto=$this->Seguimiento->getProducto($objDatos->nuevoproducto);
		if($producto){

			$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array("result"=>false)));
		}else{

			$data = $this->Seguimiento->guardarProducto(array("descripcion"=>$objDatos->nuevoproducto));

			$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array("result"=>true)));

		}

	}
	public function  guardarTasa()
	{
		$objDatos = json_decode(file_get_contents("php://input"));

		$data = $this->Seguimiento->guardarTasa(array("tasa"=>$objDatos->tasa,"fecha"=>$objDatos->fecha,"fuente"=>$objDatos->fuente));
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}


	public function  tasa()
	{
	$fecha_actual = date("Y-m-d");
		$fecha_anterior = date("Y-m-d", strtotime(date("Y-m-d") . "-1 days"));
		$data = $this->Seguimiento->tasa($fecha_actual);
		$data2 = $this->Seguimiento->tasa($fecha_anterior);
		$anterior=0;
		$atual=0;
		if(isset($data[0]->tasa)){
		
			$atual=$data[0]->tasa;
		}

		if(isset($data2[0]->tasa)){
			$anterior=$data2[0]->tasa;
	
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array("tasa"=>$atual,
					"anterior"=>$anterior)));
	}

	public function  registrar()
	{

		$this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
		$this->load->view('layout/sidebar');
		$this->load->view('registrar');
		$this->load->view('layout/footer');
	}

	public function  productosall()
	{

		$data = $this->Seguimiento->productosall();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}


	public function 	origen()
	{
		$data = $this->Seguimiento->origen();
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	public function 	tasaActual()
	{
		$data = $this->Seguimiento->tasaActual($_REQUEST['desde'],$_REQUEST['hasta'],"BCV");
		$monitor=$this->Seguimiento->tasaActual($_REQUEST['desde'],$_REQUEST['hasta'],"MONITOR");
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array("BCV"=>$data,"MONITOR"=>$monitor)));
	}
	
	public function registrarSeguimiento()
	{
		$objDatos = json_decode(file_get_contents("php://input"));

		/* id integer NOT NULL DEFAULT nextval('seguimiento_id_seq'::regclass),
  fecha timestamp without time zone NOT NULL DEFAULT now(),
  producto_id integer,
  precio double precision NOT NULL DEFAULT 0,
  tasa double precision NOT NULL DEFAULT 0,
  estado_id integer DEFAULT 0,
  municipio_id integer DEFAULT 0,
  circuito_id integer DEFAULT 0,
  parroquia_id integer,
  semana integer DEFAULT 1,
  id_origen integer,	*/
		 $tasa= $this->Seguimiento->getTasa($objDatos->fecha);
	
		
		if(count($tasa )==0){

	echo	json_encode(array("result"=>false) );
	exit;

		}

	
		$datos = array(
			"fecha" => $objDatos->fecha,
			"producto_id" => $objDatos->producto,
			"precio" => $objDatos->precio,
			"tasa" => $tasa[0]->tasa,
			"estado_id" => 24,
			"municipio_id" => 462,
			"parroquia_id" => $objDatos->parroquia,
			"circuito_id" => $objDatos->eje,
			"id_origen" => $objDatos->origen,
			"id_fuente" => $objDatos->fuente,
			 "user_id"=>$_SESSION["user_id"],
		);

		$this->Seguimiento->registrarSeguimiento($datos);
		echo	json_encode(array("result"=>true) );
	}
	public function productosPromedio(){
		$hoy =date("Y-m-d");
		$productos = $this->Seguimiento->getProductosPromedioALL($hoy, "todos","todos",1);

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($productos ));

	}
}
