<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct()
	{
        parent::__construct();
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function AcercaDe()
	{
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;
		
		$this->load->view('comun/header', $data);
		$this->load->view('acercade/index', $data);
		$this->load->view('comun/footer');
	}
}