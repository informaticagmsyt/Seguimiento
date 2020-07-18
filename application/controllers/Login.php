<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{

		parent::__construct();

		$this->load->model('Seguimiento');
		$this->load->library('session');

        $this->load->model('Fuentes');
    }
	
	
	public function index(){


		$this->load->view('login');

	}

	public function verificar(){

		$user = $this->Seguimiento->getUser($_POST['usuario'],$_POST['clave']);
			if(!empty($user)){
			
				$repuesta=array("pasa"=>true);
				$_SESSION["user"]=$_POST['usuario'];
				$_SESSION["user_id"]=$user[0]->id;
				$_SESSION["perfil"]=$user[0]->perfil;

			}else{
				$repuesta=array("pasa"=>false);
			}

			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($repuesta));
	}

	public function registrarUsuario(){
		if(!isset($_SESSION["user"]) && !isset($_SESSION["user_id"])){
			header('Location: index.php/login');
		}
		
		$this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
		$usuarios=$this->Fuentes->getUserALL();
        $this->load->view('layout/sidebar');
        $this->load->view('registrarUsuario',compact('usuarios'));
        $this->load->view('layout/footer');
		

	}
	public function addUser(){
		$objDatos = json_decode(file_get_contents("php://input"));

		if($this->Fuentes->getUser($objDatos->usuario)){
            $this->output
			->set_content_type('application/json')
			->set_output(json_encode( array("result"=>false)));

        }else{
		
			$data = $this->Fuentes->addUser(array("usuario"=>$objDatos->usuario,
			"perfil"=>$objDatos->perfil,
            "clave"=>$objDatos->clave));
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(  array("result"=>true)));
        }
	}
	public function guardarEdicionUsuario(){
		$objDatos = json_decode(file_get_contents("php://input"));
		$data = $this->Fuentes->editarUsuario($objDatos->id,$objDatos->perfil,$objDatos->nuevaClave);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode(  array("result"=>true)));

	}
	
}