<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AsignacionesControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;
	private $materianivel;
	private $grado;
	private $mnNivel;
	private $grNivel;

	function __construct()
	{
        parent::__construct();
        $this->load->model("AsignacionesModel");
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index($id = 0)
	{
		/** NO SE UTILIZA */
	}

	public function insertar($idProfesor)
	{
		if($this->input->post())
		{
            if($this->AsignacionesModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data['idProfesor'] = $idProfesor;

			$data["profesores"] = $this->AsignacionesModel->ConsultaCombo($idProfesor);
			$data["materias"] = $this->AsignacionesModel->MateriaAsignada();
			$data['secciones'] = $this->AsignacionesModel->Secciones();

			$this->load->view('comun/header', $data);
			$this->load->view('asignaciones/insertar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function editar($id)
	{
		if($this->input->post())
		{
            if($this->AsignacionesModel->actualizar($this->input->post(), $id)){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

            $data["asignaciones"] = $this->AsignacionesModel->Consultar($id);
            $data["id"] = $id;
			
			$data["profesores"] = $this->AsignacionesModel->ConsultaCombo($idProfesor);
			$data["materias"] = $this->AsignacionesModel->MateriaAsignada();
			$data['secciones'] = $this->AsignacionesModel->Secciones();

			$this->load->view('comun/header', $data);
			$this->load->view('asignaciones/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar()
	{
		if($this->input->post())
		{
			$this->AsignacionesModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function BuscaAsignacion(){
		if ($this->input->post()) 
		{
			$idusu = $this->input->post('idUsuario');
			$idmn = $this->input->post('idMateriaNivel');
			$idgr = $this->input->post('idGrado');

			$data = $this->AsignacionesModel->BuscaAsignacion($idusu, $idmn, $idgr);

			$this->materianivel = $data[0]->idMateriaNivel;
			$this->grado = $data[0]->idGrado;

			if ($idmn == $this->materianivel && $idgr == $this->grado) {
				echo 'ok';
			}
		}
	}

	public function BuscaAsignacionIgual(){
		if ($this->input->post()) 
		{
			$idmn = $this->input->post('idMateriaNivel');
			$idgr = $this->input->post('idGrado');

			$data = $this->AsignacionesModel->BuscaAsignacionIgual($idmn, $idgr);

			$this->mnNivel = $data[0]->mn;
			$this->grNivel = $data[0]->gr;

			if ($idmn == $this->mnNivel && $idgr == $this->grNivel) {
				echo 'ok';
			}
		}
	}

	public function VerUnidades($idMateriaNivel, $idProfesor)
	{
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;

		$data['idMateriaNivel'] = $idMateriaNivel;
		$data['idProfesor'] = $idProfesor;

		$data['ListaUnidades']= $this->AsignacionesModel->ListarUnidades($idMateriaNivel);
		$data["materias"] = $this->AsignacionesModel->Consultas("materiasniveles, materias, grados where materiasniveles.nivel = grados.nivel AND materiasniveles.idMateria = materias.idMateria and materiasniveles.idMateriaNivel = $idMateriaNivel",
		"materiasniveles.idMateriaNivel","concat(materias.materia,' ', grados.nivel,'°')");

		$this->load->view('comun/header', $data);
		$this->load->view('unidades/index', $data);
		$this->load->view('comun/footer');
	}
}
