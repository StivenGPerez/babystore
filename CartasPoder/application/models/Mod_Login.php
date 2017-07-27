<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_login extends CI_Model
{
  public function __construct()
  {
      parent::__construct();
      //Do your magic here
  }
  
  public function ValidarUsuario($usuario,$password)
  {
    // $sql_login = $this->db->get_where('usuario', array('idusuario' => $usuario, 'password' => $password));
    $sql_bls_fac = "SELECT * FROM USUARIO@DBUGENERAL WHERE IDUSUARIO = $usuario AND PASSWORD = '$password'";

    $sql_cons_bl = $this->db->query($sql_bls_fac);    
    
    if($sql_cons_bl->num_rows() == 1)
    {
      return $sql_cons_bl->result();
    }
    else
    {
      return false;
    }
  }
}
/* End of file mod_login.php */
/* Location: ./application/models/mod_login.php */