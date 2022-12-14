<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PerfilesModel extends CI_Model{

	// TABLAS
	public $Tasignaciones 		= 'asignaciones';
	public $Tgrados 			= 'grados';
	public $Tmaterias 			= 'materias';
	public $Tmateriasniveles 	= 'materiasniveles';
	public $Tplanificaciones 	= 'planificaciones';
	public $Troles 				= 'roles';
	public $Tusuarios 			= 'usuarios';

	// COLUMNAS
	public $CidAsignacion		= 'asignaciones.idAsignacion';
	public $CasigIdProfe		= 'asignaciones.idUsuario';
	public $CasigIdMateriaNivel = 'asignaciones.idMateriaNivel';
	public $CasigIdGrado 		= 'asignaciones.idGrado';
	
	public $CidGrado 			= 'grados.idGrado';
	public $Cnivel				= 'grados.nivel';
	public $Ctipo				= 'grados.tipo';
	public $Cseccion			= 'grados.seccion';
	
	public $CidMateria 			= 'materias.idMateria';
	public $Cmateria			= 'materias.materia';
	
	public $CmnIdMateriaNivel	= 'materiasniveles.idMateriaNivel';
	public $CmnIdMateria 		= 'materiasniveles.idMateria';
	public $CmnNivel 			= 'materiasniveles.nivel';
	
	public $CidPlanificacion	= 'planificaciones.idPlanificacion';
	public $CplanIdAsig			= 'planificaciones.idAsignacion';
	public $Canio				= 'planificaciones.anio';

	public $CidRol				= 'roles.idRol';
	public $Crol 				= 'roles.rol';

	public $CidProfe 			= 'usuarios.idUsuario';
	public $Cnombre 			= 'usuarios.nombre';
	public $Capellido 			= 'usuarios.apellido';
	public $Ccorreo 			= 'usuarios.correo';
	public $Ctelefono 			= 'usuarios.telefono';
	public $Cusuario 			= 'usuarios.usuario';
	public $Cclave 				= 'usuarios.clave';
	public $CprofeRol			= 'usuarios.idRol';

	
	public function ListarProfesores()
	{
		// CONJUNTO DE DATOS
		$Columnas 	= array($this->CidProfe, $this->Cnombre, $this->Capellido, $this->Ccorreo, $this->Ctelefono, $this->Crol);
		$Tablas 	= array($this->Tusuarios, $this->Troles);
		$Filtro 	= $this->CprofeRol." = ".$this->CidRol;

		// CONSULTA
		$this->db->select($Columnas)->from($Tablas)->where($Filtro)->order_by($this->Cnombre,'ASC');

		return $this->db->get()->result();
	}

	public function NombreProfesor($idProfesor)
	{
		// CONJUNTO DE DATOS
		$Columnas 	= array($this->Cnombre, $this->Capellido);
		$Filtro 	= $this->CidProfe." = ".$idProfesor;

		// CONSULTA
		$this->db->select($Columnas)->from($this->Tusuarios)->where($Filtro);

		return $this->db->get()->result();
	}

	public function ListarPlanificaciones($idProfesor)
	{
		// CONJUNTO DE DATOS
		$Columnas 	= array($this->CidPlanificacion, $this->CidAsignacion, $this->Cmateria, $this->Cnivel, $this->Ctipo, $this->Cseccion, $this->Canio);
		$Tablas 	= array($this->Tplanificaciones, $this->Tasignaciones, $this->Tusuarios, $this->Tmateriasniveles, $this->Tmaterias, $this->Tgrados);
		$Filtro 	= $this->CplanIdAsig." = ".$this->CidAsignacion." AND ".$this->CasigIdProfe." = ".$this->CidProfe." AND ".$this->CasigIdMateriaNivel." = ".$this->CmnIdMateriaNivel." AND ".$this->CasigIdGrado." = ".$this->CidGrado." AND ".$this->CmnIdMateria." = ".$this->CidMateria." AND ".$this->CmnNivel." = ".$this->Cnivel." AND ".$this->CidProfe." = ".$idProfesor;
		
		// CONSULTA
		$this->db->select($Columnas)->from($Tablas)->where($Filtro);

		return $this->db->get()->result();
	}

	public function ConsultarMaterias()
	{
		// CONJUNTO DE DATOS
		$Columnas 	= array($this->CidMateria, $this->Cmateria);

		// CONSULTA
		$this->db->select($Columnas)->from($this->Tmaterias);

		return $this->db->get()->result();
	}

	public function ConsultarSecciones()
	{
		// CONSULTA
		$this->db->select($this->Cseccion)->from($this->Tgrados);

		return $this->db->get()->result();
	}

	public function ConsultarGrados()
	{
		// CONJUNTO DE DATOS
		$Columnas 	= array($this->CidGrado, $this->Cnivel, $this->Ctipo, $this->Cseccion);

		// CONSULTA
		$this->db->select($Columnas)->from($this->Tgrados)->order_by($this->Cnivel, 'ASC');

		return $this->db->get()->result();
	}

	public function ListarAsignaciones($idProfesor)
	{
		// CONJUNTO DE DATOS
		$Columnas 	= array($this->CidAsignacion, $this->Cnombre, $this->Cmateria, $this->CmnIdMateriaNivel, $this->Cseccion);
		$Tablas 	= array($this->Tasignaciones, $this->Tusuarios, $this->Tmateriasniveles, $this->Tmaterias, $this->Tgrados);
		$Filtro 	= $this->CasigIdProfe." = ".$this->CidProfe." AND ".$this->CasigIdMateriaNivel." = ".$this->CmnIdMateriaNivel." AND ".$this->CasigIdGrado." = ".$this->CidGrado." AND ".$this->CmnIdMateria." = ".$this->CidMateria." AND ".$this->CmnNivel." = ".$this->Cnivel." AND ".$this->CidProfe." = ".$idProfesor;

		// CONSULTA
		$this->db->select($Columnas)->from($Tablas)->where($Filtro);

		return $this->db->get()->result();
	}

	public function ListarMateriaNivel()
	{
		// CONJUNTO DE DATOS
		$Columnas 	= array($this->CmnIdMateriaNivel, $this->CmnIdMateria, $this->Cmateria, $this->CmnNivel);
		$Tablas 	= array($this->Tmateriasniveles, $this->Tmaterias);
		$Filtro 	= $this->CmnIdMateria." = ".$this->CidMateria;

		// CONSULTA
		$this->db->select($Columnas)->from($Tablas)->where($Filtro)->order_by($this->CmnNivel,'ASC');

		return $this->db->get()->result();
	}
}