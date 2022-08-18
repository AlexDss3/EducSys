<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecursosControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct()
	{
        parent::__construct();
        $this->load->model('RecursosModel');
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index($idPlanDetalle = 0)
	{
		/** NO SE UTILIZA */
	}

	public function Insertar($idPlanDetalle = 0, $NombreProfe = "", $Nmateria = "", $idProfesor = 0, $idPlanificacion = 0, $idAsignacion = 0, $anio = 0)
	{
		if($this->input->post())
		{
			$NombreProfe = $this->input->post('nombreProfe');
            $Nmateria = $this->input->post('nombreMateria');
            $idProfesor = $this->input->post('idProfe');
            $idPlanificacion = $this->input->post('idPlan');
            $idAsignacion = $this->input->post('idAsig');
            $anio = $this->input->post('anio');

			if($_FILES){
				$id = $this->input->post('idPlanDetalle');
				$tipo = $this->input->post('tipo');

				$directorio = 'uploads/';
				$subir_archivo = $directorio.basename($_FILES['recurso']['name']);
				
				if (move_uploaded_file($_FILES['recurso']['tmp_name'], $subir_archivo)) {
					$dato = [
						'idPlandetalle' => $id,
						'recurso'		=> $subir_archivo,
						'tipo'			=> $tipo
					];

					if($this->RecursosModel->Insertar($dato)){
						echo 'ok';
						return redirect(base_url()."index.php/PlanDetallesControlador/VerRecursos/$id/$NombreProfe/$Nmateria/$idProfesor/$idPlanificacion/$idAsignacion/$anio",'location',302);
					}else{
						echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
					}

					echo "El archivo es válido y se cargó correctamente.<br><br>";
				} else {
					echo "La subida ha fallado";
				}
			}else{
				$id = $this->input->post('idPlanDetalle');
				$recurso = $this->input->post('recurso');
				$tipo = $this->input->post('tipo');

				$dato = [
					'idPlandetalle' => $id,
					'recurso'		=> $recurso,
					'tipo'			=> $tipo
				];

				if($this->RecursosModel->Insertar($dato)){
					echo 'ok';
					return redirect(base_url()."index.php/PlanDetallesControlador/VerRecursos/$id/$NombreProfe/$Nmateria/$idProfesor/$idPlanificacion/$idAsignacion/$anio",'location',302);
				}else{
					echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
				}
			}
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data["idPlanDetalle"] = $idPlanDetalle;
			$data["NombreProfe"] = $NombreProfe;
			$data["Nmateria"] = $Nmateria;
			$data["idProfesor"] = $idProfesor;
			$data["idPlanificacion"] = $idPlanificacion;
			$data["idAsignacion"] = $idAsignacion;
			$data["anio"] = $anio;
			
			$this->load->view('comun/header', $data);
			$this->load->view('recursos/insertar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar()
	{
		if($this->input->post())
		{
			$dato = $this->input->post('URl');
			/* SABER SI ES URL */
			$url = "http";
			$buscaUrl = strpos($dato, $url);
			/* SABER SI ES ARCHIVO */
			$archivo = "uploads/";
			$buscaArchivo = strpos($dato, $archivo);

			/* SI ES URL ELIMINAR DE ESTA FORMA */
			if ($buscaUrl !== FALSE) {
				$this->RecursosModel->Eliminar($this->input->post('id'));
				echo 'ok';

			/* SI ES ARCHIVO ELIMINAR DE ESTA FORMA */
			} else if($buscaArchivo !== FALSE){
				$this->RecursosModel->Eliminar($this->input->post('id'));
				if (unlink($this->input->post('URl'))) 
				{
					echo 'ok';
				} else {
					echo 'error';
				}
			}
		}else{
			echo 'error';
		}
	}
}
