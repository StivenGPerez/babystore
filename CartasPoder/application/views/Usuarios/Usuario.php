<section>
<div id="crear_clnte">
	<div class="container centering">

		<div class="row">
			<div class="col-lg-12"> <img src="<?php echo base_url(); ?>img/logo_mensajeria.png" alt="bannersig" width="300" height="180" class="center-block"></div>
		</div>
		</br>

		<div class="row sombra login center-block">
			<div class="panel panel-success">

			  <form action="<?php echo base_url(); ?>con_login/login" method="POST" role="form">

	            <div class="modal-header modal-header-info">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                <h4><i class="glyphicon glyphicon-refresh"></i> Actualización de contraseña </h4>
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
			    <td align="right"><label for="">Password:</label></td>
			    	<td>
			    		<div class="input-group">
						  <span class="input-group-addon"><span class="glyphicon glyphicon-qrcode"></span></span>
						  <input type="password" class="form-control" id="passw" placeholder="********************">
						</div>
			    	</td>
			    </tr>
			    <tr>	
			    <td align="right"><label for="">Repetir Password:</label></td>
			    	<td>
			    		<div class="input-group">
						  <span class="input-group-addon"><span class="glyphicon glyphicon-qrcode"></span></span>
						  <input type="password" class="form-control" id="password" placeholder="********************">
						</div>
			    	</td>			    				    	
			    </tr>

			  </table>
	            <div class="modal-footer" align="center">
	                <button type="button" class="btn btn-fresh pull-right text-uppercase btn-sm" data-dismiss="modal" onclick="actualizar_usuario();">
						Actualizar 
						<i class="glyphicon glyphicon-refresh"></i>
					</button>
						<a href="http://192.168.201.26/gerleinco_mensajeria" onclick="http://192.168.201.26/gerleinco_mensajeria">					
				    	<span class='pull-right btn btn-primary btn-sm'><i class="glyphicon glyphicon-chevron-left"></i><strong>Volver</strong></span>
				    </a>						
	            </div>			  
			  </form>
			</div>
		</div>
	</div>
</div>	
</section>
