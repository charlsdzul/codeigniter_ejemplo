<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url'); 


	}



	public function index()

	{
		$this->load->view('inicio');
	}

	public function clientes(){

		$data['empresa'] = 'PIXXELS';

		if($this->session->userdata('USUARIO')!=null){
			echo 'Usuario en sesión: '. $this->session->userdata('USUARIO');
			$this->load->view('components/header');
			$this->load->view('clientes_body',$data);
	
		}else{
			echo '<h1>Sitio privado. Inicia Sesión</h1>';
			$this->load->view('components/header');
			$this->load->view('login_body');

		}

		
	}


	public function clientesAlta(){


		if($this->session->userdata('USUARIO')!=null){
			echo 'Usuario en sesión: '. $this->session->userdata('USUARIO');
			$this->load->view('components/header');
		$this->load->view('clientes_alta_body');
	
		}else{
			echo '<h1>Sitio privado. Inicia Sesión</h1>';
			$this->load->view('components/header');
			$this->load->view('login_body');

		}

	}


	public function login(){


		if($this->session->userdata('USUARIO')!=null){
			
			$this->load->view('components/header');
			$this->load->view('menu.php');
			echo '<h1> Ya estás en sesión '. $this->session->userdata('USUARIO')."</h1>";
		
	
		}else{
		
			$this->load->view('components/header');
			$this->load->view('login_body');

		}


	}

	public function logout(){
		$this->session->sess_destroy();
		 redirect('app/login');
	}

     
}
