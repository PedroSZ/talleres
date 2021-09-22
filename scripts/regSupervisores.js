function validarSupervisor(){
	var txtCodigo = document.getElementById("codigo").value;
	var txtNombre = document.getElementById("nombre").value;
	var txtApellidos = document.getElementById("apellidos").value;

	var txtEmail = document.getElementById("email").value;
	var txtTelefono = document.getElementById("telefono").value;

	var txtPsw1 = document.getElementById("psw1").value;
	var txtPsw2 = document.getElementById("psw2").value;


	if (txtCodigo == null || txtCodigo.length == 0 ){
      	alert("Ingrese su RFC");
      	document.getElementById('codigo').focus();
      	return false;
   	}
   	if (txtNombre == null || txtNombre.length == 0 ){
      	alert("Tiene que escribir el nombre");
      	document.getElementById('nombre').focus();
      	return false;
   	}
   	if (txtApellidos == null || txtApellidos.length == 0 ){
      	alert("Tiene que escribir el o los apellidos");
      	document.getElementById('apellidos').focus();
      	return false;
   	}


	if (txtEmail == null || txtEmail.length == 0 ){
      	alert("Tienes que escribir un email");
      	document.getElementById('email').focus();
      	return false;
   	}
	if (txtTelefono == null || txtTelefono.length == 0 ){
      	alert("Tienes que escribir un teléfono");
      	document.getElementById('telefono').focus();
      	return false;
   	}

   	if (txtPsw1 == null || txtPsw1.length == 0 ){
      	alert("Tiene que escribir una contraseña");
      	document.getElementById('psw1').focus();
      	return false;
   	}

   	if (txtPsw2 == null || txtPsw2.length == 0 ){
      	alert("Tiene que confirmar la contraseña");
      	document.getElementById('psw2').focus();
      	return false;
   	}

   	if(txtPsw1 != txtPsw2){
   		alert("Las contraseñas no coinciden");
   		document.getElementById('psw1').focus();
      	return false;
   	}


}

function limpiar() {
	document.getElementById("frm_regSupervisores").reset();
}

function regresar(){
	location.href='index.php'
}
