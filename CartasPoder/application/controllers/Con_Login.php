<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Con_Login extends CI_Controller{
  public function __construct()
  { 
    parent::__construct();
  }

  public function Login()
  {
    $usuario= $this->input->post('usuario'); 
    $password= $this->input->post('password');
    $linea_usu = $this->input->post('linea_usu');

    if($linea_usu != '-1' && $linea_usu != '')
    {
      if($usuario != '' && $password != '')
      {
        $this->load->model('Mod_login');
        $result=$this->Mod_login->ValidarUsuario($usuario,$password);

        if($result)
        {
          $datos_session = array();
          foreach($result as $row)
          {
            $datos_session = array(
            'idusuario' => $row->IDUSUARIO,
            'nombre' => $row->NOMBRE,
            'mail' => $row->MAIL,
            'sucursal' => $row->SUCURSAL,
            'perfil' =>$row->PERFIL_ID,
            // 'linea' => $row->LINEA
            'linea' => $linea_usu
            );
          }
          
          $this->session->set_userdata('nueva_session', $datos_session);

          $this->load->view('Header');
          $this->load->view('Encabezado');
          $this->load->view('Cartapoder/CartaPoder');
          $this->load->view('Footer');
        }
        else
        {
          echo "<script> alert('Usuario y/o Password Errados'); </script>";

          $this->load->view('Header');
          $this->load->view('Usuarios/Login');
          $this->load->view('Footer');
        }
      }
      else
      {
        echo "<script> alert('Usuario y/o Password Errados'); </script>";

        $this->load->view('Header');
        $this->load->view('Usuarios/Login');
        $this->load->view('Footer');
      }   
    }
    else
    {
      echo "<script> alert('Debe seleccionar una Linea...'); </script>";

      $this->load->view('Header');
      $this->load->view('Usuarios/Login');
      $this->load->view('Footer');
    }        
    $this->db->close();     
  }

  function Logout()
  {
    $this->load->view('Header');
    $this->load->view('Usuarios/Login');
    $this->load->view('Footer');

    $this->session->sess_destroy('nueva_session');
    $this->db->close();     
  }  

  public function CargarClienteJquery()
  {
    $this->load->model('Mod_CartasPoder');

    $carta_cliente = $this->input->get('term');   
    $cartapoder = $this->Mod_CartasPoder->SelectCliente($carta_cliente);
    
      $cliente_array = array();

        foreach($cartapoder as $row => $value)
        {
          $cliente_array[] = array(
            'key' => $value->NIT,
            'value' => $value->RAZON_SOCIAL
          );        
        }

      print_r(json_encode($cliente_array)); 
    $this->db->close();       
  }
}
/* End of file con_login.php */
/* Location: ./application/controllers/con_login.php */