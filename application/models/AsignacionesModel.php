<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AsignacionesModel extends CI_Model{
	/** TABLAS */
    private $Tasignaciones 	= "asignaciones";
	private $Tusuarios 		= "usuarios";
	private $Tmaterias	 	= "materias";
	private $Tgrados	 	= "grados";

	/** COLUMNAS */
    private $CAsigidAsignacion 		= "asignaciones.idAsignacion";
	private $CAsigidUsuario 		= "asignaciones.idUsuario";
	private $CAsigidMateriaNivel 	= "asignaciones.idMateriaNivel";
	private $CAsigidGrado 			= "asignaciones.idGrado";
	private $CUsuidUsuario 			= "usuarios.idUsuario";
	private $CUsuNombre 			= "usuarios.nombre";
	private $CUsuApellido 			= "usuarios.apellido";

	public function insertar($datos)
	{
		if($this->db->insert($this->Tasignaciones, $datos)){
            return $this->db->insert_id();
        }
		return false;
	}
	
	public function actualizar($datos, $id){
		$this->db->where($this->CidAsignacion, $id);
		if($this->db->update($this->Tasignaciones, $datos))
		    return true;
		else
		    return $this->db->error;
	}

	public function Eliminar($id){
		$this->db->delete($this->Tasignaciones, array($this->CidAsignacion => $id)); 
	}

	public function Consultar($id){
		return $this->db->get_where($this->Tasignaciones, array($this->CidAsignacion => $id))->row();
	}

	public function ConsultaCombo($idProfesor){
		return $this->db->query("SELECT usuarios.idUsuario, usuarios.nombre, usuarios.apellido, roles.rol FROM usuarios, roles WHERE usuarios.idRol = roles.idRol AND usuarios.idUsuario = $idProfesor");
	}

	public function MateriaAsignada(){
		$this->db->select('materiasniveles.idMateriaNivel, materiasniveles.nivel, materias.materia')->from('materiasniveles, materias')->where('materiasniveles.idMateria = materias.idMateria');
		return $this->db->get()->result();
	}

	public function Secciones(){
		$this->db->select('idGrado, seccion, nivel')->from('grados');
		return $this->db->get()->result();
	}

	public function ListarUnidades($idMateriaNivel){
		$this->db->from('unidades');
		return $this->db->query("SELECT materiasniveles.idMateriaNivel, unidades.idUnidad, unidades.unidad, unidades.nombreUnidad, usuarios.nombre, usuarios.apellido, grados.seccion
		FROM asignaciones, materiasniveles, unidades, grados, usuarios 
		WHERE materiasniveles.idMateriaNivel = asignaciones.idMateriaNivel and materiasniveles.idMateriaNivel = unidades.idMateriaNivel and asignaciones.idGrado = grados.idGrado and asignaciones.idUsuario = usuarios.idUsuario and unidades.idMateriaNivel = $idMateriaNivel and materiasniveles.idMateriaNivel = $idMateriaNivel and asignaciones.idMateriaNivel = $idMateriaNivel order by unidades.unidad");
	}

	public function Consultas($tabla,$id,$nombre){
		return $this->db->query("SELECT $id as id, $nombre as nombre FROM $tabla");
	}

	public function BuscaAsignacion($idusu, $idmn, $idgr){
		$this->db->select('idMateriaNivel, idGrado')->from('asignaciones')->where('idUsuario = '.$idusu.' AND idMateriaNivel = '.$idmn.' AND idGrado = '.$idgr.'');
		return $this->db->get()->result();
	}

	public function BuscaAsignacionIgual($idmn, $idgr){
		$this->db->select(' materiasniveles.nivel as mn, grados.nivel as gr')
				->from('materiasniveles, grados')
				->where('materiasniveles.nivel = grados.nivel AND materiasniveles.idMateriaNivel = '.$idmn.' AND grados.idGrado = '.$idgr.'');
		return $this->db->get()->result();
	}
}