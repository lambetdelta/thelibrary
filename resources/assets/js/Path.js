// Objeto que se usa para guardar todas las rutas que serán usadas en JS, es importante saber que todas son "limpiadas"
// antes de ser guardadas, debido a que se  reciben mendiante el ruteo de Laravel el cual requiere que algunas
// rutas tengan datos, para hacer esto se usan datos basura que luego son removidos, ninguna ruta usada esta fuera 
//de este objeto.
var Path = {
	init:function(paths){
		for(var name in paths){
			Path[name] = Path.clearPathDefault(paths[name]);
		}
	},
	clearPathDefault:function(string){
		string = string.replace(/\/0/, '');	
		if(string.match(/\/0/) == null)
			return string;
		return Path.clearPathDefault(string);
	}
}