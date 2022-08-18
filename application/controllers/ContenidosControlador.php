<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContenidosControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct()
	{
        parent::__construct();
        $this->load->model("ContenidosModel");
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index($id = 0)
	{
		/** NO SE UTILIZA */
	}

	public function insertar($idUnidad = 0, $idMateriaNivel = 0, $idProfesor = 0)
	{
		if($this->input->post())
		{
            if($this->ContenidosModel->insertar($this->input->post()))
			{
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data['idUnidad'] = $idUnidad;
			$data['idMateriaNivel'] = $idMateriaNivel;
			$data['idProfesor'] = $idProfesor;

			$this->load->view('comun/header', $data);
			$this->load->view('contenido/insetar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function editar($id = 0, $idUnidad = 0, $idMateriaNivel = 0, $idProfesor = 0)
	{
		if($this->input->post())
		{
            if($this->ContenidosModel->actualizar($this->input->post(), $id))
			{
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

            $data["contenido"] = $this->ContenidosModel->Consultar($id);
			
            $data["id"] = $id;
			$data['idUnidad']=$idUnidad;
			$data['idMateriaNivel'] = $idMateriaNivel;
			$data['idProfesor'] = $idProfesor;

			$this->load->view('comun/header', $data);
			$this->load->view('contenido/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar()
	{
		if($this->input->post())
		{
			$this->ContenidosModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}
}