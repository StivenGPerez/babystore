setInterval('ActualizarCarta()',86400000);

function ValidarLinea()
{
  var usuario = document.getElementById('usuario').value;
    $.post(baseurl+'Con_CartasPoder/ValidarLinea', {'usuario':usuario}, 
      function(data)
      {
        $('#linea').html(data);
      });
}


function BuscarCliente(obj)
{
  $(obj).autocomplete({
    source: "CargarClienteJquery/",     
    delay: 3,
    minLength: 3,
    select: function( event, ui ) {

      $(tags_cliente).val(ui.item.value);
      $(tags_nit_cliente).val(ui.item.key);

      return false;
    }
  });
}

function BuscarAgente(obj)
{
  $(obj).autocomplete({
    source: "CargarClienteJquery/",     
    delay: 3,
    minLength: 3,
    select: function( event, ui ) {

      $(tags_agente).val(ui.item.value);
      $(tags_nit_agente).val(ui.item.key);

      return false;
    }
  });
}

function BuscarCartaspoder()
{
    var carta_linea = document.getElementById('carta_linea').value;
    var carta_estado = document.getElementById('carta_estado').value;    
    var tags_nit_cliente = document.getElementById('tags_nit_cliente').value;
    var tags_nit_agente = document.getElementById('tags_nit_agente').value;
    var carta_sucursal = document.getElementById('carta_sucursal').value;

    div = document.getElementById('loader');
    div.style.display = '';

    $.post(baseurl+'Con_CartasPoder/BuscarCartaspoder', {'carta_linea': carta_linea, 'carta_estado':carta_estado, 'tags_nit_cliente':tags_nit_cliente, 
                                                          'tags_nit_agente':tags_nit_agente, 'carta_sucursal':carta_sucursal }, 
    function(data)
    {      
      $('#cartapoder').html(data); 

        div = document.getElementById('loader');
        div.style.display = 'none';                 
    });  
}

function ConsultaCartapoder(id)
{
    $.post(baseurl+'Con_CartasPoder/ConsultaCartapoder',{'id_cartapoder': id},

    function(data)
    {   
        $('#cartapoder').html(data);           
    }); 
}

function ModificarDias()
{
  var carta_estado_ajax = document.getElementById('carta_estado_ajax').value;
  var carta_fec_ini_ajax = document.getElementById('carta_fec_ini_ajax').value;

  if(carta_estado_ajax != 'A')
  {
    document.frm_cartapoder_modif.carta_dias_vig_ajax.value = 0;

    var f = new Date();
    fecha = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();    
    document.frm_cartapoder_modif.carta_fec_fin_ajax.value = fecha;
  }
}

function CalcFecha()
{
  var carta_fec_ini = document.getElementById('carta_fec_ini').value;  
  var carta_dias_vig = document.getElementById('carta_dias_vig').value;  
  var fecha = SumaFecha(carta_dias_vig, carta_fec_ini);

  document.frm_cartapoder.carta_fec_fin.value = fecha;  
  document.frm_cartapoder.carta_fec_fin.disabled = true;
}

SumaFecha = function(d, fecha)
{  
  var Fecha = new Date();
  var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
  var sep = '/'; 
  var aFecha = sFecha.split(sep);
  var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
  

  fecha= new Date(fecha);
  fecha.setDate(fecha.getDate()+parseInt(d));
  
  var anno=fecha.getFullYear();
  var mes= fecha.getMonth()+1;
  var dia= fecha.getDate();
  
   mes = (mes < 10) ? ("0" + mes) : mes;
   dia = (dia < 10) ? ("0" + dia) : dia;
  
  var fechaFinal =  dia+'/'+mes+'/'+anno;

  return (fechaFinal);
}

function uploadMultipleFiles( files, nit_cl, nit_ag, cart_linea ){
  var limit = 1048576*2,//2MB
  xhr,
  mensaje = select('p#mensaje');
  
  // if ( cart_linea == 'ML')
  // {
  //   for(var i=0;i<files.length;i++)
  //   {
  //     if( files[i] == undefined )
  //     {
  //       frm_cartapoder.subir.disabled = false;
  //       return false;
  //     }      
  //   }

  //   for(var i=0;i<files.length;i++){
  //     var current_file = files[i];

  //     if( i == 0 ) { nit_cl = 'P_'+nit_cl; } 
  //     else { 
  //           var str = nit_cl;
  //           var nit_cl = str.substr(2);
  //           nit_cl = 'A_'+nit_cl; }

  //     if( current_file.size < limit ){
  //       xhr = new XMLHttpRequest();

  //       xhr.upload.addEventListener('error',function(e){
  //         alert('Ha habido un error cargando el archivo '+(i+1));
  //         return false;
  //       }, false);

  //       xhr.open('POST', baseurl+'Con_CartasPoder/DoUpload/?nit_cl='+nit_cl+'&nit_ag='+nit_ag+'&cart_linea='+cart_linea);
          
  //       xhr.setRequestHeader("Cache-Control", "no-cache");
  //       xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  //       xhr.setRequestHeader("X-File-Name", current_file.name);
  //       xhr.send(current_file);
  //     }else{
  //       alert('El archivo '+(i+1)+' es mayor de 2MB!');
  //       mensaje.innerHTML = 'El archivo '+(i+1)+' es mayor de 2MB!';
  //       return false;
  //     }
  //   }
  // }
  // else
  // {
    if ( cart_linea != '-1')
    {
      if( files[0] != undefined ){

        for(var i=0;i<files.length;i++){
          var current_file = files[i];

          if( i == 0 ) { nit_cl = 'P_'+nit_cl; } 
          else { 
                var str = nit_cl;
                var nit_cl = str.substr(2);
                nit_cl = 'A_'+nit_cl; }

          if( current_file.size < limit ){
            xhr = new XMLHttpRequest();

            xhr.upload.addEventListener('error',function(e){
              alert('Ha habido un error cargando el archivo '+(i+1));
              return false;
            }, false);

              xhr.open('POST', baseurl+'Con_CartasPoder/DoUpload/?nit_cl='+nit_cl+'&nit_ag='+nit_ag+'&cart_linea='+cart_linea);
              
                xhr.setRequestHeader("Cache-Control", "no-cache");
                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                xhr.setRequestHeader("X-File-Name", current_file.name);

                xhr.send(current_file);

                alert("Se ingreso la informacion correctamente.");
                location.href = baseurl+"Con_CartasPoder/CrearCartaspoderIni";
          }else{
            alert('El archivo '+(i+1)+' es mayor de 2MB!');
            mensaje.innerHTML = 'El archivo '+(i+1)+' es mayor de 2MB!';
            return false;
          }
        }
        mensaje.innerHTML = 'Carga completa!';
      }
      else
      {
        return false;
      }
    }
  // }
  alert("Se ingreso la informacion correctamente.");
  location.href = baseurl+"Con_CartasPoder/CrearCartaspoderIni";
}

function select( str ){
  return document.querySelector(str);
}

var upload_button = select('#subir');

upload_button.onclick = function(e){
  e.preventDefault();
  this.disabled = 'true';

  var tags_nit_cliente = select('#tags_nit_cliente').value;
  var tags_nit_agente = select('#tags_nit_agente').value;
  var carta_linea = select('#carta_linea').value;
  var poder = select('#poder').files[0],
  autorizacion = select('#autorizacion').files[0],
  todos_los_archivos = [poder,autorizacion];
  
  CrearCartaspoder();
  uploadMultipleFiles(todos_los_archivos, tags_nit_cliente, tags_nit_agente, carta_linea);
}

function CrearCartaspoder() 
{
  var poder = select('#poder').files[0], autorizacion = select('#autorizacion').files[0];
  var tags_nit_cliente = document.getElementById('tags_nit_cliente').value;
  var tags_nit_agente = document.getElementById('tags_nit_agente').value;
  var carta_linea = document.getElementById('carta_linea').value;
  var carta_fec_ini = document.getElementById('carta_fec_ini').value;
  var carta_fec_fin = document.getElementById('carta_fec_fin').value;
  var carta_dias_vig = document.getElementById('carta_dias_vig').value;
  var carta_obs = document.getElementById('carta_obs').value;
  var email = document.getElementById('email').value;

  if(tags_nit_cliente != '' && tags_nit_agente != '')
  {
    // if(carta_linea == 'ML')
    // {
    //   if( poder != undefined && autorizacion != undefined)
    //   {
    //     if($('input[type=checkbox]:checked').length === 0) 
    //     {
    //       alert("Debe seleccionar al menos una sucursal.");;;
    //       return false;
    //     }
    //     else
    //     { 
    //       if (carta_fec_fin != '')
    //       {
    //         $.post(baseurl+'Con_CartasPoder/CrearCartaspoder', {'tags_nit_cliente':tags_nit_cliente, 'tags_nit_agente':tags_nit_agente, 'carta_linea':carta_linea, 'carta_fec_ini':carta_fec_ini,
    //                                                             'carta_fec_fin':carta_fec_fin, 'carta_dias_vig':carta_dias_vig, 'carta_obs':carta_obs}, 
    //           function(data, status)
    //           {
    //             if(status == 'success')
    //             {
    //               $("input:checkbox:checked").each(function(){
    //                 var sucursal = $(this).val();

    //                 $.post(baseurl+'Con_CartasPoder/CrearDeCartaspoder', {'carta_linea':carta_linea, 'sucursal':sucursal, 'tags_nit_cliente':tags_nit_cliente, 'tags_nit_agente':tags_nit_agente, 'email':email}, 
    //                   function(data)
    //                   {
    //                     $('#cartapoder').html(data);
    //                   });
    //               });
    //             }
    //             $('#cartapoder').html(data);
    //           });
    //       }
    //       else
    //       {
    //         alert('Debe proporcionar una fecha de Inicio y los días de Vigencia.');
    //         return false;         
    //       }
    //     }        
    //   }
    //   else
    //   {
    //     alert('Debe cargar los dos archivos solicitados Poder y Autorizacion para la linea MAERSK');
    //     //location.href = baseurl+"con_cartaspoder/crear_cartaspoder_ini";
    //     return false;  
    //   }
    // }
    // else
    // {
      if(carta_linea != '-1')
      {    
        if( poder != undefined )
        {
          if ($('input[type=checkbox]:checked').length === 0) 
          {
            alert("Debe seleccionar al menos una sucursal.");
            return false;
          }
          else
          { 
            if (carta_fec_fin != '')
            {
              $.post(baseurl+'Con_CartasPoder/CrearCartaspoder', {'tags_nit_cliente':tags_nit_cliente, 'tags_nit_agente':tags_nit_agente, 'carta_linea':carta_linea, 'carta_fec_ini':carta_fec_ini,
                                                                  'carta_fec_fin':carta_fec_fin, 'carta_dias_vig':carta_dias_vig, 'carta_obs':carta_obs}, 
                function(data, status)
                {
                  if(status == 'success')
                  {
                    $("input:checkbox:checked").each(function(){

                      var sucursal = $(this).val();

                      $.post(baseurl+'Con_CartasPoder/CrearDeCartaspoder', {'carta_linea':carta_linea, 'sucursal':sucursal, 'tags_nit_cliente':tags_nit_cliente, 'tags_nit_agente':tags_nit_agente, 'email':email}, 
                        function(data)
                        {
                          $('#cartapoder').html(data);
                        });
                    });
                  }

                  $('#cartapoder').html(data);
                });
            }
            else
            {
              alert('Debe proporcionar una fecha de Inicio y los días de Vigencia.');
              return false;         
            }
          }
        }
        else
        {
          alert('Debe adjuntar un archivo para el campo Poder de tipo pdf.');
          location.href = baseurl+"Con_CartasPoder/CrearCartaspoderIni";
          return false;    
        }
      }
      else
      {
        alert("Debe Seleccional Una Linea");
        location.href = baseurl+"Con_CartasPoder/CrearCartaspoderIni";
      }       
    // }
  }
  else
  {
    alert('Debe proporcionar Cliente y Agente.');
    return false;    
  }  
}

function ModificarCartaspoder() 
{
  var tags_cliente = document.getElementById('tags_cliente_ajax').value;
  var tags_agente = document.getElementById('tags_agente_ajax').value;
  var carta_linea = document.getElementById('carta_linea_ajax').value;
  var carta_fec_ini = document.getElementById('carta_fec_ini_ajax').value;
  var carta_dias_vig = document.getElementById('carta_dias_vig_ajax').value;
  var carta_fec_fin = document.getElementById('carta_fec_fin_ajax').value;
  var carta_obs = document.getElementById('carta_obs_ajax').value;
  var email = document.getElementById('email_ajax').value;
  var id_carta = document.getElementById('id_carta_ajax').value;
  var carta_estado = document.getElementById('carta_estado_ajax').value;

  if($('input[type=checkbox]:checked').length === 0) 
  {
    alert("Debe seleccionar al menos una sucursal.");
    return false;
  }
  else
  { 
    if (carta_fec_fin != '')
    {
      $.post(baseurl+'Con_CartasPoder/ModificarCartaspoder', {'tags_cliente':tags_cliente, 'tags_agente':tags_agente, 'carta_linea':carta_linea, 'carta_fec_ini':carta_fec_ini,
                                                          'carta_fec_fin':carta_fec_fin, 'carta_dias_vig':carta_dias_vig, 'carta_obs':carta_obs, 'id_carta':id_carta, 'carta_estado':carta_estado}, 
        function(data, status)
        {
          if(status == 'success')
          {
            $("input:checkbox:checked").each(function(){
              var sucursal = $(this).val();

              $.post(baseurl+'Con_CartasPoder/ModifDeCartaspoder', {'carta_linea':carta_linea, 'sucursal':sucursal, 'tags_cliente':tags_cliente, 'tags_agente':tags_agente, 'email':email, 'id_carta':id_carta}, 
                function(data)
                {
                  $('#cartapoder').html(data);
                });
            });            
          }
          $('#cartapoder').html(data);
        });
      alert("Se ingreso la informacion correctamente.");
    }
    else
    {
      alert('Debe proporcionar una fecha de Inicio y los días de Vigencia.');
      return false;         
    }
  }  
}

function CalcFechaModf()
{
  var carta_fec_ini_ajax = document.getElementById('carta_fec_ini_ajax').value;  
  var carta_dias_vig_ajax = document.getElementById('carta_dias_vig_ajax').value;  
  var fecha = SumaFecha(carta_dias_vig_ajax, carta_fec_ini_ajax);
 
  document.frm_cartapoder_modif.carta_fec_fin_ajax.value = fecha;  
  document.frm_cartapoder_modif.carta_fec_fin_ajax.disabled = true;
}

function ActualizarCarta()
{
  var ActualizarCarta = document.getElementById('ActualizarCarta');

  $.post(baseurl+'Con_CartasPoder/ActualizarCarta', {'ActualizarCarta':ActualizarCarta}, 
    function(data)
    {
      $('#cartapoder').html(data);
    });
  //Email();
}

function Email()
{
  var tags_cliente = 80252432;

  // var tags_cliente = document.getElementById('tags_nit_cliente').value;
  // var tags_agente = document.getElementById('tags_nit_agente').value;
  // var carta_linea = document.getElementById('carta_linea').value;
  // var carta_fec_ini = document.getElementById('carta_fec_ini').value;
  // var carta_fec_fin = document.getElementById('carta_fec_fin').value;
  // var carta_dias_vig = document.getElementById('carta_dias_vig').value;

  // if(carta_dias_vig == 5 || carta_dias_vig == 15 || carta_dias_vig == 30)
  // {
    $.post(baseurl+'Con_CartasPoder/Email', {'tags_cliente':tags_cliente}, 
      function(data)
      {
        $('#cartapoder').html(data);
      });    
  // }  
}

