function enviroment(){
	DB = {};
 	DBConnection = null;
	DBRecordset = null;
	DB.DRIVER  = "{IBM INFORMIX ODBC DRIVER};"; //DRIVER ODBC instalado en el servidor donde esta el script
	DB.DATABASE ="consultasveh;" ;//BD que aloja los registros
	DB.HOST ="192.168.111.2;" ;//IP del servidor que aloja la BD 
	DB.SERVER = "ol_sdec5_vrobados;";
	DB.UID ="SegTlajo;" ;//Usuario de la BD
	DB.PWD ="@s3gtl4j0m;" ;//Contraseña del usuario de la BD
	DB.SERVICE = "1527;";
	DB.PROTOCOL = "olsoctcp;";
	
	DIALOG_POPUP_IDS = ["1","2","3","4","5","6","7","9","10","11",
	 "12","13","14","15","16","17","18"];//Array con los ids de los dialog que recibirán la notificación de un reporte real 
	DIALOG_POPUP_IDS_TESTING = ["29"];//Array con los ids de los dialog que recibirán la notificación de un reporte de prueba
	VNS_IDS = ["1","2","3","4","5","6","7","8","9","10","11","12","13",
	 "14","15","16","17","18"];
	URL_API_MANAGER = "http://172.16.11.136:8080/ManagerApiAsaltos/public/api/placas/notificar";
	
}
//Main 
function Init()
{   
	Core.RegisterEventHandler("LPR_LOGIC","1","CAR_LP_FOUND","main");	
}
function main(e){   
	enviroment();
	Database.DBInit();
	NotifyOutside.init(e); 
}
var NotifyOutside = {
	init:function(e){
		if(e.database_type == "blacklist" && 
			e.database_name == "Lista Base datos C5" || 
			e.database_name == "Seguimientos")
			HttpRequest.request(e);
	}
};
var Database = {
	DBInit:function(){
		DBConnection = new ActiveXObject("ADODB.Connection");
		DBRecordset = new ActiveXObject("ADODB.Recordset");
	},
	getRecord:function(sql){
		//Log.Debug(sql);
		if(DBRecordset.State == 1)
			DBRecordset.Close();
		DBRecordset.Open(sql, DBConnection, 3, 3);
		return DBRecordset.GetString(2,1,"||");
	},
	getRecordArray:function(sql){
		Log.Debug(sql);
		if(DBRecordset.State == 1)
			DBRecordset.Close();
		DBRecordset.Open(sql, DBConnection, 3, 3);
		DBFields = DBRecordset.Fields;
		//Log.Debug(DBRecordset("propietari"));
		//return DBRecordset.GetString(2,1,",");
	},
	dbConnect:function(){
		if(DBConnection.State != 1){
			DBConnection.ConnectionString = "DRIVER=" + DB.DRIVER + 
				"Database=" + DB.DATABASE +
				"Host=" + DB.HOST +	
				"UID=" + DB.UID +
				"Password="+ DB.PWD +
				"Protocol="+ DB.PROTOCOL +
				"Server="+ DB.SERVER +
				"Service="+ DB.SERVICE;
			DBConnection.Open();
		}
	},
	disconnect:function(){
		if(DBConnection.State == 1)
			DBConnection.Close();
		if(DBRecordset.State == 1)
			DBRecordset.Close();	
	}
}
var HttpRequest = {
	request:function(e){
		var HTTP = new ActiveXObject("Msxml2.ServerXMLHTTP.3.0");
		var url = URL_API_MANAGER;
		var params = HttpRequest.formatDataEvent(e);
		url += "?" + params;
		HTTP.open('GET', url, false);
		HTTP.send();
		//Request an answer
		var response = HTTP.responseXML;
		//Log.Trace(response)
	},
	formatData:function(string_data){
		var string_array = string_data.split("||");
    	var datanames = ["placa","propietari","color","marca","submarca","modelo",
    		"region","fecha_rbo","lugar_robo", "hora_rbo","telefono","violencia","serie","tipoveh","version"];
    	var data = [];
    	for (var i = 0; i < datanames.length; i++) {   
    		data.push(datanames[i] + "=" + string_array[i]);
    	}
    	return data.join("&");    
	},
	formatDataEvent:function(event){
		var data = [];
		for(var prop in event)
			data.push(prop + "=" + event[prop])
		return data.join("&");	
	}		 
}