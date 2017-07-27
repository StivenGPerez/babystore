ValidateField = function (){
	
	var scope = this;

	this.empty  = function (field) {
			 if ( field == '' || field == null || typeof field == 'undefined' )
				return true ;
			 var con=0;	
			 for ( var i = 0; i < field.length; i ++ ) {
				   var c= field.charAt ( i ) ;
				   if ( c == ' ' || c=='\t' || c=='\n' || c=='\r' ) 
					 con++;
			 }
		return (con==field.length) ? true : false;
	}
	
	this.required = function(field){
			   return scope.REQUIRED.RegExp.test(field);
	}
	
	this.string = function ( field ){
			 return scope.STRING.RegExp.test ( field );
	}
	
	this.integer = function ( field ) {
			 return scope.INTEGER.RegExp.test(field);
	}

	this.float = function ( field ) {
			  return scope.FLOAT.RegExp.test(field);
	}
	
	this.time = function ( field ){
		   return scope.TIME.RegExp.exec ( field ) ? true: false;
	}
	
	this.date = function ( field ) {
	
		  if(scope.DATE.RegExp.exec ( field )){
			  var vector = field.split ('-');
			  var dia = Number(vector[2]);
			  var mes = Number(vector[1]);
			  var ano = Number(vector[0]);
			  var ndia = ( ( mes % 2 == 0 && mes > 7 ) || ( mes % 2 != 0 && mes <= 7) ) ? 31 : 30;
			  var diaviciesto = ( ano%4 ==0 ) ? 29 : 28;
			  return ( ( mes == 2  && dia > diaviciesto )  || ( dia > ndia ) ) ? false: true;
		   }
		   
		return  false ;
	}
	
	this.datetime = function ( field ) {
			   return scope.DATETIME.RegExp.exec ( field ) ? true: false ;
	}
	
	this.email = function (field){
			return scope.EMAIL.RegExp.test( field );
	}
	
	this.url = function (field){
		  return scope.URL.RegExp.test(field);
	}
	
	this.ip = function (field){
		 return scope.IP.RegExp.test(field);	
	}
	
	this.ConvertNumber = function ( field , separador ) {
		var vector = field.split ( separador ) ;
		var cadena = new String();
		for(var i= 0 ; i < vector.length ; i++ )
		 cadena = cadena + vector[i];
		return Number(cadena);
	}
	
	this.compareto = function (validates,value,type){
	 if(validates.compare != null){
	   var compareto = ( (compareto=document.getElementById(validates.compareto)) ==null ) ? validates.compareto : compareto.value;
		return eval( compareto + ' '+validates.operacion+' '+value );    
	   }
	   return true;	
	}
	
	this.between = function (validates,value){
		if ( validates.between != null ){
			var mayor = ( (mayor=document.getElementById(validates.mayorque)) ==null ) ? validates.mayorque : mayor.value ;
			var menor = ( (mayor=document.getElementById(validates.menorque)) ==null ) ? validates.menorque : menor.value ;
			if(  value < Number (mayor) && value > Number (menor) )  
				return true; 
		}
	  return false;
	}

	//************   TIPOS DE VALIDACIONES ******************//
	this.CHECKED = {
		type:'checked',
		example:'{type:"checked",name:"radiobutton"}',
		message:'Debe Seleccionar un Registro de la Lista'};
	
	this.MAXLENGTH = {
		type:'maxlength',
		example:'{type:"maxlength",length:20}',
		message:'El campo "<label>" supera el numero máximo de caracteres permitidos "<length>".'};
	
	this.MINLENGTH = {
		type:'minlength',
		example:'{type:"maxlength",length:10}',
		message:'El campo "<label>" debe tener por lo minimo "<length>" caracteres'};
	
	this.NECESSARY = {
		type:'necessary',
		example:  '{type:"necessary",necessarys:["minutos","segundos"]},{type:"necessary",necessarys:["grados","segundos"]}',
		message : 'Es necesario registar "<necessary>" para validar el campo "<label>" '};
		
	this.COMPARE = {
		type:'compare',
		example: '{type:"string",compare:{id="true",operacion"==",compareto:"casa",message:"ojo"}},'+
				  '{type:"date",compare:{id="false",operacion:"!=",compareto:"2001-12-12",message:"aja"}}',
		message : 'El campo "<label>" debe ser "<operacion>" que "<compareto>" '};
	
	this.BETWEEN = {
		type:'between',
		example:'{type:"date",between:{mayorque:"2001-12-12",menorque:"2001-11-13"}},{type:"integer",between:{mayorque:2,menorque:4}}',
		message:'El campo "<label>" debe estar entre valores de "<mayorque>" y  "<menorque>" '};	
	
	//************  EXPRESIONES REGULARES   ***************//
	this.REQUIRED = {
		type:'required',
		example: '{type:"required"}',
		RegExp:/[^.*]/,
		message:'El Campo "<label>" es obligatorio'};
	   
	this.STRING   = {
		type:'string',
		example: '{type:"string"}',
		RegExp:/^[\w\sáéíóúñÑÁÉÍÓÚ#-.]+$/,
		message:'El Campo "<label>" debe ser solo alfanumérico'};
		
	this.INTEGER  = {
		type:'integer',
		example: '{type:"integer"}',
		RegExp:/^[-+]?\d+$/,
		message:'El Campo "<label>" no es un número entero válido'};

	this.FLOAT    = {
		type:'float',
		example: '{type:"float"}',
		RegExp:/^[-+]?\d*\.?\d+$/,
		message:'El Campo "<label>" no es un número flotante válido'};
	
	this.EMAIL   = {
		type:'email',
		example: '{type:"email"}',
		RegExp:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
		message:'El campo "<label>" no contiene un dato de e-mail válido'};
	
	this.TIME = {
		type:'time',
		example: '{type:"time"}',
		RegExp:/^(0\d|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/,
		message:'El campo "<label>" no contiene un dato de hora válido [00:00:00 - 23:59:59]'};
	
	this.DATE = { 
		type:'date',
		example: '{type:"date"}',
		RegExp:/^(([1-9])\d{3})-(0[1-9]|1[012])-([012][1-9]|[123]0|3[1])$/,
		message:'El campo "<label>" no contiene un dato de fecha válido'};
				 
	this.DATETIME = {
		type:'datatime',
		example: '{type:"datatime"}',
		RegExp:/^([012][1-9]|[123]0|3[1])-(0[1-9]|1[012])-((1[9]|2[0])\d{2}) (0\d|1\d|2[0-3]):([0-5]\d):([0-5]\d)$/,
		message:'El campo "<label>" no contiene un dato de fecha y hora válido'};
	
	this.URL = {
		type:'url',
		example:'{type:"url"}',
		RegExp:/^(http|https|ftp)/,
		message:'El campo "<label>" no contiene una direccion url valida'};
	
	this.IP = {
		type:'ip',
		example:'{type:"ip"}',
		RegExp:/^(1-255).(0-255).(0-255).(0-255)/,
		message: 'El campo "<label>" no contiene una direccion ip valida'};
		
}