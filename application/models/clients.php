<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database(); //cargar base de datos
    }

    function obtenerClientes(){
      
        $this->db->select("*");
        $res = $this->db->get('clientes');
        //$res = $q->row();
        $clientes;
        $i = 0;
        foreach ($res->result() as $row)
        {
            $clientes[$i][0] = $row->id;
            $clientes[$i][1] = $row->name;
            $clientes[$i][2] = $row->last;
            $clientes[$i][3] = $row->estatus;
            $clientes[$i][4] = $row->rol;
            $i++;

            /*
            echo $row->id;
            echo $row->name;
            echo $row->last;
            */
        }      

        //echo $res;
        return $clientes;      
    }

    function guardarCliente(){

        $this->db->set('name', $_POST['name']);
        $this->db->set('last', $_POST['last']);
        $this->db->set('estatus', $_POST['estatus']);
        $this->db->set('rol', $_POST['rol']);
        $this->db->insert('clientes');        

        return '00';

    }


    function login($usuario, $contrasena){
        $this->db->where('contrasena', $contrasena);
        $this->db->where('usuario', $usuario);      
        return $this->db->get('clientes')->row();
    }

}

?>
