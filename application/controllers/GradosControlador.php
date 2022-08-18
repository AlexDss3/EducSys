<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GradosControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;


	function __construct(){
        parent::__construct();
        $this->load->model("GradosModel");
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index()
	{
		/** NO SE UTILIZA */
	}

	public function insertar(){
		if($this->input->post()){
            if($this->GradosModel->insertar($this->input->post())){
				echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$this->load->view('comun/header', $data);
			$this->load->view('grados/insertar');
			$this->load->view('comun/footer');
		}
	}

	public function editar($id){
		if($this->input->post()){
            if($this->GradosModel->actualizar($this->input->post(), $id)){
                $this->index();
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

            $data["grados"] = $this->GradosModel->Consultar($id);
            $data["id"] = $id;

			$this->load->view('comun/header', $data);
			$this->load->view('grados/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->GradosModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			$data['ListaGrados'] 	= $this->GradosModel->Buscar($this->input->post('tipo'));

			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$this->load->view('grados/tabla_grados', $data);
		}
	}

	public function BuscaSeccion(){
		if ($this->input->post('seccion')) 
		{
			$sec = $this->input->post('seccion');
			$data = $this->GradosModel->BuscaSeccion($sec);

			$seccion = $data[0]->seccion;

			if ($seccion == $sec) {
				echo 'ok';
			}
		}
	}
}
