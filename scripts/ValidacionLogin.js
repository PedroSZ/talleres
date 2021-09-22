function validar(){
	var objeto = new Object();
	objeto.usu = document.getElementById("usua").value;
	objeto.cont = document.getElementById("contra").value;
	if(objeto.usu=="") {
		alert(" Favor de proporcionar un nombre de usuario");
		return false;
	}else if(objeto.cont=="") {
		alert("Favor de ingresar una contraseña");
		return false;
	}else if( document.form.submit(alert("Gracias por su visita sea usted bienvenido"))){	
	}       
}