function login_carta()
{
	var usuario=document.getElementById('usuario').value;
	var password=document.getElementById('password').value;	

	if(usuario != '' && password != '')
	{
		$.post(baseurl+'Con_login/login', {'usuario':usuario, 'password':password},
		function(data)
		{      
		  $('#crear_clnte').html(data);            
		});				
	}
	else
	{
		alert("El campo Usuario y Password no pueden ser nulos.");  
		return false;
	}
}


function actualizar_usuario()
{
	var id_usuario=document.getElementById('id_usuario').value;
	var password=document.getElementById('password').value;	
	var passw=document.getElementById('passw').value;

	if(id_usuario != 0)
	{
		if(passw != 0)
		{
			if(password != 0)
			{
				if(passw == password)
				{
		    	 $.post(baseurl+'con_usuario/actualizar_usuario', {'id_usuario':id_usuario, 'password':password},
					function(data)
					{      
				        $('#crear_clnte').html(data);            
				    });				
				}
				else
				{
					alert("Las contraseñas no coinciden, verifique. "); 
				}					
			}
			else
			{
				alert("El campo Repetir Password no puede ser nulo.");
			}
		}
		else
			alert("El campo Password no puede ser nulo.");
	}
	else
	{
		alert("El campo Usuario no puede ser nulo.");
	}
}

function perfil_usuario()
{
	var id_usuario = document.getElementById('id_usuario').value;
	var id_perfil = document.getElementById('id_perfil').value;

	if(id_usuario != 0)
	{
		if(id_perfil != -1)
		{
			 $.post(baseurl+'con_usuario_perf/perfil_usuario', {'id_usuario':id_usuario, 'id_perfil':id_perfil},
				function(data)
				{      
			        $('#crear_clnte').html(data);
			    });				
			}else{ alert("El campo perfil es obligatorio.");  return false; }
	}else{ alert("El campo usuario es obligatorio.");  return false; }
}
