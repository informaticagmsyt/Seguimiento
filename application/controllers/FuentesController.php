<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FuentesController extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->library('session');

        $this->load->model('Fuentes');
	
	}

	public function index()
    {

        if(!isset($_SESSION["user"])){
			header('Location: index.php/login');
		}
        
        $this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
        $data = $this->Fuentes->all();
        $this->load->view('layout/sidebar');
        $this->load->view('fuentes',compact("data"));
        $this->load->view('layout/footer');

    }


    public function add()
    {

        $objDatos = json_decode(file_get_contents("php://input"));
        if($this->Fuentes->fuente($objDatos->nombre)){
            $this->output
			->set_content_type('application/json')
			->set_output(json_encode( array("result"=>false)));

        }else{
            $data = $this->Fuentes->registrar(array("origen_id"=>$objDatos->origen,
            "parroquia_id"=>$objDatos->parroquia,
             "nombre"=>$objDatos->nombre));
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(  array("result"=>true)));
        }
        

    }
    public function registrar()
    {

        if(!isset($_SESSION["user"])){
			header('Location: index.php/login');
        }
        $this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
		
        $this->load->view('layout/sidebar');
        $data = $this->Fuentes->all();
        $this->load->view('registrarFuentes',compact("data"));
        $this->load->view('layout/footer');

    }

    public function get()
    {

      
        
        $data = $this->Fuentes->get($_GET['id']);
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode( $data));

    }

    public function all()
    {

      
        
        $data = $this->Fuentes->all();
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode( $data));

    }


    public function listaproductos()
    {

              
        $this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
		
        $this->load->view('layout/sidebar');
        $data = $this->Fuentes->listaproductos();
        $this->load->view('listaProductos',compact("data"));
        $this->load->view('layout/footer');

        
   


    }

    
    public function eliminarTasa()
    {
     
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $data=$this->Fuentes->eliminarTasa($objDatos->id);
        
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data ));

    }
    public function editarTasa()
    {
     
        $objDatos = json_decode(file_get_contents("php://input"));
        
        $data=$this->Fuentes->editarTasa($objDatos->id,$objDatos->nuevaTasa);
        
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data ));

    }
    public function editarProducto()
    {

              
      
        
            $objDatos = json_decode(file_get_contents("php://input"));
        
            $data=$this->Fuentes->editarProducto($objDatos->id,$objDatos->producto);
            
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data ));
    
        }
    
        
   


    
    

   
    

    
}