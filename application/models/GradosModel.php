<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GradosModel extends CI_Model{
    private $nombreTabla = "grados";
    private $idTabla = "idGrado";

	public $Tgrados 			= 'grados';

	public $CidGrado 			= 'grados.idGrado';
	public $Cnivel				= 'grados.nivel';
	public $Ctipo				= 'grados.tipo';
	public $Cseccion			= 'grados.seccion';

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

	public function ConsultaCombo(){
		return $this->db->query("SELECT * FROM grados")->result();
	}

	public function Buscar($tipo){
		if($tipo == "B" || $tipo == "M"){
			// CONJUNTO DE DATOS
			$Columnas 	= array($this->CidGrado, $this->Cnivel, $this->Ctipo, $this->Cseccion);

			// CONSULTA
			$this->db->select($Columnas)->from($this->Tgrados)->where($this->Ctipo, $tipo)->order_by($this->Cnivel, 'ASC');

			return $this->db->get()->result();
		}else if($tipo == "x"){
			// CONJUNTO DE DATOS
			$Columnas 	= array($this->CidGrado, $this->Cnivel, $this->Ctipo, $this->Cseccion);

			// CONSULTA
			$this->db->select($Columnas)->from($this->Tgrados)->order_by($this->Cnivel, 'ASC');

			return $this->db->get()->result();
		}
	}

	public function BuscaSeccion($sec){
		$this->db->select('seccion')->from('grados')->where('seccion = '.'"'.$sec.'"');
		return $this->db->get()->result();
	}
}