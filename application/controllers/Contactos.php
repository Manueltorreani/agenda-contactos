<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contactos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('usuario_id')) {
            $this->session->set_flashdata("OP", "Prohibido");
            redirect('auth/login');
        }

        $this->load->model('contactos_model'); // Cargamos el modelo de contactos
    }

    // Función principal para mostrar los contactos del usuario
    public function index()
    {
        redirect('contactos/principal');
    }

    // Muestra la vista principal de contactos
    public function principal()
    {
        $datos = array();
        $this->contactos_model->set_usuario_id($this->session->userdata('usuario_id'));
        $datos['contactos'] = $this->contactos_model->obtener_contactos();
        $this->load->view('contactos/principal', $datos);
    }

    // Agrega un nuevo contacto
    public function agregar()
    {
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');
        $usuario_id = $this->session->userdata('usuario_id');

        $this->contactos_model->agregar_contacto($usuario_id, $nombre, $apellido, $telefono, $email);
        $this->session->set_flashdata("OP", "OK");
        redirect('contactos/principal');
    }

    // Borra un contacto
    public function borrar($id)
    {
        $this->contactos_model->borrar_contacto($id);
        redirect('contactos/principal');
    }

    // Modifica un contacto existente
    public function modificar($id)
    {
        // Obtiene el contacto desde el modelo para editarlo
        $datos['contacto'] = $this->contactos_model->obtener_contacto($id);

        // Si no se encuentra el contacto, redirige al listado
        if (empty($datos['contacto'])) {
            redirect('contactos/principal');
        }

        $this->load->view('contactos/modificar', $datos);
    }

    // Guarda la modificación de un contacto
    public function guardar_modificacion($id)
    {
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');

        $this->contactos_model->modificar_contacto($id, $nombre, $apellido, $telefono, $email);
        $this->session->set_flashdata("OP", "Actualizado");
        redirect('contactos/principal');
    }
}
