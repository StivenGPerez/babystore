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
            <div class="panel-heading"> <span class="glyphicon glyphicon-globe"></span> <strong>REGISTRO CARTAS PODER GERLEINCO S.A.</strong> </div>
              <div id="cartapoder">

              <!-- <form action="<?php echo base_url(); ?>con_cartaspoder/do_upload/?idcarta=<?php if (isset($id_carta[0]->ID)) echo $id_carta[0]->ID; ?>" method="post" name="frm_cartapoder" id="frm_cartapoder" enctype="multipart/form-data"> -->
              <form action="" id="frm_cartapoder" name="frm_cartapoder"> 
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                  <tr align="left">
                    <th>Consignatario: </th>
                    <td colspan="2">
                      <div class="ui-widget">
                        <input id="tags_cliente" class="form-control input" onkeypress="BuscarCliente(this);">
                        <input type="hidden" id="tags_nit_cliente" class="form-control input">                          
                      </div>
                    </td> 

                    <th>Agente: </th> 
                    <td colspan="2">
                      <div class="ui-widget">
                        <input id="tags_agente" class="form-control input" onkeypress="BuscarAgente(this);">
                        <input type="hidden" id="tags_nit_agente" class="form-control input">                          
                      </div>
                    </td> 
                  </tr>
                  <tr>
                    <td><label for="">Linea:</label></td>
                    <td>
                    <?php   
                      $session_data = $this->session->userdata('nueva_session');
                      $linea=$session_data['linea'];
                    ?>
                      <select id="carta_linea" class="chosen-select" style='width:100px;' disabled>
                        <?php echo "<option value=".$linea." selected>".$linea." </option>"; ?>
                      </select>               
                    </td>                      
                    <td colspan="4">
                      <input type="checkbox" name='carta_sucur_bog' value="COBOG"> <label for="">Bogotá </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name='carta_sucur_clo' value="COCLO"> <label for="">Cali </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name='carta_sucur_med' value="COMDE"> <label for="">Medellin </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name='carta_sucur_ctg' value="COCTG"> <label for="">Cartagena </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name='carta_sucur_bun' value="COBUN"> <label for="">Buenaventura </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name='carta_sucur_bqa' value="COBQA"> <label for="">Barranquilla </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="checkbox" name='carta_sucur_srm' value="COSMR"> <label for="">Santa Marta </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>                          
                  </tr>  
                  <tr align="left">
                    <td><label for="">Inicio Vigencia:</label></td><td><input type="date" class="form-control input" id="carta_fec_ini"></td>
                    <td><label for="">Días Vigencia:</label></td><td><input type="text" class="form-control input" id="carta_dias_vig" style="width:100px" onchange="return CalcFecha();"></td>
                    <td><label for="">Fin Vigencia:</label></td><td><input type="text" class="form-control input" id="carta_fec_fin"></td>
                  </tr>
                  <tr>
                    <td><label for="">Email: </label></td><td><input type="text" class="form-control input" id="email"></td> 
                    <td><label for="">Observaciones:</label></td><td colspan="3"><input type="text" class="form-control input" id="carta_obs"></td> 
                  </tr>  
                  <tr align="left">
                    <th>Poder: </th>
                    <td colspan="5"><input type="file" id="poder"/></td> 
                  </tr>
                  <tr align="left">
                    <th>Autorización: </th>
                    <td colspan="5"><input type="file" id="autorizacion"/></td> 
                  </tr>
                  <tr align="left">    
                    <td colspan="6">                  
                      <input type="button" id="subir" value="Guardar" class="btn btn-info btn-sm"><br/>
                    </td>
                  </tr>                    
                </table> 
                <br>
              </div> 
            </form> 
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
} else {
  echo "<script> location.href=".$baseurl."'; </script>";
} ?>

