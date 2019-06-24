/*Objeto que ofrece una previsualización de una archivo tipo imagen, requiere un ID del input
tipo file, ademas de que este debe contener un elemento llamado img en su dataset con el ID
de un nodo tipo img donde se mostrará la imagen.*/
var ImgPreview = {
	init:function(file){
		var file = document.getElementById(file);
		if(file !== null)
			file.onchange = ImgPreview.previewFile;
	},
	previewFile:function() {
		var preview = document.getElementById(this.dataset.img);
		var file    = this.files[0];
		var reader  = new FileReader();
		reader.onloadend = function () {
			preview.src = reader.result;
		}

		if (file) {
			reader.readAsDataURL(file);
		} else {
			preview.src = "";
		}
	},
	initByClass:function(class_){
		var elements = document.getElementsByClassName(class_);
		var length = elements.length;
		if(length > 0){
			for (var i = 0; i < length; i++) {
				elements[i].onchange = ImgPreview.previewFile;
			}
		}
	}
}
