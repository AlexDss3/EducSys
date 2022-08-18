<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MNModel extends CI_Model{
    private $nombreTabla = "materiasniveles";
    private $idTabla = "idMateriaNivel";

	public function insertar($datos)
	{
		if($this->db->insert($this->nombreTabla, $datos)){
            return $this->db->insert_id();
        }
		return false;
	}
	
	public function actualizar($datos,$id){
		$this->db->where($this->idTabla, $id);
		if($this->db->update($this->nombreTabla, $datos))
		    return true;
		else
		    return $this->db->error;
	}

	public function Eliminar($id){
		$this->db->delete($this->nombreTabla, array($this->idTabla => $id)); 
	}

	public function Consultar($id){
		return $this->db->get_where($this->nombreTabla, array($this->idTabla => $id))->row();
	}

	public function ConsultaCombo($tabla,$id,$nombre){
		return $this->db->query("SELECT $id as id, $nombre as nombre FROM $tabla");
	}

	public function ConsultaNivel(){
		return $this->db->query("SELECT nivel FROM grados GROUP BY nivel");
	}

	public function Buscar($nivel,$materia){
		if ($nivel == 0 && $materia == 0) {
			$this->db->select("materiasniveles.idMateriaNivel, materiasniveles.idMateria, materias.materia, materiasniveles.nivel")->from("materiasniveles, materias")->where("materiasniveles.idMateria = materias.idMateria")->order_by('materiasniveles.nivel','ASC');
			return $this->db->get()->result();

		}else if($nivel > 0 && $materia > 0){
			$this->db->select("materiasniveles.idMateriaNivel, materiasniveles.idMateria, materias.materia, materiasniveles.nivel")->from("materiasniveles, materias")->where("materiasniveles.idMateria = materias.idMateria AND materiasniveles.nivel = $nivel AND materiasniveles.idMateria = $materia")->order_by('materiasniveles.nivel','ASC');
			return $this->db->get()->result();

		}else if($nivel > 0){
			$this->db->select("materiasniveles.idMateriaNivel, materiasniveles.idMateria, materias.materia, materiasniveles.nivel")->from("materiasniveles, materias")->where("materiasniveles.idMateria = materias.idMateria AND materiasniveles.nivel = $nivel")->order_by('materiasniveles.nivel','ASC');
			return $this->db->get()->result();

		}else if($materia > 0){
			$this->db->select("materiasniveles.idMateriaNivel, materiasniveles.idMateria, materias.materia, materiasniveles.nivel")->from("materiasniveles, materias")->where("materiasniveles.idMateria = materias.idMateria AND materiasniveles.idMateria = $materia")->order_by('materiasniveles.nivel','ASC');
			return $this->db->get()->result();
		}
	}

	public function ListarUnidades($idMateriaNivel){
		$this->db->from('unidades');
		return $this->db->query("SELECT materiasniveles.idMateriaNivel, unidades.idUnidad, unidades.unidad, unidades.nombreUnidad, asignaciones.idUsuario, usuarios.nombre, usuarios.apellido, grados.seccion
		FROM materiasniveles, unidades, asignaciones, usuarios, grados 
		WHERE materiasniveles.idMateriaNivel = unidades.idMateriaNivel and materiasniveles.idMateriaNivel = asignaciones.idMateriaNivel and usuarios.idUsuario = asignaciones.idUsuario and grados.idGrado = asignaciones.idGrado and unidades.idMateriaNivel = $idMateriaNivel AND asignaciones.idMateriaNivel = $idMateriaNivel and materiasniveles.idMateriaNivel = $idMateriaNivel order by unidades.unidad");
	}

	public function Consultas($tabla,$id,$nombre){
		return $this->db->query("SELECT $id as id, $nombre as nombre FROM $tabla");
	}

	public function BuscaMateriaAsignada($niv, $mat){
		$this->db->select('nivel, idMateria')->from('materiasniveles')->where('nivel = '.$niv.' AND idMateria = '.$mat.'');
		return $this->db->get()->result();
	}
}