var validateField = new ValidateField();
validator = function (form){
 var element =  form.elements;
 for ( var i = 0; i < element.length; i ++ ) {
     var validates = element[i].getAttribute ('validate');
	 if ( validates != null ){
		 validates = eval(validates);
		 for ( var j = 0; j < validates.length; j ++ ){ 
          if(!validate(element[i],validates[j]))
			 return false;
		 }
	 } 
 }
 return true;
}
	
validatorform = function (form){
   var validates = form.getAttribute ('validate') ;
   if ( validates != null ){
		 validates = eval(validates);
		 for ( var j = 0; j < validates.length; j ++ ){ 
		        switch(validates[j].type){
					case CHECKED.type:
					   if(!getMessageChecked(form,validates[j])){
						  alert(CHECKED.message); 
						  return false;
						}
					break;
				}
		 }
	}
  return true;
}

validate = function ( element, metadata ) {
	
	switch (metadata.type) {
		
		case validateField.REQUIRED.type:
				if ( validateField.empty(element.value) )
					return getMessage(element,validateField.REQUIRED);
		break;
		
		case validateField.EMAIL.type:
				if ( !validateField.empty(element.value)  && !validateField.email (element.value) )
				    return getMessage(element,validateField.EMAIL);
		break;
		2
		case validateField.STRING.type:			
				if ( !validateField.empty(element.value)  && !validateField.string (element.value) )
				    return getMessage(element,validateField.STRING);
		break;
			
		case validateField.INTEGER.type:				
				if ( !validateField.empty(element.value)  && !validateField.integer (element.value) )
				   return getMessage(element,validateField.INTEGER);				   
		break;

		case validateField.FLOAT.type:			
				if ( !validateField.empty(element.value)  && !validateField.float (element.value) )
				    return getMessage(element,validateField.FLOAT);
		break;
			
		case validateField.TIME.type:
				if ( !validateField.empty(element.value)  && !validateField.time(element.value) )
				    return getMessage(element,validateField.TIME);
		break;
		
		case validateField.DATE.type:				
				if ( !validateField.empty(element.value)  && !validateField.date (element.value) )
				    return getMessage(element,validateField.DATE);
		break;
		
		case validateField.DATETIME.type:
				if ( !validateField.empty(element.value)  && !validateField.datetime (element.value) )
				    return getMessage(element,validateField.DATETIME);
		break;
				
		case validateField.MINLENGTH.type:
		  if( element.value.length < Number (metadata.length) )
  			 return getMessage(element,validateField.MINLENGTH);
		break;
		
		case validateField.MAXLENGTH.type:
			if( element.value.length > Number (metadata.length) )
				return getMessage(element,validateField.MAXLENGTH);		
		break;
		
		case validateField.NECESSARY.type:
		     for(var i = 0; i < metadata.necessarys.length ; i++){
                var e =  document.getElementById(metadata.necessarys[i]);  
		        if( ( e == null ) || ( e !=null && !validateField.empty(e.value) ) )
		           return  getMessageNecessary(metadata.necessarys);  	 
			 }
		break;
		
		default:
			alert('Este tipo de validacion '+metadata.type+' no esta implementada...');
		break;
	}
	
 return true;
}

getMessage = function ( element , metadata ){	
    var message = metadata.message;
	message = message.replace ( '<label>',document.getElementById('field_'+element.id).innerHTML);
	switch(metadata.type){
		case validateField.MAXLENGTH.type:
		case validateField.MINLENGTH.type:
		 message = message.replace('<length>',metadata.length);
		break;
		
		case validateField.COMPARE.type:
		message = message.replace('<operacion>',getMessageOperacion(metadata.operacion));
		message = message.replace('<compareto>',metadata.compareto); 
		break;
		
		case validateField.NECESSARY.type:
		message = message.replace('<necessary>',getMessageNecessary(metadata.necessarys));
		break;
		
		case validateField.BETWEEN.type:
		message = message.replace('<mayorque>',metadata.mayorque);
		message = message.replace('<menorque>',metadata.menorque);
		break;
	}
	
	alert(message);
	element.focus();
	return false;
}

getMessageOperacion = function (operacion){
    
	switch(operacion){
	  
	  case '!=':
	   return 'diferente';
	  break;
	  
	  case '==':
	   return 'igual'; 
	  break;
	  
	  case '>':
	  return 'mayor';
	  break;
	  
	  case '>=':
	   return 'mayor o igual'; 
	  break;
	  
	  case '<':
	  return 'menor';
	  break;
	  
	  case '<=':
	   return 'menor o igual'; 
	  break;
	}
	
 return operacion;	
} 

getMessageNecessary = function (necessarys){
	var message = ( necessarys.length > 1 ) ? 'los campos "' : 'el campo "';
	for(var i = 0; i < necessarys.length ; i++){
         var element =  document.getElementById(necessarys[i]);  
		 if(element !=null ){
		   message += document.getElementById('field_'+element.id).innerHTML + ','; 	 
		 }
    }
	message = message.substring(0,message.length - 1);
	return message + '"';
}

getMessageChecked = function (form,validates){
	for ( var k = 0; k < form.elements.length; k ++ ){
          var element = form.elements [ k ];
	      if ( element.type == 'radio' && element.name == validates.name && element.checked )
				return true;
	}
  return false;	
}