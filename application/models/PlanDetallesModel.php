<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PlanDetallesModel extends CI_Model{
    private $nombreTabla = "plandetalles";
    private $idTabla = "idPlanDetalle";

	public function Insertar($datos)
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

	// FILTRADO DE DATOS PARA LA VISTA DE LA PLANIFICACIÓN
	public function Buscar($idPlanificacion, $idAsignacion, $anio, $tema){
		$seleccion 	= " pd.idPlanDetalle, u.idUsuario, u.nombre, u.apellido, p.anio, DATE_FORMAT(pd.desde,'%d-%m-%Y') as desde, DATE_FORMAT(pd.hasta,'%d-%m-%Y') as hasta, m.idMateria, m.materia, uni.unidad, uni.nombreUnidad, c.correlativo, c.tema, DATE_FORMAT(pd.ejecutado,'%d-%m-%Y') as ejecutado, pd.ifea, IF(DAY(pd.ejecutado)>0,1,0) as hecho";
		$tablas 	= " plandetalles as pd, planificaciones as p, asignaciones as a, usuarios as u, contenidos as c, unidades as uni, materias as m ";
		$donde		= " pd.idPlanificacion = $idPlanificacion AND a.idAsignacion = $idAsignacion AND p.anio = $anio AND a.idUsuario = u.idUsuario AND p.idAsignacion = a.idAsignacion AND pd.idContenido = c.idContenido AND c.idUnidad = uni.idUnidad AND m.idMateria = uni.idMateria ";
		$bTema		= " AND c.tema = '$tema' ";

		if($tema != ""){
			$this->db->select($seleccion)->from($tablas)->where($donde.$bTema);
			return $this->db->get()->result();

		}else{
			$this->db->select($seleccion)->from($tablas)->where($donde);
			return $this->db->get()->result();
		}
	}
	
	public function Contenidos($idProfesor, $idAsignacion){
		$this->db->select("contenidos.idContenido, materias.materia, unidades.unidad, unidades.nombreUnidad, contenidos.correlativo, contenidos.tema")
				->from("contenidos, unidades, materias, materiasniveles, asignaciones")
				->where("contenidos.idUnidad = unidades.idUnidad AND materiasniveles.idMateria = materias.idMateria AND unidades.idMateriaNivel = materiasniveles.idMateriaNivel AND asignaciones.idMateriaNivel = materiasniveles.idMateriaNivel AND asignaciones.idUsuario = $idProfesor AND asignaciones.idAsignacion = $idAsignacion");
		return $this->db->get()->result();
	}

	public function DatosExportar($idPlanificacion, $idAsignacion, $anio){
		$this->db->select("uni.unidad, uni.nombreUnidad, c.correlativo, c.tema, p.anio, DATE_FORMAT(pd.desde,'%d-%m') as desde, DATE_FORMAT(pd.hasta,'%d-%m') as hasta, DATE_FORMAT(pd.ejecutado,'%d-%m') as ejecutado, g.tipo, g.seccion")
				->from("plandetalles as pd, planificaciones as p, asignaciones as a, usuarios as u, contenidos as c, unidades as uni, materias as m, materiasniveles as mn, grados as g")
				->where("pd.idPlanificacion = $idPlanificacion AND p.idPlanificacion = $idPlanificacion AND p.anio = $anio AND a.idAsignacion = $idAsignacion AND p.idAsignacion = $idAsignacion AND a.idUsuario = u.idUsuario AND p.idAsignacion = a.idAsignacion AND pd.idContenido = c.idContenido AND c.idUnidad = uni.idUnidad AND uni.idMateriaNivel = mn.idMateriaNivel AND m.idMateria = mn.idMateria AND a.idGrado = g.idGrado");
		return $this->db->get()->result();
	}

	public function NombreProfesor($idProfesor){
		$this->db->select('nombre, apellido')->from('usuarios')->where('idUsuario = '.$idProfesor.'');
		return $this->db->get()->result();
	}

	public function SeccionAsignada($idProfesor, $idPlanificacion, $idAsignacion, $anio){
		$this->db->select("g.seccion, g.tipo")
				->from("planificaciones as p, asignaciones as a, usuarios as u, materiasniveles as mn, grados as g")
				->where("p.idPlanificacion = $idPlanificacion AND p.anio = $anio AND p.idAsignacion = $idAsignacion AND a.idAsignacion = $idAsignacion AND p.idAsignacion = a.idAsignacion AND a.idUsuario = $idProfesor AND u.idUsuario = $idProfesor AND a.idUsuario = u.idUsuario AND a.idMateriaNivel = mn.idMateriaNivel AND a.idGrado = g.idGrado");
		return $this->db->get()->result();
	}

	public function Consultar($idPlanDetalle){
		return $this->db->get_where($this->nombreTabla, array($this->idTabla => $idPlanDetalle))->row();
	}

	// ACCEDER AL LISTADO DE RECURSOS PEDIDOS EN EL DETALLE DE LA PLANIFICACIÓN
	public function Recursos($idPlanDetalle){
		return $this->db->query("SELECT r.idRecurso, u.nombre, u.apellido, m.materia, uni.unidad, uni.nombreUnidad, c.correlativo, c.tema, r.recurso, r.tipo
		FROM recursos as r, plandetalles as pd, planificaciones as p, asignaciones as a, usuarios as u, contenidos as c, unidades as uni, materias as m, materiasniveles as mn
		WHERE r.idPlanDetalle = $idPlanDetalle AND r.idPlanDetalle = pd.idPlanDetalle AND pd.idPlanificacion = p.idPlanificacion AND p.idAsignacion = a.idAsignacion AND a.idUsuario = u.idUsuario AND pd.idContenido = c.idContenido AND c.idUnidad = uni.idUnidad AND uni.idMateriaNivel = mn.idMateriaNivel AND m.idMateria = mn.idMateria");
	}
}