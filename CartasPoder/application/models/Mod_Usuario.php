<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_usuario extends CI_Model 
{

	public function ActualizarUsuario($idusuario, $password)
	{	
		$query = $this->db->query("SELECT * FROM USUARIO WHERE IDUSUARIO ='$idusuario'");

		if ($query->num_rows() > 0)
		{
			$query = $this->db->query("UPDATE USUARIO set PASSWORD = '$password' WHERE IDUSUARIO = '$idusuario'");
			if($this->db->affected_rows() > 0)
			return true;				
		}		
	}

	public function PerfilUsuario($idusuario, $perfil)
	{	
		$query = $this->db->query("SELECT * FROM USUARIO WHERE IDUSUARIO ='$idusuario'");

		if ($query->num_rows() > 0)
		{
			$query = $this->db->query("UPDATE USUARIO SET PERFIL_ID = '$perfil' WHERE IDUSUARIO = '$idusuario'");
			if($this->db->affected_rows() > 0)
			return true;				
		}
	}	
}