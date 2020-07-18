<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TipoCambioController extends CI_Controller
{

	function __construct()
	{

		parent::__construct();

		$this->load->model('Seguimiento');
		$this->load->library('session');
	}

	public function index()
    {
        $this->load->view('layout/header');
		$this->load->view('layout/navbar-toolbar');
		
        $this->load->view('layout/sidebar');
       
        $this->load->view('tipoCambioW');
        $this->load->view('layout/footer');
 

    }



    
}