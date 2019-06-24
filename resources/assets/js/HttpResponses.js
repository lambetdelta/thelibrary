var HttpResponses = {
	messages:{
		400: "La solicitud tiene un formato incorrecto, recarga tu navegador e intenta de nuevo",
		401:"Requiere autentificación",
		403:"No estás autorizado",
		404:"No encontramos lo que estás buscando",
		409:"El recurso que intentas modificar esta bloqueado, si crees que estos es un error contacta a soporte",
		500:"Error interno del servidor, prueba en otro momento",
		500:"Error interno del servidor, prueba en otro momento",
		503:"Error interno del servidor, prueba en otro momento",
	},
	message:function(status){
		var message = "No se encotro un mensaje predefinido";
		if (HttpResponses.messages.hasOwnProperty(status)) 
			message = HttpResponses.messages[status];
		return message;
	},
	errorMs:function(xhrObj, ms = ""){
		var code_ms = HttpResponses.message(xhrObj.status);
		alert(code_ms + "<br>" + ms, "Aviso", "red");
	}
}