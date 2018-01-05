<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class pfModels extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function initModel()
	{
		return $this->db->get("t_alumnos")->result_array();
	}

	public function loadCourses()
	{
		return $this->db->get("t_materias")->result_array();
	}

	public function loadGrades()
	{
		$this->db->select("concat(a.nombre,' ',a.ap_paterno) as nombre");
		$this->db->select('c.id_t_calificaciones as id');
		$this->db->select('m.nombre as materia');
		$this->db->select('c.calificacion as calificacion');
		$this->db->from('t_calificaciones c');
		$this->db->join('t_alumnos a', 'c.id_t_usuarios = a.id_t_usuarios','inner');
		$this->db->join('t_materias m', 'c.id_t_materias = m.id_t_materias','inner');
		return $this->db->get()->result_array();
	}

	public function newAsset($a,$m,$c)
	{

		$this->db->set('id_t_materias',$m);
		$this->db->set('id_t_usuarios',$a);
		$this->db->set('calificacion',$c);
		$this->db->set('fecha_registro','NOW()',false);
		$this->db->insert("t_calificaciones");
		if($this->db->affected_rows() === 1)
			return true;
		else
			return null;

	}

	public function modifyAsset($i,$c)
	{
		$this->db->set('calificacion',$c);
		$this->db->where('id_t_calificaciones',$i);
		$this->db->update("t_calificaciones");
		if($this->db->affected_rows() === 1)
			return true;
		else
			return null;

	}

	public function deleteAsset($i)
	{
		$this->db->where('id_t_calificaciones',$i);
		$this->db->delete("t_calificaciones");
		if($this->db->affected_rows() === 1)
			return true;
		else
			return null;

	}

	public function getAsset($a)
	{
		$this->db->select("a.nombre as nombre");
		$this->db->select("a.ap_paterno as apellido");
		$this->db->select('a.id_t_usuarios as id');
		$this->db->select('m.nombre as materia');
		$this->db->select('c.calificacion as calificacion');
		$this->db->select('DATE_FORMAT(c.fecha_registro, "%d/%m/%Y") as fecha_registro',false);
		$this->db->from('t_calificaciones c');
		$this->db->join('t_alumnos a', 'c.id_t_usuarios = a.id_t_usuarios','inner');
		$this->db->join('t_materias m', 'c.id_t_materias = m.id_t_materias','inner');
		$this->db->where('c.id_t_usuarios',$a);
		return $this->db->get()->result_array();
	}
}

?>