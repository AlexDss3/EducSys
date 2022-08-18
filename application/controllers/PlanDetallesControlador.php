<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanDetallesControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct(){
        parent::__construct();
        $this->load->model('PlanDetallesModel');
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index($idPlanificacion = 0)
	{
		/** NO SE UTILIZA */
	}

	public function Insertar($idProfesor = 0, $idPlanificacion = 0, $idAsignacion = 0, $anio = 0, $materia = "")
	{
		if($this->input->post())
		{
            if($this->PlanDetallesModel->Insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data["contenido"] = $this->PlanDetallesModel->Contenidos($idProfesor, $idAsignacion);
			$data["idProfesor"] = $idProfesor;
			$data["idPlanificacion"] = $idPlanificacion;
			$data["idAsignacion"] = $idAsignacion;
			$data["anio"] = $anio;

			$data["materia"] = $materia;
			
			$this->load->view('comun/header', $data);
			$this->load->view('plandetalles/insertar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function Editar($idProfesor = 0, $idPlanDetalle = 0, $idPlanificacion = 0, $idAsignacion = 0, $anio = 0, $materia = "")
	{
		if($this->input->post())
		{
            if($this->PlanDetallesModel->actualizar($this->input->post(), $idPlanDetalle)){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

            $data["plandetalles"] = $this->PlanDetallesModel->Consultar($idPlanDetalle);
			$data["contenido"] = $this->PlanDetallesModel->Contenidos($idProfesor, $idAsignacion);
            $data["idPlanDetalle"] = $idPlanDetalle;
			
			$data["idProfesor"] = $idProfesor;
			$data["idPlanificacion"] = $idPlanificacion;
			$data["idAsignacion"] = $idAsignacion;
			$data["anio"] = $anio;
			$data["materia"] = $materia;

			$this->load->view('comun/header', $data);
			$this->load->view('plandetalles/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function Eliminar()
	{
		if($this->input->post())
		{
			$this->PlanDetallesModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function Buscar($idPlanificacion = 0, $idAsignacion = 0, $anio = 0, $materia = "")
	{
		if($this->input->post())
		{
			$data['ListaPlanDetalles'] 	= $this->PlanDetallesModel->Buscar($this->input->post('idPlanificacion'), $this->input->post('idAsignacion'), $this->input->post('anio'), $this->input->post('tema'));

			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data["idPlanificacion"] = $idPlanificacion;
			$data["idAsignacion"] = $idAsignacion;
			$data["anio"] = $anio;

			$data["materia"] = $materia;

			$this->load->view('plandetalles/panelPlandetalles', $data);
		}
	}

	public function Exportar($idProfesor, $Materia, $idPlanificacion, $idAsignacion, $anio)
	{
		$data['Materia'] = urldecode($Materia);
		$data['Anio'] = $anio;

		$data['Profesor'] = $this->PlanDetallesModel->NombreProfesor($idProfesor);
		$data['SeccionAsignada'] = $this->PlanDetallesModel->SeccionAsignada($idProfesor, $idPlanificacion, $idAsignacion, $anio);
		$data['DatosExportar'] = $this->PlanDetallesModel->DatosExportar($idPlanificacion, $idAsignacion, $anio);

		$this->load->view('exportar/vistaExportarPlan', $data);
	}

	public function VerRecursos($idPlanDetalle, $NombreProfe, $Nmateria, $idProfesor, $idPlanificacion, $idAsignacion, $anio)
	{
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;

		$data["ListaRecursos"] = $this->PlanDetallesModel->Recursos($idPlanDetalle);
		$data["idPlanDetalle"] = $idPlanDetalle;
		$data["NombreProfe"] = $NombreProfe;
		$data["Nmateria"] = $Nmateria;
		$data["idProfesor"] = $idProfesor;
		$data["idPlanificacion"] = $idPlanificacion;
		$data["idAsignacion"] = $idAsignacion;
		$data["anio"] = $anio;

		$this->load->view('comun/header', $data);
		$this->load->view('recursos/index', $data);
		$this->load->view('comun/footer');
	}
}
