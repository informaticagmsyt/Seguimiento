<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    Class Fuentes extends CI_Model{

        function __construct(){

            parent::__construct();
            $this->load->database();
        }

        public function registrar($fuentes){


            $this->db->insert('fuentes',$fuentes);
 
        }

        public function get($id){

            $this->db->select("*");

            $this->db->from('fuentes');
            $this->db->where('origen_id',$id);
            $query = $this->db->get();
            
            $data= $query->result();
  

       
       return  $data;
        }

        public function fuente($fuente){

            $this->db->select("*");

            $this->db->from('fuentes');
            $this->db->where('nombre',$fuente);
            $query = $this->db->get();
            
            $data= $query->result();
  

       
       return  $data;
        }


        public function  editarProducto($id,$producto){

            $this->db->where('id', $id);
            $this->db->set('descripcion', $producto);
            return $this->db->update('productos');
        }


        public function  editarUsuario($id,$perfil,$nuevaClave){
            $this->db->where('id', $id);
            $this->db->set('perfil', $perfil);
            $this->db->set('clave', $nuevaClave);
            return $this->db->update('users');

        }

        public function  eliminarTasa($id){

         
        return $this->db->delete('tasa_cambio', array('id' => $id));
        }

        public function  editarTasa($id,$nuevaTasa){

            $this->db->where('id', $id);
            $this->db->set('tasa', $nuevaTasa);
            return $this->db->update('tasa_cambio');
        }

        
        public function all(){

            $this->db->select("distinct(fuentes.id), origen.descripcion as origen,parroquias.parroquia,fuentes.nombre as fuente");

            $this->db->from('fuentes');
            $this->db->join('parroquias','parroquia_id=id_parroquia','inner');
            $this->db->join('origen','origen.id=origen_id','inner');

            $query = $this->db->get();
            
            $data= $query->result();
  

       
       return  $data;
        }


        public function listaproductos(){

            $this->db->select("*");

            $this->db->from('productos');


            $query = $this->db->get();
            
            $data= $query->result();
  

       
       return  $data;
        }

        public function addUser($data){

           

            $this->db->insert('users',$data);
        }
        public function getUser($nombre){

            $this->db->select("*");

            $this->db->from('users');
            $this->db->where('usuario',$nombre);
            $query = $this->db->get();
            
            $data= $query->result();
  

       
       return  $data;
        }

        public function getUserALL(){

            $this->db->select("*");

            $this->db->from('users');

            $query = $this->db->get();
            
            $data= $query->result();
  

       
       return  $data;
        }
        
        
    }