<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller { //ci_ son los maestros

	public function index() //primera funcion de trabajo
	{
		redirect('auth/login');
	}
    public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombre','Nombre','trim|strtolower|required');
        $this->form_validation->set_rules('password','Password','required');

        if ($this->form_validation->run() == FALSE) { //el metodo run devuelve true si las reglas se cumplieron
            $this->load->view('login');
        }else{
            $this->load->model('usuarios_model');
            $usuario = set_value("nombre");
            $password = set_value("password");
            if ($uid = $this->usuarios_model->check_login($usuario,$password)) {
                $u=$this->usuarios_model->get_by_id($uid);
                if($u["estado"] == 1){
                    $this->session->set_userdata("usuario_id",$uid);
                    $this->session->set_userdata("nombre",$u["nombre"]);
                    $this->session->set_userdata("rol_id",$u["rol_id"]);
                    redirect("todo");
                }else{
                    $this->session->set_flashdata("OP","Inactivo");
                    redirect("auth/login");
                }
                
            }else{
                $this->session->set_flashdata("OP","Incorrecto");
                redirect("auth/login");
            }           
        }
    }
    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata("OP","Salio");
        redirect("auth/login");
    }
	
}
