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
        $numero_etapas = $_POST['numero_etapas'];

        $this->load->model('pruebamod');

        $id_insert_desarollo= $this->pruebamod->registroDesarrollo($datos_desarrollo);      
        $id_insert_etapas = $this->pruebamod->registroEtapas($datos_desarrollo_etapas,$numero_etapas);
        $id_insert_desarollo= $this->pruebamod->registrarEtapasDesarrollo($id_insert_desarollo,$id_insert_etapas);  


    

    }

}
