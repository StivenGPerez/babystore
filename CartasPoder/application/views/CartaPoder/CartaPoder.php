<?php 
  $baseurl = base_url();
  if($this->session->userdata('nueva_session')){
    $session_data = $this->session->userdata('nueva_session');
?>
	<div class="container">
	  <div class="row">



	    <div class="col-lg-12">
	      <section class="container sombra">
	        <div class="panel panel-primary"> 

						<div class="panel-heading"><span class="glyphicon glyphicon-upload"></span> <strong>Consulta Carta Autorizacion</strong></div>
							<div class="panel-body">
			          <div><p><strong>En este módulo se asociaran las cartas de autorizacion por cliente y sucursal.</strong></p></div>
									<form action="<?php echo base_url(); ?>Con_Cartaspoder\CrearCartaspoderIni" method="post" name="frm_cartapoder" id="frm_cartapoder">
										<table class="table table-striped table-bordered table-condensed">
											<tr>
	                      <th>Consignatario: </th>
	                      <td colspan="2">
	                        <div class="ui-widget">
	                          <input id="tags_cliente" class="form-control input" onkeypress="BuscarCliente(this);">
	                          <input type="hidden" id="tags_nit_cliente" class="form-control input">                          
	                        </div>
	                      </td> 										
											
												<th><label for="">Linea:</label></th>
												<td>
												<?php 	
													$session_data = $this->session->userdata('nueva_session');
													$linea=$session_data['linea'];
												?>
													<select id="carta_linea" class="chosen-select" style='width:100px;' disabled>
														<?php echo "<option value=".$linea." selected>".$linea." </option>"; ?>
													</select>								
												</td>	
												<th><label for="">Estado:</label></th>
												<td>
														<select id="carta_estado" class="chosen-select">
															<option value="-1">Seleccione Estado </option>
															<option value="A" selected>VIGENTE</option>
															<option value="I">VENCIDO</option>																												
														</select>								
												</td>	
											</tr>
											<tr>
	                      <th>Agente: </th>
	                      <td colspan="2">
	                        <div class="ui-widget">
	                          <input id="tags_agente" class="form-control input" onkeypress="BuscarAgente(this);">
	                          <input type="hidden" id="tags_nit_agente" class="form-control input">                          
	                        </div>
	                      </td> 

												<th><label for="">Sucursal:</label></th>
												<td>
														<select id="carta_sucursal" class="chosen-select">
													    <option value="-1" selected>Todas</option>
													    <option value="COBOG">Bogotá</option>
													    <option value="COCTG">Cartagena</option>
													    <option value="COBUN">Buenaventura</option>
													    <option value="COMDE">Medellín</option>
													    <option value="COCLO">Cali</option>
													    <option value="COSMR">Santamarta</option>
													    <option value="COBAQ">Barranquilla</option>																											
														</select>								
												</td>	
												<td align="right" colspan="9">
													<button class="btn btn-primary active" type="button" onclick="BuscarCartaspoder();">Buscar</button>
													<button class="btn btn-primary active" type="submit">Insertar</button>
													<button class="btn btn-primary active" type="button" onclick="Email();">Envio Email</button>
												</td>	
											</tr>
										</table>
									</form>

								<div class="row">
									<div class="loader" id="loader" style="display:none;"></div>
									<div class="col-lg-12" id="cartapoder"></div>
								</div>		
							</div>

							<div class="panel-footer">
								<button type="button" class="btn btn-info btn-sm text-uppercase btn-block" onclick="javascript:VolverCartapoder();"><i class="glyphicon glyphicon-chevron-left"></i>Volver</button>		
							</div>
	 					</div> 
				</section> 
			</div> 
		</div> 
	</div>
 <?php
  }
  else
  {
    echo "<script> location.href=".$baseurl."'; </script>";
  } ?>