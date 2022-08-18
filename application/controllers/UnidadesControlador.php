<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadesControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct(){
        parent::__construct();
        $this->load->model("UnidadesModel");
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index($id = 0)
	{
		/** NO SE UTILIZA */
	}

	public function insertar($idAsignacion, $idProfesor, $NombreMateria)
	{
		if($this->input->post())
		{
            if($this->UnidadesModel->insertar($this->input->post()))
			{
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data["idAsignacion"] = $idAsignacion;
			$data['idProfesor'] = $idProfesor;
			$data['NombreMateria'] = $NombreMateria;

			$this->load->view('comun/header', $data);
			$this->load->view('unidades/insetar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function editar($id, $idAsignacion, $idProfesor)
	{
		if($this->input->post())
		{
            if($this->UnidadesModel->actualizar($this->input->post(), $id))
			{
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

            $data["unidades"] = $this->UnidadesModel->Consultar($id);
            $data["id"] = $id;
			$data["idAsignacion"] = $idAsignacion;
			$data['idProfesor'] = $idProfesor;

			$this->load->view('comun/header', $data);
			$this->load->view('unidades/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar()
	{
		if($this->input->post())
		{
			$this->UnidadesModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function VerContenidos($idUnidad, $idMateriaNivel, $idProfesor)
	{
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;

		$data['idUnidad'] = $idUnidad;
		$data['idMateriaNivel'] = $idMateriaNivel;
		$data['idProfesor'] = $idProfesor;

		$data['ListaContenido']	= $this->UnidadesModel->ListarContenidos($idUnidad);
		$data["materias"] = $this->UnidadesModel->ConsultaCombo("unidades, materiasniveles WHERE materiasniveles.idMateriaNivel = unidades.idMateriaNivel and unidades.idUnidad = $idUnidad",
		"unidades.idMateriaNivel",
		"concat('Unidad #',unidades.unidad,' ',unidades.nombreUnidad)");

		$data['materiaUnidad'] = $this->UnidadesModel->ConsultaCombo("unidades, materiasniveles, materias where unidades.idMateriaNivel = materiasniveles.idMateriaNivel and materiasniveles.idMateria = materias.idMateria and unidades.idUnidad = $idUnidad","materias.idMateria","materia");
		
		$this->load->view('comun/header', $data);
		$this->load->view('contenido/index', $data);
		$this->load->view('comun/footer');
	}
}