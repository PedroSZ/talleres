function validarTaller(){
	var txtId = document.getElementById("id").value;
	var txtNombre = document.getElementById("nombre").value;
	var txtArea = document.getElementById("area").value;
	var txtHorario = document.getElementById("horario").value;
	var selInstructor = document.getElementById("instructor").value;
	var selSupervisor = document.getElementById("supervisor").value;
	var selEstado = document.getElementById("estado").value;


	if (txtId == null || txtId.length == 0 ){
      	alert("Tiene que ingresar el id del taller");
      	document.getElementById('id').focus();
      	return false;
   	}
   	if (txtNombre == null || txtNombre.length == 0 ){
      	alert("Ingrese el nombre del taller");
      	document.getElementById('nombre').focus();
      	return false;
   	}
   	if (txtArea == 'Sin Asignar' //|| txtArea.length == 0
	){
      	alert("Tiene que asignar un área al taller");
      	document.getElementById('area').focus();
      	return false;
   	}

   	if (txtHorario == null || txtHorario.length == 0 ){
      	alert("Tiene que elegir un horario");
      	document.getElementById('horario').focus();
      	return false;
   	}

		 if (selInstructor == null || selInstructor.length == 0 ){
				 alert("Tiene que elegir un instructor");
				 document.getElementById('instructor').focus();
				 return false;
		 }

		 if (selSupervisor == null || selSupervisor.length == 0 ){
 				alert("Tiene que elegir un supervisor");
 				document.getElementById('supervisor').focus();
 				return false;
 		}

		if (selEstado == null || selEstado.length == 0 ){
			 alert("Elije el estado del taller");
			 document.getElementById('estado').focus();
			 return false;
	 }


    return true;
}

function limpiar() {
	document.getElementById("frm_regTalleres").reset();
}

function regresar(){
	location.href='index.php'
}
