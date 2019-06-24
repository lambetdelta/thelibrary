var Ms = {
	init:function(css_class){
		addEventForChild(document.body, "click", css_class, Ms.showMessage);
	},
	showMessage:function(){
		var ms = typeof(this.dataset.ms) === 'string' ? this.dataset.ms : "";
		var title = typeof(this.dataset.title) === 'string' ? this.dataset.title : "";
		var type = typeof(this.dataset.type) === 'string' ? this.dataset.title : "purple";
		alert(ms, title, type);
	}
};
var Modal = {
	init:function(css_class){
		addEventForChild(document.body, "click", css_class, Modal.showModal);
	},
	showModal:function(){
		var title = typeof(this.dataset.title) === 'string' ? this.dataset.title : "";
		var content = typeof(this.dataset.element) === 'string' ? Modal.contentByElement(this.dataset.element) : "";
		myModal(title, content, "default", "col-md-12");
	},
	contentByElement:function(id){
		var content = document.getElementById(id);
		return content != null ? content.innerHTML : "";
	}
}
Ms.init(".ms")
Modal.init(".my-modal");