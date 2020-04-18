<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charls extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('mihelper'); //Helper personalizado
		$this->load->helper('form'); //helper de CI para formularios. Ya se pueden usar los métodos en su vista
		$this->load->model('CharlsModel'); //Cargar modelo
	}


	public function nuevaCiudad(){
		$this->load->view('nuevo/headers');
		$this->load->view('formulario');
	}

	public function recibirDatos(){

		//RECIBE DATOS DE FORMULARIO views/formulario.php
		$data = array(
			'ciudad'=>$this->input->post('ciudad'),
			//'id_ciudad'=>$this->input->post('id_ciudad'),
			//'id_estado'=>$this->input->post('id_estado'),
		);



		//EJECUTA FUNCION DEL MODEL
		$this->CharlsModel->crearCiudad($data);
		//$this->load->view('nuevo/headers');
		//$this->load->view('nuevo/mensaje');



	}


	public function index()
	{
		$this->load->view('nuevo/bienvenido');
	}

	public function holaMundo()
	{
		$this->load->library('menu', array('Inicio','Contacto', 'Nosotros'));
		$data['mi_menu'] = $this->menu->construirMenu();
		$this->load->view('nuevo/headers');
		$this->load->view('nuevo/hola', $data);
	}



}

?>
