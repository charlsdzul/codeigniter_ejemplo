<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PruebaMod extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database(); //cargar base de datos
    }

    function getCiudades(){      
        $this->db->select("ciudad");
        $res = $this->db->get('cat_ciudades');
        $i = 0;
        foreach ($res->result() as $row){
            $ciudades[$i] = $row->ciudad;
            $i++;
        } 
        return $ciudades;      
    }

    function getDesarrollos(){      
        $this->db->select("nombre_desarrollo");
        $res = $this->db->get('cat_desarrollos');
        $i = 0;
        foreach ($res->result() as $row){
            $desarrollos[$i] = $row->nombre_desarrollo;
            $i++;
        } 
        return $desarrollos;      
    }

    function getZonas(){      
        $this->db->select("zona");
        $res = $this->db->get('cat_zonas');
        $i = 0;
        foreach ($res->result() as $row){
            $zonas[$i] = $row->zona;
            $i++;
        } 
        return $zonas;      
    }

    function getConstructoras(){      
        $this->db->select("compania");
        $res = $this->db->get('cat_constructoras');
        $i = 0;
        
        foreach ($res->result() as $row){
            $constructoras[$i] = $row->compania;
            $i++;
        } 
        return $constructoras;      
    }


    function getColoniasSinaloa(){      
        $this->db->select("colonia");
        $res = $this->db->get('cat_codigo_postal');
        $i = 0;
        
        foreach ($res->result() as $row){
            $colonias_sinaloa[$i] = $row->colonia;
            $i++;
        } 
        return $colonias_sinaloa;      
    }

    function getCodigoPostalSinaloa(){      
        $this->db->select("cp");
        $res = $this->db->get('cat_codigo_postal');
        $i = 0;
        
        foreach ($res->result() as $row){
            $cps_sinaloa[$i] = $row->cp;
            $i++;
        } 
        return $cps_sinaloa;      
    }

    function getEstado($desarrollo_ciudad){      
        $this->db->select("*");
        $this->db->where('ciudad',$desarrollo_ciudad);
        $id_estado = $this->db->get('cat_ciudades')->row()->id_estado;

        $this->db->select("*");
        $this->db->where('id_estado',$id_estado);
        $estado = $this->db->get('cat_estados')->row()->estado;

        echo $estado;
    
    }


    function getCp($desarrollo_colonia){   
        $this->db->select("*");
        $this->db->where('colonia',$desarrollo_colonia);
        $codigo_postal = $this->db->get('cat_codigo_postal')->row()->cp;  
        echo $codigo_postal;    
    }


    function registroDesarrollo($datos_desarrollo){ 

        $datos_desarrollo=json_decode($datos_desarrollo); //Recibe un objeto (como string)
        //$this->db->set('id',$datos_desarrollo->0);
        $this->db->set('ciudad',$datos_desarrollo->ciudad);
        $this->db->set('fecha',$datos_desarrollo->fecha);
        $this->db->set('hora_llegada',$datos_desarrollo->hora_llegada);
        $this->db->set('hora_salida',$datos_desarrollo->hora_salida);
        $this->db->set('vivienda_cotizada',$datos_desarrollo->vivienda_cotizada);


        $this->db->set('vendedor',$datos_desarrollo->vendedor);
        $this->db->set('auditor',$datos_desarrollo->auditor);
        $this->db->set('auditor_edad',$datos_desarrollo->auditor_edad);
        $this->db->set('desarrollo_nombre_comercial_desarrollo',$datos_desarrollo->desarrollo_nombre_comercial_desarrollo);
        $this->db->set('desarrollo_nombre_empresa_desarroladora',$datos_desarrollo->desarrollo_nombre_empresa_desarroladora);
        $this->db->set('desarrollo_ciudad',$datos_desarrollo->desarrollo_ciudad);
        $this->db->set('desarrollo_estado',$datos_desarrollo->desarrollo_estado);
        $this->db->set('desarrollo_colonia',$datos_desarrollo->desarrollo_colonia);
        $this->db->set('desarrollo_calle',$datos_desarrollo->desarrollo_calle);
        $this->db->set('desarrollo_numero_exterior',$datos_desarrollo->desarrollo_numero_exterior);
        $this->db->set('desarrollo_numero_interior',$datos_desarrollo->desarrollo_numero_interior);
        $this->db->set('desarrollo_cp',$datos_desarrollo->desarrollo_cp);

        $this->db->set('desarrollo_plan_maestro',$datos_desarrollo->desarrollo_plan_maestro);

        $this->db->set('desarrollo_plan_maestro_imagen',$datos_desarrollo->desarrollo_plan_maestro_imagen);

        $this->db->set('desarrollo_zona',$datos_desarrollo->desarrollo_zona);

        $this->db->set('desarrollo_estatus_desarrollo',$datos_desarrollo->desarrollo_estatus_desarrollo);
        
        $this->db->set('status',0);
        //$this->db->set('etapas_seleccionadas',$datos_desarrollo->desarrollo_etapas_planeadas);



        
        
        
        
        $this->db->insert('cat_registro_desarrollos');   

       // $datos_desarrollo = json_encode($datos_desarrollo);
       // $datos_desarrollo = str_replace('\"', '"', $datos_desarrollo );
       // $datos_desarrollo = json_decode($datos_desarrollo);
       // echo $datos_desarrollo['ciudad'];

        //var_dump($datos_desarrollo);
        
        /*
        $this->db->set('name', $_POST['name']);
        $this->db->set('last', $_POST['last']);
        $this->db->set('estatus', $_POST['estatus']);
        $this->db->set('rol', $_POST['rol']);
        $this->db->insert('clientes');        

        return '00';

        */
    }



}

?>