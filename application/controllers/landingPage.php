<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class landingPage extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pfModels');
		header('Access-Control-Allow-Origin: *'); 
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header('Access-Control-Allow-Headers: X-Requested-With, content-type, X-Token, x-token');
	}

	public function index()
	{
		$users = $this->pfModels->initModel();
		$courses = $this->pfModels->loadCourses();
		$data = array('users' => $users,'courses'=>$courses);
		$this->load->view('landingView',compact('data'));
	}

	public function pfpost($a,$m,$c)
	{
		$res = array();

		if ( "POST" !== $_SERVER['REQUEST_METHOD'] )
		{
			$res['success'] = 'fail';
			$res['msg'] = 'Método no permitido';
		} 

		else
		{
			$r = $this->pfModels->newAsset($a,$m,$c);
			if(!is_null($r))
			{
				$res['success'] = 'ok';
				$res['msg'] = 'Calificación registrada';
			}

			else
			{
				$res['success'] = 'fail';
				$res['msg'] = 'No fue posible registrar la calificación';
			}
		}
			
		echo json_encode($res);
	}

	public function pfget($a)
	{
		$res = array();
		if ( "GET" !== $_SERVER['REQUEST_METHOD'] )
		{
			$res['success'] = 'fail';
			$res['msg'] = 'Método no permitido';
		} 

		else
		{
			$r = $this->pfModels->getAsset($a);
			$cnt = 0;
			if(count($r) > 0)
			{
				for ($i=0; $i < count($r) ; $i++) 
				{
					$cnt = $cnt + floatval($r[$i]['calificacion']);
					$res[] = array(
						'id_t_usuario' => $r[$i]['id'],
						'nombre' => $r[$i]['nombre'],
						'apellido' => $r[$i]['apellido'],
						'materia' => $r[$i]['materia'],
						'calificacion' => $r[$i]['calificacion'],
						'fecha_registro' => $r[$i]['fecha_registro']
					);
				}
			$res['promedio'] = $cnt / count($r);
			}

			else
			{
				$res['success'] = 'fail';
				$res['msg'] = 'No fue posible recuperar la información';
			}
		}

			
		echo json_encode($res);
	}

	public function pfput($i,$c)
	{

		$res = array();
		if ( 'PUT' !== $_SERVER['REQUEST_METHOD'] )
		{
			$res['success'] = 'fail';
			$res['msg'] = 'Método no permitido';
		} 

		else 
		{
			$r = $this->pfModels->modifyAsset($i,$c);
			if(!is_null($r))
			{
				$res['success'] = 'ok';
				$res['msg'] = 'Calificación actualizada';
			}

			else
			{
				$res['success'] = 'fail';
				$res['msg'] = 'No fue posible actualizar la calificación';
			}
		}
			
		echo json_encode($res);
	}

	public function pfdelete($i)
	{
		$res = array();
		if ( 'DELETE' !== $_SERVER['REQUEST_METHOD'] )
		{
			$res['success'] = 'fail';
			$res['msg'] = 'Método no permitido';
		} 

		else
		{
			$r = $this->pfModels->deleteAsset($i);
			if(!is_null($r))
			{
				$res['success'] = 'ok';
				$res['msg'] = 'Calificación eliminada';
			}

			else
			{
				$res['success'] = 'fail';
				$res['msg'] = 'No fue posible aliminar la calificación';
			}
		}			
		echo json_encode($res);
	}

	public function loadGrades()
	{
		$res = array();
		$r = $this->pfModels->loadGrades();
		if(count($r) > 0)
		{
			for ($i=0; $i < count($r) ; $i++) 
			{
				$res['data'][] = array(
					'id' => $r[$i]['id'],
					'nombre' => $r[$i]['nombre'],
					'materia' => $r[$i]['materia'],
					'calificacion' => $r[$i]['calificacion']
				);
			}
		}

		else
		{
			$res['success'] = 'fail';
			$res['msg'] = 'No fue posible recuperar la información';
		}
			
		echo json_encode($res);
	}


}
