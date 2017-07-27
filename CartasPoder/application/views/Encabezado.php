<?php 
  $baseurl = base_url();
  if($this->session->userdata('nueva_session')){
    $session_data = $this->session->userdata('nueva_session');
?>
	<nav class="navbar navbar-default"> 
		<div class="container-fluid"> 

		    <ul class="nav navbar-nav navbar-left">
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="glyphicon glyphicon-user"></span> 
                <strong><?php  echo ucwords($session_data['nombre']);?></strong>
		        	<span class="caret"></span>
		        </a>

		        <ul class="dropdown-menu">
		          <li>
		            <div class="navbar-login ancho_usuario">
                  <p class="text-center"><span class="glyphicon glyphicon-user icon-size"></span></p>
                  <p class="text-center"><strong><?php  echo ucwords($session_data['nombre']); ?></strong></p>
		            </div>
		          </li>
		            
		          <li class="divider"></li>
		            <li>
		              <div class="navbar-login navbar-login-session" align="center">
					    <p><a href="<?php echo base_url(); ?>Con_Login/Logout" class="btn btn-danger">Cerrar Sesion</a></p>
		              </div>
		            </li>
		        </ul>
		      </li>
		    </ul>

	    <div class="navbar-header navbar-right">
	      <a href="#"><img src="<?php echo base_url(); ?>/img/gersafe_logo_horizontal.png" width='320' height='200' class="img-responsive"></a>
	    </div>		
		</div>
	</nav> 
<?php }
  else
  {
    echo "<script> location.href=".$baseurl."'; </script>";
  } ?>  