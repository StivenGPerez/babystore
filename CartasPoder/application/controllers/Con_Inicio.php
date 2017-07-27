<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_Inicio extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_CartasPoder');
	}

	public function Index()
	{
		$this->load->view('Header');
		$this->load->view('Usuarios/Login');
		$this->load->view('Footer');
    $this->db->close();			
	}

	public function Principal()
	{
		// $session_data = $this->session->userdata('nueva_session');
		// $usuario=$session_data['idusuario'];
		
		$this->load->view('Header');
    $this->load->view('Encabezado');
    $this->load->view('Cartapoder/CartaPoder');
		$this->load->view('Footer');
    $this->db->close();			
	}

	public function CargarClienteJquery()
	{
		$carta_cliente = $this->input->get('term');		
		$cartapoder = $this->Mod_CartasPoder->SelectCliente($carta_cliente);

		// var_dump($cartapoder);		
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */