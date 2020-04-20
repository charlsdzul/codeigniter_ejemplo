<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->helper(array('url'));    
        $this->load->library('session'); 
    }
    
	public function getCiudades(){
        $this->load->model('pruebamod');
        $data = $this->pruebamod->getCiudades();  
        echo json_encode($data);     
    }

    public function getDesarrollos(){
        $this->load->model('pruebamod');
        $data = $this->pruebamod->getDesarrollos();  
        echo json_encode($data);  
    }

    public function getConstructoras(){
        $this->load->model('pruebamod');
        $data = $this->pruebamod->getConstructoras();  
        echo json_encode($data);        
    }

    public function getZonas(){
        $this->load->model('pruebamod');
        $data = $this->pruebamod->getZonas();  
        echo json_encode($data);      
    }

    public function getColoniasSinaloa(){
        $this->load->model('pruebamod');
        $data = $this->pruebamod->getColoniasSinaloa();  
        echo json_encode($data);      
    }

    public function getCodigoPostalSinaloa(){
        $this->load->model('pruebamod');
        $data = $this->pruebamod->getCodigoPostalSinaloa();  
        echo json_encode($data);      
    }

    public function getEstado(){
        $desarrollo_ciudad = $_GET['desarrollo_ciudad'];
        $this->load->model('pruebamod');
        $data = $this->pruebamod->getEstado($desarrollo_ciudad);  
        return $data;      
    }

    public function getCp(){
        $desarrollo_colonia = $_GET['desarrollo_colonia'];
        $this->load->model('pruebamod');
        $data = $this->pruebamod->getCp($desarrollo_colonia);  
        return $data;      
    }

    public function saveDesarrollo(){
        $datos_desarrollo = $_POST['form1_datos'];
        $datos_desarrollo_etapas = $_POST['etapas_datos'];

        $this->load->model('pruebamod');
        $data = $this->pruebamod->registroDesarrollo($datos_desarrollo); 

        //var_dump($form1_datos);
        //var_dump($etapas_datos);

        /*
        $this->load->model('pruebamod');
        $data = $this->pruebamod->getEstado($desarrollo_ciudad);  
        return $data;    
        
        */
    }

}
