<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper(array('url'));    
        $this->load->library('session'); 
    }
	
    public function index()   
	{
    }  
    
    function obtenerClientes(){
        

        $this->load->model('clients');
        $data = $this->clients->obtenerClientes();  
        echo json_encode($data);
    }


    function altaClientes(){
        $this->load->model('clients');
        $respuesta = $this->clients->guardarCliente();
        echo $respuesta;

    }

    function login(){

        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
       
        $this->load->model('clients');
        $respuesta = $this->clients->login($usuario, $contrasena);
        if($respuesta==null){
            echo "01";
        }else{            
            echo '00';
            $this->session->set_userdata('USUARIO', $usuario);
        }         
    }
    


}
