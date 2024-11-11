<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios_model extends CI_Model{

    public function get_by_id($id){
        $this->db->select('usuarios.*,roles.nombre AS rol_nombre');
        $this->db->join('roles','roles.rol_id = usuarios.rol_id','inner'); //(tabla con que la voy a unir, que voy a unir, que tipo de union es)
        $this->db->from('usuarios');
        $this->db->where('usuario_id',$id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function check_login($usuario,$password){
        $this->db->select("usuario_id");
        $this->db->where("nombre",$usuario);
        $this->db->where("password",md5($password));
        $query = $this->db->get("usuarios");
        if($query->num_rows()> 0){
            $tmp = $query->row_array();
            return $tmp["usuario_id"];
        }else{
            return false;
        }
    }

    public function listar (){
        $this->db->select("usuario_id,nombre,rol_id,estado");
        $this->db->from("usuarios");
        return $this->db->get()->result_array();
    }

    public function crear($nombre, $contraseña, $rol) {
        $data = array(
            'nombre' => $nombre,
            'password' => $contraseña,
            'rol_id' => $rol
        );
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }
    

    public function reactivar($id = 1) {
        $id = intval($id);
        $this->db->where('usuario_id', $id);
        $this->db->update('usuarios', array('estado' => 1));
        return $this->db->affected_rows();
    }

    public function borrar($id = 0) {
        $id = intval($id);
        $this->db->where('usuario_id', $id);
        $this->db->update('usuarios', array('estado' => 0));
        return $this->db->affected_rows();
    }
    
}

?>