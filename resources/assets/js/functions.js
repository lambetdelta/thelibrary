HTMLElement.prototype.removeClass = function(remove) {
    var newClassName = "";
    var i;
    var classes = this.className.split(" ");
    for(i = 0; i < classes.length; i++) {
        if(classes[i] !== remove) {
            newClassName += classes[i] + " ";
        }
    }
    this.className = newClassName;
}
HTMLElement.prototype.hasClass = function(class_name) {
    var i;
    var classes = this.className.split(" ");
    for(i = 0; i < classes.length; i++) {
        if(classes[i] == class_name)
          return true;
    }
    return false;
}
HTMLElement.prototype.isDescended = function(posible_parent) {
  if (this.tagName != "BODY")
    if (this.parentNode == posible_parent) {
      return true
    }else{
      var father = this.parentNode;
      if (father.tagName != "BODY") {
        var result = father.isDescended(posible_parent);
        if (result == true)
          return true;
      }
    }
    return false;
}
HTMLElement.prototype.addClass = function(className){
    if(!this.hasClass(className)){
      var arrayClass = this.className.split(" ");
      var index = arrayClass.indexOf(className);
      if (index === -1) {
          if (this.className !== "") {
              this.className += ' '
          }
          this.className += className;
      }
    }
}
HTMLElement.prototype.toggleClass = function(className){
    var arrayClass = this.className.split(" ");
    var index = arrayClass.indexOf(className);
    if (index === -1) {
        if (this.className !== "") {
            this.className += ' '
        }
        this.className += className;
    } else {
        arrayClass.splice(index, 1);
        this.className = "";
        for (var i = 0; i < arrayClass.length; i++) {
            this.className += arrayClass[i];
            if (i < arrayClass.length - 1) {
                this.className += " ";
            }
        }
    }
}
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}

function addEventForChild(parent, eventName, childSelector, function_,exceptions){
    var exceptions = typeof(exceptions === 'object') ? exceptions : [];
    if(parent === null){
      console.log('parent null');
      return ;
    }
    parent.addEventListener(eventName, function(event){
        const clickedElement = event.target;
        if (typeof(clickedElement) === "object") {
          var matchingChild = clickedElement.closest(childSelector);
          if(matchingChild !== null && in_array(clickedElement.tagName,exceptions) == false){
            var f =function_.bind(matchingChild);
            f(event);
          }
        }
    })
}
function eventToClass(class_name, event, function_){
  var elements = document.getElementsByClassName(class_name);
  var length = elements.length;
  for (var i = 0; i < length; i++) {
    elements[i].addEventListener(event,function_);
  }
}
function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
function onlyNumber(e){
    if(isNaN(parseFloat(e.key)) && e.key != "." && e.keyCode != 8 && e.keyCode != 9)
      e.preventDefault();
}
function regExpPhone(str){
  var patt = new RegExp(/^\+?1?\s*?\(?\d{3}(?:\)|[-|\s])?\s*?\d{3}[-|\s]?\d{4}$/);
  return patt.test(str);
}
function setProperties(obj,options){
  if(typeof(options) == "object")
    for (var i in options)
        if (options.hasOwnProperty(i))
          if(obj.hasOwnProperty(i))
            if(typeof(options[i]) == "object")
              setProperties(obj[i],options[i]);
            else
              obj[i] = options[i];
}
function getIdJquery(HTMLElement){
  var id = HTMLElement.getAttribute('id') != null ? HTMLElement.getAttribute('id') : "";
  return "#" + id;
}
function findObject(array,index,index_name){
  var length = array.length;
  for (var i = 0; i < array.length; i++) {
    if (array[i][index_name] == index)
      return array[i];
  }
  return false;
}
function findObjects(array,index,index_name){
  var length = array.length;
  var objects = [];
  for (var i = 0; i < array.length; i++) {
    if (array[i][index_name] == index)
      objects.push(array[i]);
  }
  return objects.length > 0 ? objects : false;
}
function findObjectsByPropertys(items, propertys){
  return items.filter(function(item){
    var result = true;
    for(var property in propertys){
      if (item.hasOwnProperty(property))
        if (item[property] != propertys[property])
          result = false;
    }
    return result;
  });
}
function findObjectByProperty(items, propertys){
  var items = findObjectsByPropertys(items, propertys);
  return items.length > 0 ? items[0] : false;
}
function removeObjec(array,index,index_name){
  var length = array.length;
  for (var i = 0; i < array.length; i++) {
    if (array[i][index_name] == index)
      array.splice(i,1);
  }
  return true;
}
function in_array(needle, haystack) {
    for(var i in haystack) {
        if(typeof haystack[i] == 'object')
            if (in_array(needle,haystack[i]))
                return true;
        if(haystack[i] == needle) return true;
    }
    return false;
}
function array_search(needle, haystack) {
    for(var i in haystack) {
        if(haystack[i] == needle) return i;
    }
    return false;
}
function scrollToElement(element){
  var position = element.getBoundingClientRect();
  window.scrollTo(0, position.top);
}
function offset(el) {
    var rect = el.getBoundingClientRect(),
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
}
function getDataForm(form){
  var data = {};
  var elements = [form.getElementsByTagName("INPUT"),form.getElementsByTagName("SELECT"),
  form.getElementsByTagName("TEXTFIELD")];
  var length_main = elements.length;
  var length;
  for (var i = 0; i < length_main; i++) {
      length = elements[i].length ;
      for (var x = 0; x < length; x++) {
        data[elements[i][x].name] = elements[i][x].value;
      }
  }
  return data;
}
function selectText(){
  this.select();
}
function maskEmpty(string){
  if (typeof string == 'string')
    return string.length > 0 ? string : "N/D";
  return "N/D";
}
function removeAllOptions(select){
    select.options.length = 0;
}
function getNumbers(string){
    return string.replace(/[^0-9]+/, '');
}
function fragmentLinkByClass(class_name){
  var links = document.getElementsByClassName(class_name);
  if (links != null) {
    var length = links.length;
    for (var i = 0; i < length; i++) {
      var url = links[i].getAttribute("href");
      links[i].href = url + window.location.hash;
    }
  }
}
function setLocationHash(input_id){
  document.getElementById(input_id).value = window.location.hash;
}
function base64toBlob(base64Data, contentType) {
    contentType = contentType || '';
    var sliceSize = 1024;
    var byteCharacters = atob(base64Data);
    var bytesLength = byteCharacters.length;
    var slicesCount = Math.ceil(bytesLength / sliceSize);
    var byteArrays = new Array(slicesCount);

    for (var sliceIndex = 0; sliceIndex < slicesCount; ++sliceIndex) {
        var begin = sliceIndex * sliceSize;
        var end = Math.min(begin + sliceSize, bytesLength);

        var bytes = new Array(end - begin);
        for (var offset = begin, i = 0; offset < end; ++i, ++offset) {
            bytes[i] = byteCharacters[offset].charCodeAt(0);
        }
        byteArrays[sliceIndex] = new Uint8Array(bytes);
    }
    return new Blob(byteArrays, { type: contentType });
}
function notify(title, message, color, icon, position, timeout, close){
    iziToast.show({
        title: title,
        message: message,
        color: color,
        icon: icon,
        position: position,
        timeout:timeout,
        close: close,
    });
}
function notififyPushMain(id, status){
    var node = document.getElementById(id);
    var class_name = status == true ? "fas fa-bell text-success" : "fas fa-bell-slash text-danger";
    if (node != null) {
        node.className = class_name;
    }
}
// Source: https://github.com/jserz/js_piece/blob/master/DOM/NonDocumentTypeChildNode/nextElementSibling/nextElementSibling.md
(function (arr) {
  arr.forEach(function (item) {
    if (item.hasOwnProperty('nextElementSibling')) {
      return;
    }
    Object.defineProperty(item, 'nextElementSibling', {
      configurable: true,
      enumerable: true,
      get: function () {
        var el = this;
        while (el = el.nextSibling) {
          if (el.nodeType === 1) {
              return el;
          }
        }
        return null;
      },
      set: undefined
    });
  });
})([Element.prototype, CharacterData.prototype]);
//dependientes de librerias

function alert(content, title = "Aviso", type = "default"){
  var icons = {
        blue: "fas fa-info-circle",
        purple: "fas fa-info-circle",
        default: "fas fa-info-circle",
        dark: "fas fa-info-circle",
        red: "fas fa-exclamation-triangle",
        green:"fas fa-check-circle",
        orange:"fas fa-exclamation",
      };
  $.confirm({
      title: title,
      content: content,
      theme: "modern",
      type: type,// 'blue, green, red, orange, purple & dark'
      backgroundDismiss: true,
      icon:icons[type],
      buttons:{
        close:{
          text: 'Cerrar'
        }
      },
  });
}
function confirm(title, content, btn_ok, btn_cancel, function_ok = null, type = "default", function_close = null,
  columnClass = "small"){
  var icons = {
    blue: "fas fa-info-circle",
    purple: "fas fa-info-circle",
    default: "fas fa-info-circle",
    dark: "fas fa-info-circle",
    red: "fas fa-exclamation-triangle",
    green:"fas fa-check-circle",
    orange:"fas fa-exclamation",
  };
  $.confirm({
    title: title,
    content: content,
    type: type,
    icon:icons[type],
    theme: "modern",
    columnClass:columnClass,
    buttons: {
        ok: {
            text: btn_ok,
            btnClass: 'btn-info',
            action: function_ok
        },
        close: {
            text: btn_cancel,
            btnClass: 'btn-secondary',
            action: function_close
        },
    },
  });
}
function myModal(title, content, type = "default", columnClass = "small"){
  $.confirm({
    title: title,
    content: content,
    theme: "modern",
    type: type,// 'blue, green, red, orange, purple & dark'
    columnClass:columnClass,
    backgroundDismiss: true,
    buttons:{
      close:{
        text: 'Cerrar'
      }
    },
  });
}
function multiselect(id){
  $('#' + id).multiselect({
    onChange: this.filter_,
    includeSelectAllOption: true,
    onSelectAll:this.showAll,
    onDeselectAll:this.hideAll,
    allSelectedText: 'Todos seleccionados',
    nonSelectedText: 'Ninguno selecionado',
    nSelectedText: 'Seleccionados',
    selectAllText: 'Todos'
  });
  document.getElementById(id).style.visibility = 'visible';
}
function dateInput(jquery_selecter, position = "bottom left", onSelect = null){
    var config = {
      dateFormat: 'dd/mm/yyyy',
      language: 'es',
      firstDay: 1,
      todayButton: new Date(),
      autoClose: true,
      position: position,
      clearButton:true,
      onHide: function(dp, animationCompleted){
          if (animationCompleted)
              $("#datepickers-container > div").removeAttr('style');
      }
    };
    if(typeof onSelect == "function")
      config["onSelect"] = onSelect;
    return $(jquery_selecter).datepicker(config).data('datepicker')
  }
