<?php 
    $session_data = $this->session->userdata('nueva_session');
    $perfil=$session_data['perfil'];

if(isset($perfil))
{
  if($perfil != 1 )
  {
    echo "<script> 		

	    	if(confirm('la sesión caduco o Usted no tiene permisos para acceder a este modulo.'))
			{
				location.href='http://192.168.201.26/gerleinco_mensajeria';
			}
			else
			{
				location.href='http://192.168.201.26/gerleinco_mensajeria';				
			}
		  </script>";   
  }
  else
  {
?>  
	<section>
		<div id="crear_clnte">
			<div class="container centering">

				<div class="row">
					<div class="col-lg-12"> <img src="<?php echo base_url(); ?>img/logo_mensajeria.png" alt="bannersig" width="300" height="180" class="center-block"></div>
				</div>
				</br>

				<div class="row sombra login center-block">
					<div class="panel panel-success">

			            <div class="panel panel-primary">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			                <div class="panel-heading"><h4><i class="glyphicon glyphicon-refresh"></i> Actualización de Perfil </h4></div>
			            </div>

					  <table class="table">
					    <tr>
					    	<td align="right"><label for="">Usuario:</label></td>
					    	<td>
					    		<div class="input-group">
								  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
								  <input type="text" class="form-control" id="id_usuario" placeholder="Numero Identificación">
								</div>
					    	</td>
					    </tr>	
					    <tr>
					    <td align="right"><label for="">Perfil:</label></td>
					    	<td>
								<select id="id_perfil" class="chosen-select">
									<option value="-1">Seleccione una Opción</option>
									<option value="1">ADMINISTRADOR</option>
									<option value="2">GERENTE</option>
									<option value="3">USUARIO</option>
									<option value="4">MENSAJERO</option>
								</select>	
					    	</td>
					    </tr>
					    <tr>	
					  </table>

			            <div class="modal-footer" align="center">
			                <button type="button" class="btn btn-fresh pull-right text-uppercase btn-sm" data-dismiss="modal" onclick="perfil_usuario();">
								Actualizar 
								<i class="glyphicon glyphicon-refresh"></i>
							</button>
								
								<a href="#" onclick="javascript:volver_mensajeria();">
							    	<span class='pull-right btn btn-primary btn-sm'><i class="glyphicon glyphicon-chevron-left"></i><strong>Volver</strong></span>
							    </a>						
			            </div>			  
					</div>
				</div>
			</div>
		</div>	
	</section>
<?php } 
}
else
{
    echo "<script> location.href='http://192.168.201.26/gerleinco_mensajeria'; </script>"; 	
} ?>