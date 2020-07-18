<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->library('session');

		$this->load->model('Seguimiento');
	
	}

	public function index()
	{
		
		if(!isset($_SESSION["user"]) && !isset($_SESSION["user_id"])){
			header('Location: index.php/login');
		}
        
        $this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
		
        $this->load->view('layout/sidebar');
        $this->load->view('listProductos');
        $this->load->view('layout/footer');
	}

	public function dashboard()
	{
		
		if(!isset($_SESSION["user"]) && !isset($_SESSION["user_id"])){
			header('Location: index.php/login');
		}
        
        $this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
		
        $this->load->view('layout/sidebar');
        $this->load->view('dashboard');
        $this->load->view('layout/footer');
	}

	public function lista()
	{
		
		if(!isset($_SESSION["user"]) && !isset($_SESSION["user_id"])){
			header('Location: index.php/login');
		}
        
        $this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
		
        $this->load->view('layout/sidebar');
        $this->load->view('construccion');
        $this->load->view('layout/footer');
	}

	public function listaSeguimiento()
	{
		
		if(!isset($_SESSION["user"]) && !isset($_SESSION["user_id"])){
			header('Location: index.php/login');
		}
		$fecha_actual=date("Y-m-d");

		if(!isset($_GET['desde']) && !isset($_GET['hasta'])){
			$hasta = date("Y-m-d", strtotime(date("Y-m-d") . "+1 days"));
			$desde = date("Y-m-d");
		}else{
			$desde=$_GET['desde'];
			$hasta=$_GET['hasta'];
		}
		

        $data=$this->Seguimiento->allSeguimiento($desde,$desde);
        $this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
		
        $this->load->view('layout/sidebar');
		$this->load->view('listaSeguimiento',compact('data'));
	
		$this->load->view('layout/footer');
		$this->load->view('layout/scriptSeguimiento');
	}

	public function listaSeguimientoall(){
		$fecha_actual=date("Y-m-d");

		if(!isset($_GET['desde']) && !isset($_GET['hasta']) || empty($_GET['hasta'])  || empty($_GET['desde']) ){
			$hasta = date("Y-m-d", strtotime(date("Y-m-d") . "+1 days"));
			$desde = date("Y-m-d");
		}else{
			$desde=$_GET['desde'];
			$hasta=$_GET['hasta'];
		}
	
		$data=$this->Seguimiento->allSeguimiento($desde,$desde);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode(array("data"=>$data ) ));
	}
	public function guardarEdicion()
	{
		$objDatos = json_decode(file_get_contents("php://input"));

	
		$data=$this->Seguimiento->guardarEdicion($objDatos->id,$objDatos->precio);
		
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data ));
       
	}
	
	public function findseguimiento()
	{
	
		$data=$this->Seguimiento->findseguimiento($_GET['id']);
		
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data ));
       
	}

	public function eliminarSeguimiento()
	{
		$objDatos = json_decode(file_get_contents("php://input"));
	
		$data=$this->Seguimiento->eliminarSeguimiento($objDatos->id);
		
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data ));
       
	}

	

	
	



	

}
