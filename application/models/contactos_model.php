<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contactos_model extends CI_Model
{
	private $usuario_id = NULL;

	// Asigna el ID del usuario para filtrar contactos
	public function set_usuario_id($valor) {
		$this->usuario_id = $valor;
	}

	// Obtiene la lista de contactos para el usuario actual
	public function obtener_contactos() {
		$this->db->select("contactos.*");
		$this->db->from('contactos');
		if ($this->usuario_id != NULL) {
			$this->db->where('usuario_id', $this->usuario_id);
		}
		$this->db->order_by('contacto_id', 'DESC');

		return $this->db->get()->result_array();
	}

	// Agrega un nuevo contacto
	public function agregar_contacto($usuario_id, $nombre, $apellido, $telefono, $email) {
		$this->db->set('usuario_id', $usuario_id);
		$this->db->set('nombre', $nombre);
		$this->db->set('apellido', $apellido);
		$this->db->set('telefono', $telefono);
		$this->db->set('email', $email);
		$this->db->insert('contactos');

		return $this->db->insert_id(); // Devuelve el ID del contacto insertado
	}

	// Borra un contacto por su ID
	public function borrar_contacto($id) {
		$id = intval($id);
		$this->db->where("contacto_id", $id);
		$this->db->delete("contactos");

		return $this->db->affected_rows(); // Devuelve el número de filas afectadas
	}

	// Modifica los datos de un contacto existente
	public function modificar_contacto($id, $nombre, $apellido, $telefono, $email) {
		$this->db->where("contacto_id", intval($id));
		$this->db->set('nombre', $nombre);
		$this->db->set('apellido', $apellido);
		$this->db->set('telefono', $telefono);
		$this->db->set('email', $email);
		$this->db->update("contactos");

		return $this->db->affected_rows(); // Devuelve el número de filas afectadas
	}

    // Obtiene un contacto por su ID
public function obtener_contacto($id) {
    $this->db->where("contacto_id", intval($id));
    return $this->db->get("contactos")->row_array();
}

}
