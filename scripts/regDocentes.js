function validar(){
	var txtCodigo = document.getElementById("codigo").value;
	var txtNombre = document.getElementById("nombre").value;
	var txtApellidos = document.getElementById("apellidos").value;
	var txtPsw1 = document.getElementById("psw1").value;
	var txtPsw2 = document.getElementById("psw2").value;
	var radTipo = document.getElementById("tipo").value;

	if (txtCodigo == null || txtCodigo.length == 0 ){
      	alert("Tiene que escribir el codigo");
      	document.getElementById('codigo').focus();
      	return false;
   	}
   	if (txtNombre == null || txtNombre.length == 0 ){
      	alert("Tiene que escribir el nombre");
      	document.getElementById('codigo').focus();
      	return false;
   	}
   	if (txtApellidos == null || txtApellidos.length == 0 ){
      	alert("Tiene que escribir el o los apellidos");
      	document.getElementById('codigo').focus();
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

   	if(radTipo == null){
   		alert("Debe elegir un tipo");
   	}

    return true;
}

function limpiar() {
	document.getElementById("frm_regDocentes").reset();
}

function regresar(){
	location.href='index.php'
}
