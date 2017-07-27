<div class="login">	
  <form action="<?php echo base_url(); ?>Con_Login/Login" method="post" role="form">

	  <table class="table">
	  	<tr><td colspan="2" align="center"><a href="#"><img src="<?php echo base_url(); ?>/img/gersafe_logo_horizontal.png" width='380' height='240' class="img-responsive"></a></td></tr>
	    <tr>
	    	<td><label for="">Usuario:</label></td>
	    	<td>
	    		<div class="input-group">
				  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
				  <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Identificación" onchange="ValidarLinea();">
				  <span class="input-group-addon"><abbr title="El usuario es su numero de identificación"><span class="glyphicon glyphicon-question-sign"></span></abbr></span>
				</div>
	    	</td>
	    </tr>
	    <tr>
	    	<td><label for="">Password:</label></td>
	    	<td>
	    		<div class="input-group">
				  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
				  <input type="password" class="form-control" name="password" id="password" placeholder="********">
				</div>
	    	</td>
	    </tr>
			<tr>
	    	<td><label for="">Linea:</label></td>
	     	<td>
					<div id="linea">
						<select id='linea_usu' name='linea_usu' class='form-control' required="required" >
						<option value="-1" selected="selected">Seleccione Linea</option>
						</select>
					</div>
				</td>
			</tr>
	    <tr>
	    	<td colspan="2" align="center">
	    	<input type="submit" class="btn btn-primary" value="Ingresar">
	    	</td>
	    </tr>
	  	<tr>
	    	<td colspan="2">
	    		<a href="<?php echo base_url(); ?>Con_Usuario">¿Olvido su contraseña?</a>
	    	</td>			  		
	  	</tr>		
	  </table>

	  <table>
	  	<tr>
	    	<td align="center">
	    		<H6><label for="">Copyright © 2017 <a href="#">Gersafe 2.0.</a></label> Todos los derechos reservados.</H6>
	    	</td>			  		
	  	</tr>
	  </table>
	</form>
</div> 

