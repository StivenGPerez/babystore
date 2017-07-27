<?php 
  $baseurl = base_url();
  if($this->session->userdata('nueva_session')){
    $session_data = $this->session->userdata('nueva_session');
?>
<form action="" id="frm_cartapoder_modif" name="frm_cartapoder_modif"> 
  <div class="table-responsive">
    <input type="text" id="id_carta_ajax" class="hide" value='<?php echo $carta_poder_modf[0]->ID_CARTAPODER; ?>' size="">
    <table class="table table-striped table-bordered table-condensed">
      <tr align="left">
        <th>Consignatario: </th>
        <td colspan="2">
          <div class="ui-widget">
            <?php if(isset($carta_poder_modf[0]->NIT)) echo "<input id='tags_cliente_ajax1' class='form-control input' value='(".$carta_poder_modf[0]->NIT.") ".$carta_poder_modf[0]->RAZON_SOCIAL."' disabled>"; ?>     <input type="text" id="tags_cliente_ajax" class="hide" value='<?php echo $carta_poder_modf[0]->NIT; ?>'>                     
          </div>
        </td> 
        <th>Agente: </th> 
        <td colspan="2">
          <div class="ui-widget">
            <?php if (isset($carta_poder_modf[0]->NIT_AGENTE)) echo "<input id='tags_agente_ajax1' class='form-control input' value='(".$carta_poder_modf[0]->NIT_AGENTE.") ".$carta_poder_modf[0]->AGENTE."' disabled>";  ?>  <input type="text" id="tags_agente_ajax" class="hide" value='<?php echo $carta_poder_modf[0]->NIT_AGENTE; ?>'>                                                                
          </div>
        </td> 
      </tr>
      <tr>
        <td><label for="">Linea:</label></td>
        <td> <?php
              echo "<input type='text' class='form-control input' id='carta_linea_ajax' value='".$carta_poder_modf[0]->LINEA."' disabled>"; ?>
        </td>
        <td colspan="4">
          <?php if ($carta_poder_modf[0]->SUCBOG == 'COBOG') echo "<input type='checkbox' name='carta_sucur_bog_ajax' value='COBOG' checked>";  
                else echo "<input type='checkbox' name='carta_sucur_bog_ajax' value='COBOG'>"; ?><label for="">Bogotá </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php if ($carta_poder_modf[0]->SUCCLO == 'COCLO') echo "<input type='checkbox' name='carta_sucur_clo_ajax' value='COCLO' checked>";  
                else echo "<input type='checkbox' name='carta_sucur_clo_ajax' value='COCLO'>"; ?><label for="">Cali </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php if ($carta_poder_modf[0]->SUCMDE == 'COMDE') echo "<input type='checkbox' name='carta_sucur_med_ajax' value='COMDE' checked>";  
                else echo "<input type='checkbox' name='carta_sucur_med_ajax' value='COMDE'>"; ?><label for="">Medellin </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php if ($carta_poder_modf[0]->SUCCTG == 'COCTG') echo "<input type='checkbox' name='carta_sucur_ctg_ajax' value='COCTG' checked>";  
                else echo "<input type='checkbox' name='carta_sucur_ctg_ajax' value='COCTG'>"; ?><label for="">Cartagena </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php if ($carta_poder_modf[0]->SUCBUN == 'COBUN') echo "<input type='checkbox' name='carta_sucur_bun_ajax' value='COBUN' checked>";  
                else echo "<input type='checkbox' name='carta_sucur_bun_ajax' value='COBUN'>"; ?><label for="">Buenaventura </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php if ($carta_poder_modf[0]->SUCBQA == 'COBAQ') echo "<input type='checkbox' name='carta_sucur_bqa_ajax' value='COBAQ' checked>";  
                else echo "<input type='checkbox' name='carta_sucur_bqa_ajax' value='COBAQ'>"; ?><label for="">Barranquilla </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php if ($carta_poder_modf[0]->SUCSMR == 'COSMR') echo "<input type='checkbox' name='carta_sucur_srm_ajax' value='COSMR' checked>";  
                else echo "<input type='checkbox' name='carta_sucur_srm_ajax' value='COSMR'>"; ?><label for="">Santa Marta </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>                          
      </tr>  
      <tr align="left">
        <td><label for="">Inicio Vigencia:</label></td>
        <td> <?php if (isset($carta_poder_modf[0]->FECHA_INICIO)) echo "<input type='text' class='form-control input' id='carta_fec_ini_ajax' value='".$carta_poder_modf[0]->FECHA_INICIO."'>";  
                else echo "<input type='date' class='form-control input' id='carta_fec_ini_ajax'>"; ?>
        </td>
        <td><label for="">Días Vigencia:</label></td>
        <td> <?php if (isset($carta_poder_modf[0]->DIAS_VIGEN)) 
        echo "<input type='text' class='form-control input' id='carta_dias_vig_ajax' value='".$carta_poder_modf[0]->DIAS_VIGEN."' style='width:100px' onchange='return CalcFechaModf();'>";  
                else echo "<input type='date' class='form-control input' id='carta_dias_vig_ajax'>"; ?>
        </td>        
        <td><label for="">Fin Vigencia</label></td><!-- <td><input type="text" class="form-control input" id="carta_fec_fin"></td> -->
        <td> <?php if (isset($carta_poder_modf[0]->FECHA_FIN)) echo "<input type='text' class='form-control input' id='carta_fec_fin_ajax' value='".$carta_poder_modf[0]->FECHA_FIN."'>";  
                else echo "<input type='date' class='form-control input' id='carta_fec_fin_ajax'>"; ?>
        </td>

      </tr>
      <tr>
        <td><label for="">Email: </label></td>
        <td>
          <?php if (isset($carta_poder_modf[0]->EMAIL)) echo "<input type='text' class='form-control input' id='email_ajax' value='".$carta_poder_modf[0]->EMAIL."'>";  
                else echo "<input type='text' class='form-control input' id='email_ajax'>"; ?>
        </td> 
        <td><label for="">Observaciones:</label></td><td colspan="3">
          <?php if (isset($carta_poder_modf[0]->OBSERVACIONES)) echo "<input type='text' class='form-control input' id='carta_obs_ajax' value='".$carta_poder_modf[0]->OBSERVACIONES."'>";  
                else echo "<input type='text' class='form-control input' id='carta_obs_ajax'>"; ?>
        </td> 
      </tr>  
      <tr align="left">
        <th>Estado: </th>
        <td>
          <select id="carta_estado_ajax" class="chosen-select" onchange="ModificarDias();">
            <?php 
              if ($carta_poder_modf[0]->ESTADO == 'VIGENTE') { 
                echo "<option value='A' selected>VIGENTE </option>"; 
                echo "<option value='I'>VENCIDO </option>"; }
              else {
                echo "<option value='I' selected>VENCIDO </option>"; 
                echo "<option value='A'>VIGENTE </option>"; } ?>
          </select> 
        </td>         
      </tr>
      <tr align="left">    
        <td colspan="6"> 
          <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" onclick="ModificarCartaspoder();Refresh();">ACTUALIZAR <i class="glyphicon glyphicon-refresh"></i></button>                
        </td>
      </tr>                    
    </table> 
    <br>
  </div> 
</form> 
<?php
} else {
  echo "<script> location.href=".$baseurl."'; </script>";
} ?>