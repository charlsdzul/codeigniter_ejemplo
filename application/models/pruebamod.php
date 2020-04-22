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


    function getCiudadesSinaloa($id_estado_sinaloa ){      
        $this->db->select("ciudad");
        $this->db->where('id_estado',$id_estado_sinaloa );
        $res = $this->db->get('cat_ciudades');
        $i = 0;
        foreach ($res->result() as $row){
            $ciudadesSinaloa[$i] = $row->ciudad;
            $i++;
        } 
        return $ciudadesSinaloa;      
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

    function getEstadoPorCp($cp_selected){      
        $this->db->select("*");
        $this->db->where('cp', $cp_selected);
        $id_estado = $this->db->get('cat_codigo_postal')->row()->id_esatdo; //ERROR DE NOMBRE EN BDD, MAL ESCRITO id_esatdo

        $this->db->select("*");
        $this->db->where('id_estado',$id_estado);
        $estadoPorCp = $this->db->get('cat_estados')->row()->estado;

        echo $estadoPorCp;    
    }

    // Recibe CP y devuelve array de ciudades con ese CP
    function getCiudadesPorCp($cp_selected){      
        $this->db->select("*");
        $this->db->where('cp', $cp_selected);
        $id_estado = $this->db->get('cat_codigo_postal')->row()->id_esatdo; //ERROR DE NOMBRE EN BDD, MAL ESCRITO id_esatdo

        $this->db->select("*");
        $this->db->where('id_estado',$id_estado);
        $res = $this->db->get('cat_ciudades');

        $i = 0;
        
        foreach ($res->result() as $row){
            $ciudadesPorCp[$i] = $row->ciudad;
            $i++;
        } 

        return $ciudadesPorCp;  
        //var_dump($ciudadesPorCp);
    }




    function getColoniasPorCiudad($desarrollo_ciudad){      
        $this->db->select("*");
        $this->db->where('ciudad', $desarrollo_ciudad);
        $id_ciudad = $this->db->get('cat_ciudades')->row()->id_ciudad; 

        
        $this->db->select("*");
        $this->db->where('id_ciudad',$id_ciudad);
        $res = $this->db->get('cat_codigo_postal');

        $i = 0;        
        foreach ($res->result() as $row){
            $coloniasPorCiudad[$i] = $row->colonia;
            $i++;
        } 

        return $coloniasPorCiudad;  
        //var_dump($ciudadesPorCp);

        
    }


    function getCpsPorCiudad($desarrollo_ciudad){      
        $this->db->select("*");
        $this->db->where('ciudad', $desarrollo_ciudad);
        $id_ciudad = $this->db->get('cat_ciudades')->row()->id_ciudad; 

        
        $this->db->select("*");
        $this->db->where('id_ciudad',$id_ciudad);
        $res = $this->db->get('cat_codigo_postal');

        $i = 0;        
        foreach ($res->result() as $row){
            $cpsPorCiudad[$i] = $row->cp;
            $i++;
        } 

        return $cpsPorCiudad;  
        //var_dump($ciudadesPorCp);

        
    }








/*
    function getCiudadPorColonia($desarrollo_colonia){      

        $this->db->select("*");
        $this->db->where('cp', $cp_selected);
        $id_estado = $this->db->get('cat_codigo_postal')->row()->id_esatdo; //ERROR DE NOMBRE EN BDD, MAL ESCRITO id_esatdo

        $this->db->select("*");
        $this->db->where('id_estado',$id_estado);
        $estadoPorCp = $this->db->get('cat_estados')->row()->estado;

        echo $estadoPorCp;
    
    }
*/




    function getCp($desarrollo_colonia, $desarrollo_ciudad){  

        $this->db->select("*");
        $this->db->where('ciudad',$desarrollo_ciudad);
        $id_ciudad = $this->db->get('cat_ciudades')->row()->id_ciudad;  


        $this->db->select("*");
        $this->db->where('colonia',$desarrollo_colonia);
        $this->db->where('id_ciudad',$id_ciudad);
        $codigo_postal = $this->db->get('cat_codigo_postal')->row()->cp;  

        echo $codigo_postal;    
    }



    function getCpTyped($cp_ingresado){   
        //Obtiene CP que inician con el número de cp ingreasado, no exacto
        $this->db->select("*");
        $this->db->like('cp', $cp_ingresado); //Obtiene los campos que inician que lo ingresado
        $res = $this->db->get('cat_codigo_postal');  
        $i = 0;

            foreach ($res->result() as $row){
                $cps[$i] = $row->cp;
                $i++;
            } 

        $cps = array_unique($cps); //Remueve valores duplicados del array
        //var_dump($cps);
        return $cps;    
    }







    function getColonias($cp_selected){   
        $this->db->select("*");
        $this->db->where('cp',$cp_selected);      
        $res = $this->db->get('cat_codigo_postal');
        $i = 0;

            foreach ($res->result() as $row){
                $colonias_por_cp[$i] = $row->colonia;
                $i++;
            } 

        return $colonias_por_cp;      
    }







    function registroDesarrollo($datos_desarrollo){ 

        $datos_desarrollo=json_decode($datos_desarrollo); //Recibe un objeto (como string)
        //var_dump($datos_desarrollo);
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
        $this->db->set('desarrollo_etapas_planeadas',$datos_desarrollo->desarrollo_etapas_planeadas);
        $this->db->set('desarrollo_plan_maestro_descripcion',$datos_desarrollo->desarrollo_plan_maestro_descripcion);
        $this->db->set('desarrollo_promedio_ventas_mensuales',$datos_desarrollo->desarrollo_plan_maestro_descripcion);


        
        $this->db->insert('cat_registro_desarrollos');   
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    function registroEtapas($datos_desarrollo_etapas,$numero_etapas){ 
        $datos_desarrollo_etapas=json_decode($datos_desarrollo_etapas); //Recibe un objeto (como string)
        //var_dump($datos_desarrollo_etapas);
        //var_dump($datos_desarrollo_etapas);            
              $this->db->set('planeado',$datos_desarrollo_etapas->etapa_1->etapa1_planeado);        
        $this->db->set('planeado_casas',$datos_desarrollo_etapas->etapa_1->etapa1_planeado_casas);
        $this->db->set('planeado_deptos',$datos_desarrollo_etapas->etapa_1->etapa1_planeado_deptos);
        $this->db->set('planeado_terrenos',$datos_desarrollo_etapas->etapa_1->etapa1_planeado_terrenos);
        //$this->db->set('sta',0);
        
        $this->db->set('vendido',$datos_desarrollo_etapas->etapa_1->etapa1_vendido);
        $this->db->set('vendido_casas',$datos_desarrollo_etapas->etapa_1->etapa1_vendido_terrenos);
        $this->db->set('vendido_deptops',$datos_desarrollo_etapas->etapa_1->etapa1_vendido_terrenos);
        $this->db->set('vendido_terrenos',$datos_desarrollo_etapas->etapa_1->etapa1_vendido_terrenos);
        $this->db->set('venta',$datos_desarrollo_etapas->etapa_1->etapa1_venta);
        $this->db->set('venta_casas',$datos_desarrollo_etapas->etapa_1->etapa1_venta_casas);
        $this->db->set('venta_deptos',$datos_desarrollo_etapas->etapa_1->etapa1_venta_deptos);
        $this->db->set('venta_terrenos',$datos_desarrollo_etapas->etapa_1->etapa1_venta_terrenos);        
        $this->db->set('etapa_estatus',$datos_desarrollo_etapas->etapa_1->etapa1_estatus);
        $this->db->set('etapa_tipo',$datos_desarrollo_etapas->etapa_1->etapa1_tipo);
        $this->db->insert('cat_etapas'); 
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    function registrarEtapasDesarrollo($id_insert_desarollo,$id_insert_etapas){
            $etapas = array(
                'desarrollo_etapa_1' => $id_insert_etapas
            );

            $this->db->set($etapas);
            $this->db->where('id',$id_insert_desarollo);
            $this->db->update('cat_registro_desarrollos');
    }
}

?>
