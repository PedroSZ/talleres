function validacion(){

	var objeto = new Object();
	objeto.Codi = document.getElementById("Cod").value;
	objeto.Nomb = document.getElementById("Nom").value;
	objeto.Apell = document.getElementById("Apel").value;
	objeto.Corr = document.getElementById("Correo").value;
	objeto.Tele = document.getElementById("Tel").value;
	objeto.Gru = document.getElementById("Grup").value;
	objeto.Contr = document.getElementById("Contra").value;
	objeto.ValCont = document.getElementById("Confirmcontra").value;

	if(objeto.Codi=="") {
		alert("Por favor llena el campo Código");
		return false;
						}
	else if(objeto.Nomb=="") {
		alert("Por favor llena el campo Nombre");
		return false;
	}
	else if(objeto.Apell=="") {
		alert("Por favor llena el campo Apellidos");
		return false;
	}
	else if(objeto.Corr=="") {
		alert("Por favor llena el campo Correo");
		return false;
	}
	else if(objeto.Tele=="") {
		alert("Por favor llena el campo Teléfono");
		return false;
	}
	else if(objeto.Gru=="") {
		alert("Porfavor llena el campo Grupo");
		return false;
	}
	else if(objeto.Contr=="") {
		alert("Porfavor llena el campo Contraseña");
		return false;
	}

	else if(objeto.ValCont=="") {
		alert("Porfavor confirma la contraseña");
		return false;
	}
	else if(objeto.Contr!=objeto.ValCont) {
		alert("Las contraseñas no coinciden por favor corríjalo");
	}
	else if( document.formu.submit(alert("Gracias por su registro, ahora es usuario de SIRTEC63."))){
	}
}
