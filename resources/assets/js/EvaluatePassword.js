var EvaluatePassword = {
	password:null,
	repeat:null,
	_function:null,
	notify_ms:"El campo contraseña y repetir contraseña no son iguales.",
	style:"error",
	notify_length:"La contraseña está vacia",
	init:function(password, repeat, send, _function){
		EvaluatePassword.setPropertys(password, repeat, _function)
		EvaluatePassword.setEvents(send);
	},
	evaluate:function(){
		var password = document.getElementById(EvaluatePassword.password).value;
		var repeat = document.getElementById(EvaluatePassword.repeat).value;
		if (password.length == 0) {
			EvaluatePassword.empty();
			return;
		}
		if (password == repeat ) {
			EvaluatePassword._function();
		}else	
			EvaluatePassword.notEquals()
	},
	empty:function(){
		$("#" + EvaluatePassword.password).notify(EvaluatePassword.notify_length,EvaluatePassword.style);
	},
	notEquals:function(){
		$("#" + EvaluatePassword.password).notify(EvaluatePassword.notify_ms,EvaluatePassword.style);
	},
	setEvents:function(send){
		document.getElementById(send).onclick = EvaluatePassword.evaluate;
	},
	setPropertys:function(password,repeat,_function){
		EvaluatePassword.password = password;
		EvaluatePassword.repeat = repeat;
		EvaluatePassword._function = _function;
	}
}