<?php if (isset($buscar_cartaspoder)) { ?>
  <div class="scroll">
    <div class="table-responsive">
      <table class="table table-striped">            
        <tr>
          <th></th>
          <th>Poder</th>
          <th>Autorización</th>
          <th>Dias Vigencia</th>                            
          <th>Nit Cliente</th>                
          <th>Nombre Cliente</th>               
          <th>Nit Agente</th>
          <th>Agente Aduana</th>
          <th>Inicio Vigencia</th>
          <th>Fin Vigencia</th> 
          <th>Estado</th> 
          <th>Observaciones</th> 
          <th>Pdf Camara</th> 
        </tr>
        
      <?php 
        $base = base_url();
        foreach ($buscar_cartaspoder as $key => $value)
        {
          echo "<tr id='".$value->ID_CARTAPODER."'>";
            echo "<td>";
            echo "<a id='myLink' href='javascript:ConsultaCartapoder(".$value->ID_CARTAPODER.");'><i class='glyphicon glyphicon-pencil'></i></a> "; 
            echo "</td>";

            $archivopdf = $value->RUTAPDF_OPEN;                  
              if(file_exists($archivopdf)) { echo "<td><a href='".$value->RUTAPDF."' target='_blank'><img src='".$base."/img/adobe_reader.png' width='35' height='35'></a></td>"; } 
              else { echo "<td> </td>"; }
            
            $autopdf = $value->PDF_AUTO_OPEN;
              if(file_exists($autopdf)) { echo "<td><a href='".$value->PDF_AUTO."' target='_blank'><img src='".$base."/img/adobe_reader.png' width='35' height='35'></a></td>"; }
              else { echo "<td> </td>"; } 

            echo "<td>".$value->DIAS."</td>";                                            
            echo "<td>".$value->NIT."</td>";
            echo "<td style='width:450px;'>".$value->RAZON_SOCIAL."</td>";
            echo "<td width=600>".$value->NIT_AGENTE."</td>";
            echo "<td width='370%'>".$value->NOMBRE_AGENTE."</td>";
            echo "<td height:50px;>".$value->FECHA_INICIO."</td>";
            echo "<td>".$value->FECHA_FIN."</td>";
            echo "<td>".$value->ESTADO."</td>";
            echo "<td>".$value->OBSERVACIONES."</td>";
            echo "<td> </td>";          
          echo "</tr>";  
        } 
      ?> 
      </table>
    </div>
  </div>
<?php } ?>  
