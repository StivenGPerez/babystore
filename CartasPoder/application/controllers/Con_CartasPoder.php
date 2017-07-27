<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Con_CartasPoder extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mod_CartasPoder');
		$this->load->library('My_PHPMailer');    
	}

	public function ValidarLinea()
	{
		$usuario = $this->input->post('usuario');
		
		$lineausua = $this->Mod_CartasPoder->ValidarLinea($usuario);
		$i=0;

    $linea_array = array();
    foreach($lineausua as $row => $value)
    {
    	$linea = $value->LINEA;
			$porciones = explode(",", $linea);
			$num_lineas = count($porciones);
			$i = 0;

			echo "<select id='linea_usu' name='linea_usu' class='form-control' required='required'>";
				echo "<option value='-1' selected='selected'>Seleccione Linea</option>";
						while ($i < $num_lineas) 
						{
							echo "<option value=".$porciones[$i].">".$porciones[$i]." </option>";
						  $i++;  
						}
			echo "</select>";      				
    }
    $this->db->close();
	}

	public function CartapoderCons()
	{
		$data['id_carta'] = $this->Mod_CartasPoder->CartapoderCons();	
    $this->db->close();	
	}

	public function BuscarCartaspoder()
	{
		$session_data = $this->session->userdata('nueva_session');
		$usuario=$session_data['idusuario'];

		$carta_linea = $this->input->post('carta_linea');
		$carta_estado = $this->input->post('carta_estado');
		$carta_cliente = $this->input->post('tags_nit_cliente');
		$tags_nit_agente = $this->input->post('tags_nit_agente');
		$carta_sucursal = $this->input->post('carta_sucursal');

		$data['buscar_cartaspoder'] = $this->Mod_CartasPoder->BuscarCartaspoder($carta_linea, $carta_estado, $carta_cliente, $tags_nit_agente, $carta_sucursal);

		$cargar_vista = $this->load->view('Cartapoder/CrudCartaPoder',$data, true);
		echo $cargar_vista;			
    $this->db->close();			
	}

	public function CrearCartaspoderIni()
	{
		// $session_data = $this->session->userdata('nueva_session');
		// $usuario=$session_data['idusuario'];

		//$data['id_carta'] = $this->Mod_CartasPoder->CartapoderCons();						
		// $data['select_linea'] = $this->Mod_CartasPoder->select_linea($usuario);

		$this->load->view('Header');
   	$this->load->view('Encabezado');
		$this->load->view('Cartapoder/CrearCartapoder');
		$this->load->view('Footer');
    $this->db->close();			
	}

	public function CargarClienteJquery()
	{
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
    // $this->db->close();		    
	}

	public function CrearCartaspoder()
	{
		$session_data = $this->session->userdata('nueva_session');
		$usuario=$session_data['idusuario'];
		$nombre=$session_data['nombre'];
		
		$carta_cliente = $this->input->post('tags_nit_cliente');
		$carta_agente = $this->input->post('tags_nit_agente');
		$carta_linea = $this->input->post('carta_linea');
		$carta_fec_ini = $this->input->post('carta_fec_ini');
		$carta_fec_fin = $this->input->post('carta_fec_fin');
		$carta_dias_vig = $this->input->post('carta_dias_vig');
		$carta_obs = $this->input->post('carta_obs');

		$sql_max_id = $this->Mod_CartasPoder->CrearCartaspoder($carta_cliente, $carta_agente, $carta_linea, $carta_fec_ini, $carta_fec_fin, $carta_dias_vig, $carta_obs, $nombre);
    // $this->db->close();			
	}

	public function ModificarCartaspoder()
	{
		$session_data = $this->session->userdata('nueva_session');
		$usuario=$session_data['idusuario'];

		$carta_cliente = $this->input->post('tags_cliente');
		$carta_agente = $this->input->post('tags_agente');
		$carta_linea = $this->input->post('carta_linea');
		$carta_fec_ini = $this->input->post('carta_fec_ini');
		$carta_fec_fin = $this->input->post('carta_fec_fin');
		$carta_dias_vig = $this->input->post('carta_dias_vig');
		$carta_obs = $this->input->post('carta_obs');
		$id_carta = $this->input->post('id_carta');
		$carta_estado = $this->input->post('carta_estado');

		$sql_max_id = $this->Mod_CartasPoder->ModificarCartaspoder($carta_cliente, $carta_agente, $carta_linea, $carta_fec_ini, $carta_fec_fin, $carta_dias_vig, $carta_obs, $id_carta, $carta_estado);
    $this->db->close();			
	}

	public function CrearDeCartaspoder()
	{
		$session_data = $this->session->userdata('nueva_session');
		$usuario=$session_data['idusuario'];

		$carta_cliente = $this->input->post('tags_nit_cliente');
		$carta_agente = $this->input->post('tags_nit_agente');		
		$sucursal = $this->input->post('sucursal');
		$carta_linea = $this->input->post('carta_linea');
		$email = $this->input->post('email');
		$nom_pdf = $carta_cliente."-".$carta_agente."-".$carta_linea.".pdf"; //basename($userfile);

		$data['ruta'] = $this->Mod_CartasPoder->CrearDeCartasPoder($sucursal, $nom_pdf, $carta_cliente, $carta_agente, $email, $carta_linea);
    $this->db->close();			
	}

	public function ModifDeCartaspoder()
	{
		$session_data = $this->session->userdata('nueva_session');
		$usuario=$session_data['idusuario'];

		$carta_linea = $this->input->post('carta_linea');
		$sucursal = $this->input->post('sucursal');		
		$carta_cliente = $this->input->post('tags_cliente');
		$carta_agente = $this->input->post('tags_agente');
		$email = $this->input->post('email');
		$id_carta = $this->input->post('id_carta');
		$nom_pdf = $carta_cliente."-".$carta_agente."-".$carta_linea.".pdf"; //basename($userfile);

		$data['ruta'] = $this->Mod_CartasPoder->ModifDeCartaspoder($sucursal, $nom_pdf, $carta_cliente, $carta_agente, $email, $carta_linea, $id_carta);
    $this->db->close();			
	}	

  public function DoUpload() 
  {
		$nit_cl = $this->input->get('nit_cl');
		$nit_ag = $this->input->get('nit_ag');		
		$cart_linea = $this->input->get('cart_linea');

	  if (array_key_exists('HTTP_X_FILE_NAME', $_SERVER) && array_key_exists('CONTENT_LENGTH', $_SERVER)) {
	    $fileName = $_SERVER['HTTP_X_FILE_NAME'];
	    $contentLength = $_SERVER['CONTENT_LENGTH'];
		} else throw new Exception("Error retrieving headers");

		// $path = 'E:\\xampp\\htdocs\\gerleinco\\CartasPoder\\CartasPoder\\';
		$path = 'E:\\xampp\\htdocs\\CartasPoder\\CartasPoder\\';

		if (!$contentLength > 0) {
		    throw new Exception('No file uploaded!');
		}
		$fileName = $nit_cl."-".$nit_ag."-".$cart_linea.".pdf"; 
			file_put_contents(
		    $path . $fileName,
		    file_get_contents("php://input")
		);
  	// rename('E:\\xampp\\htdocs\\gerleinco\\CartasPoder\\CartasPoder\\'.$fileName, '\\\\192.168.10.236\\doc\\cartapoder\\'.$fileName);			
  	rename('E:\\xampp\\htdocs\\CartasPoder\\CartasPoder\\'.$fileName, '\\\\192.168.10.236\\doc\\cartapoder\\'.$fileName);			
		//chmod($path.$fileName, 0777);
    $this->db->close();			
	}

	public function ConsultaCartapoder()
	{
		$session_data = $this->session->userdata('nueva_session');
		$usuario=$session_data['idusuario'];

		$id_cartapoder = $this->input->post('id_cartapoder');
		$data['carta_poder_modf'] = $this->Mod_CartasPoder->ConsultaCartapoder($id_cartapoder);

		$cargar_vista = $this->load->view('Cartapoder/CrearCartaPoderAjax', $data, true);
		echo $cargar_vista;		
    $this->db->close();						
	}

	public function ActualizarCarta()
	{
		$ActualizarCarta = $this->input->post('ActualizarCarta');

		$this->Mod_CartasPoder->ActualizarCarta();
    $this->db->close();		
	}

	public function Email()
	{
		$session_data = $this->session->userdata('nueva_session');
		$usuario=$session_data['idusuario'];

		$tags_cliente = $this->input->post('tags_cliente');

		$sql_cartas_a_vencer = $this->Mod_CartasPoder->ActualizarCarta();

  	$datos_cartapoder = array();
    foreach($sql_cartas_a_vencer as $row => $value)
    {
			$get_vigencia = $value->DIAS_VIGENCIA;
			$get_nit = $value->NIT;
			$get_razon_social = $value->RAZON_SOCIAL;
			$get_nit_agente = $value->NIT_AGENTE;
			$get_razon_social_agente = $value->RAZON_SOCIAL_AGENTE;
			$get_linea = $value->LINEA;
			$get_fec_inicio = $value->FECHA_INICIO;
			//$get_fec_inicio1 = date("d-m-Y", strtotime($get_fec_inicio);
			$get_fec_fin = $value->FECHA_FIN;

		  if($get_vigencia == 5 || $get_vigencia == 15 || $get_vigencia == 30)
		  {

				$mail = new phpmailer(); 
		    $mail->PluginDir = ""; 
		    $mail->Mailer = "smtp"; 
		    $mail->Host = "10.10.100.251"; 
		    $mail->SMTPAuth = true; 
		    $mail->Username = "gersafe@docli.gerleinco.co"; 
		    $mail->Password = "gersafe26"; 
		    $mail->From = "gersafe@docli.gerleinco.co"; 
		    $mail->FromName = "Carta Autorizacion"; 
		    $mail->Timeout=30; 
		    $mail->AddAddress('stiven.guzman@gerleinco.com');
		    // $mail->AddAddress('stella.martinez@gerleinco.com');  
		    //$mail->AddAddress('helpdesk@gerlein.com.co');  
		         
		    //$mail->AddAddress("javier.posada@gerleinco.com");        
		    $mail->Subject = 'Vencimiento Carta Autorizacion Consignatario: ('.$get_nit.') '.$get_razon_social; 

				$cuerpo='
				<section class="container sombra">
					<div class="panel panel-primary">
						<div class="panel-heading"><span class="glyphicon glyphicon-upload"></span></div>

							<div class="panel-body">
				        <div class="row">
				          <div class="col-lg-9">
				            <p><strong>Apreciado Cliente: </strong><br><br>Le informamos  que la carta de autorizacion de retiro de Bl Original inscrito con la agencia de Aduanas ('.$get_razon_social_agente.') desde el dia '.$get_fec_inicio.' hasta '.$get_fec_fin.' le quedan '.$get_vigencia.' dias por vencer.</p>
				        	</div>
				        	<br>
								
								<table class="table table-striped table-bordered table-condensed">
									<tr>
										<td align="center"><strong> Agradecemos acercarse a cualquier oficina de Gerlein y actualizar los datos.<br><br></strong></td>
									</tr>								
  							</table>
								</div>	
							</div>
					</div>
				</section>';

		    $mail->Body = $cuerpo; 
		    $mail->AltBody = $cuerpo; 
		  	$exito = $mail->Send(); 
		    $intentos=1;

        while ((!$exito) && ($intentos < 5))
        { 
          sleep(5); 
          echo $mail->ErrorInfo; 
          $exito = $mail->Send(); 
          $intentos=$intentos+1;   
        }
			}
		}
    $this->db->close();			
	}	
}