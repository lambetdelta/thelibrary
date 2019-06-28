var _messages;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

HTMLElement.prototype.removeClass = function (remove) {
  var newClassName = "";
  var i;
  var classes = this.className.split(" ");

  for (i = 0; i < classes.length; i++) {
    if (classes[i] !== remove) {
      newClassName += classes[i] + " ";
    }
  }

  this.className = newClassName;
};

HTMLElement.prototype.hasClass = function (class_name) {
  var i;
  var classes = this.className.split(" ");

  for (i = 0; i < classes.length; i++) {
    if (classes[i] == class_name) return true;
  }

  return false;
};

HTMLElement.prototype.isDescended = function (posible_parent) {
  if (this.tagName != "BODY") if (this.parentNode == posible_parent) {
    return true;
  } else {
    var father = this.parentNode;

    if (father.tagName != "BODY") {
      var result = father.isDescended(posible_parent);
      if (result == true) return true;
    }
  }
  return false;
};

HTMLElement.prototype.addClass = function (className) {
  if (!this.hasClass(className)) {
    var arrayClass = this.className.split(" ");
    var index = arrayClass.indexOf(className);

    if (index === -1) {
      if (this.className !== "") {
        this.className += ' ';
      }

      this.className += className;
    }
  }
};

HTMLElement.prototype.toggleClass = function (className) {
  var arrayClass = this.className.split(" ");
  var index = arrayClass.indexOf(className);

  if (index === -1) {
    if (this.className !== "") {
      this.className += ' ';
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
};

Element.prototype.remove = function () {
  this.parentElement.removeChild(this);
};

function addEventForChild(parent, eventName, childSelector, function_, exceptions) {
  var exceptions = _typeof(exceptions === 'object') ? exceptions : [];

  if (parent === null) {
    console.log('parent null');
    return;
  }

  parent.addEventListener(eventName, function (event) {
    var clickedElement = event.target;

    if (_typeof(clickedElement) === "object") {
      var matchingChild = clickedElement.closest(childSelector);

      if (matchingChild !== null && in_array(clickedElement.tagName, exceptions) == false) {
        var f = function_.bind(matchingChild);
        f(event);
      }
    }
  });
}

function eventToClass(class_name, event, function_) {
  var elements = document.getElementsByClassName(class_name);
  var length = elements.length;

  for (var i = 0; i < length; i++) {
    elements[i].addEventListener(event, function_);
  }
}

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function onlyNumber(e) {
  if (isNaN(parseFloat(e.key)) && e.key != "." && e.keyCode != 8 && e.keyCode != 9) e.preventDefault();
}

function regExpPhone(str) {
  var patt = new RegExp(/^\+?1?\s*?\(?\d{3}(?:\)|[-|\s])?\s*?\d{3}[-|\s]?\d{4}$/);
  return patt.test(str);
}

function setProperties(obj, options) {
  if (_typeof(options) == "object") for (var i in options) {
    if (options.hasOwnProperty(i)) if (obj.hasOwnProperty(i)) if (_typeof(options[i]) == "object") setProperties(obj[i], options[i]);else obj[i] = options[i];
  }
}

function getIdJquery(HTMLElement) {
  var id = HTMLElement.getAttribute('id') != null ? HTMLElement.getAttribute('id') : "";
  return "#" + id;
}

function findObject(array, index, index_name) {
  var length = array.length;

  for (var i = 0; i < array.length; i++) {
    if (array[i][index_name] == index) return array[i];
  }

  return false;
}

function findObjects(array, index, index_name) {
  var length = array.length;
  var objects = [];

  for (var i = 0; i < array.length; i++) {
    if (array[i][index_name] == index) objects.push(array[i]);
  }

  return objects.length > 0 ? objects : false;
}

function findObjectsByPropertys(items, propertys) {
  return items.filter(function (item) {
    var result = true;

    for (var property in propertys) {
      if (item.hasOwnProperty(property)) if (item[property] != propertys[property]) result = false;
    }

    return result;
  });
}

function findObjectByProperty(items, propertys) {
  var items = findObjectsByPropertys(items, propertys);
  return items.length > 0 ? items[0] : false;
}

function removeObjec(array, index, index_name) {
  var length = array.length;

  for (var i = 0; i < array.length; i++) {
    if (array[i][index_name] == index) array.splice(i, 1);
  }

  return true;
}

function in_array(needle, haystack) {
  for (var i in haystack) {
    if (_typeof(haystack[i]) == 'object') if (in_array(needle, haystack[i])) return true;
    if (haystack[i] == needle) return true;
  }

  return false;
}

function array_search(needle, haystack) {
  for (var i in haystack) {
    if (haystack[i] == needle) return i;
  }

  return false;
}

function scrollToElement(element) {
  var position = element.getBoundingClientRect();
  window.scrollTo(0, position.top);
}

function offset(el) {
  var rect = el.getBoundingClientRect(),
      scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
      scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  return {
    top: rect.top + scrollTop,
    left: rect.left + scrollLeft
  };
}

function getDataForm(form) {
  var data = {};
  var elements = [form.getElementsByTagName("INPUT"), form.getElementsByTagName("SELECT"), form.getElementsByTagName("TEXTFIELD")];
  var length_main = elements.length;
  var length;

  for (var i = 0; i < length_main; i++) {
    length = elements[i].length;

    for (var x = 0; x < length; x++) {
      data[elements[i][x].name] = elements[i][x].value;
    }
  }

  return data;
}

function selectText() {
  this.select();
}

function maskEmpty(string) {
  if (typeof string == 'string') return string.length > 0 ? string : "N/D";
  return "N/D";
}

function removeAllOptions(select) {
  select.options.length = 0;
}

function getNumbers(string) {
  return string.replace(/[^0-9]+/, '');
}

function fragmentLinkByClass(class_name) {
  var links = document.getElementsByClassName(class_name);

  if (links != null) {
    var length = links.length;

    for (var i = 0; i < length; i++) {
      var url = links[i].getAttribute("href");
      links[i].href = url + window.location.hash;
    }
  }
}

function setLocationHash(input_id) {
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

  return new Blob(byteArrays, {
    type: contentType
  });
}

function notify(title, message, color, icon, position, timeout, close) {
  iziToast.show({
    title: title,
    message: message,
    color: color,
    icon: icon,
    position: position,
    timeout: timeout,
    close: close
  });
}

function notififyPushMain(id, status) {
  var node = document.getElementById(id);
  var class_name = status == true ? "fas fa-bell text-success" : "fas fa-bell-slash text-danger";

  if (node != null) {
    node.className = class_name;
  }
} // Source: https://github.com/jserz/js_piece/blob/master/DOM/NonDocumentTypeChildNode/nextElementSibling/nextElementSibling.md


(function (arr) {
  arr.forEach(function (item) {
    if (item.hasOwnProperty('nextElementSibling')) {
      return;
    }

    Object.defineProperty(item, 'nextElementSibling', {
      configurable: true,
      enumerable: true,
      get: function get() {
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
})([Element.prototype, CharacterData.prototype]); //dependientes de librerias


function alert(content) {
  var title = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "Aviso";
  var type = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "default";
  var icons = {
    blue: "fas fa-info-circle",
    purple: "fas fa-info-circle",
    "default": "fas fa-info-circle",
    dark: "fas fa-info-circle",
    red: "fas fa-exclamation-triangle",
    green: "fas fa-check-circle",
    orange: "fas fa-exclamation"
  };
  $.confirm({
    title: title,
    content: content,
    theme: "modern",
    type: type,
    // 'blue, green, red, orange, purple & dark'
    backgroundDismiss: true,
    icon: icons[type],
    buttons: {
      close: {
        text: 'Cerrar'
      }
    }
  });
}

function confirm(title, content, btn_ok, btn_cancel) {
  var function_ok = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;
  var type = arguments.length > 5 && arguments[5] !== undefined ? arguments[5] : "default";
  var function_close = arguments.length > 6 && arguments[6] !== undefined ? arguments[6] : null;
  var columnClass = arguments.length > 7 && arguments[7] !== undefined ? arguments[7] : "small";
  var icons = {
    blue: "fas fa-info-circle",
    purple: "fas fa-info-circle",
    "default": "fas fa-info-circle",
    dark: "fas fa-info-circle",
    red: "fas fa-exclamation-triangle",
    green: "fas fa-check-circle",
    orange: "fas fa-exclamation"
  };
  $.confirm({
    title: title,
    content: content,
    type: type,
    icon: icons[type],
    theme: "modern",
    columnClass: columnClass,
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
      }
    }
  });
}

function myModal(title, content) {
  var type = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "default";
  var columnClass = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : "small";
  $.confirm({
    title: title,
    content: content,
    theme: "modern",
    type: type,
    // 'blue, green, red, orange, purple & dark'
    columnClass: columnClass,
    backgroundDismiss: true,
    buttons: {
      close: {
        text: 'Cerrar'
      }
    }
  });
}

function multiselect(id) {
  $('#' + id).multiselect({
    onChange: this.filter_,
    includeSelectAllOption: true,
    onSelectAll: this.showAll,
    onDeselectAll: this.hideAll,
    allSelectedText: 'Todos seleccionados',
    nonSelectedText: 'Ninguno selecionado',
    nSelectedText: 'Seleccionados',
    selectAllText: 'Todos'
  });
  document.getElementById(id).style.visibility = 'visible';
}

function dateInput(jquery_selecter) {
  var position = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "bottom left";
  var onSelect = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  var config = {
    dateFormat: 'dd/mm/yyyy',
    language: 'es',
    firstDay: 1,
    todayButton: new Date(),
    autoClose: true,
    position: position,
    clearButton: true,
    onHide: function onHide(dp, animationCompleted) {
      if (animationCompleted) $("#datepickers-container > div").removeAttr('style');
    }
  };
  if (typeof onSelect == "function") config["onSelect"] = onSelect;
  return $(jquery_selecter).datepicker(config).data('datepicker');
}

var Ms = {
  init: function init(css_class) {
    addEventForChild(document.body, "click", css_class, Ms.showMessage);
  },
  showMessage: function showMessage() {
    var ms = typeof this.dataset.ms === 'string' ? this.dataset.ms : "";
    var title = typeof this.dataset.title === 'string' ? this.dataset.title : "";
    var type = typeof this.dataset.type === 'string' ? this.dataset.title : "purple";
    alert(ms, title, type);
  }
};
var Modal = {
  init: function init(css_class) {
    addEventForChild(document.body, "click", css_class, Modal.showModal);
  },
  showModal: function showModal() {
    var title = typeof this.dataset.title === 'string' ? this.dataset.title : "";
    var content = typeof this.dataset.element === 'string' ? Modal.contentByElement(this.dataset.element) : "";
    myModal(title, content, "default", "col-md-12");
  },
  contentByElement: function contentByElement(id) {
    var content = document.getElementById(id);
    return content != null ? content.innerHTML : "";
  }
};
Ms.init(".ms");
Modal.init(".my-modal"); // Objeto que se usa para guardar todas las rutas que serán usadas en JS, es importante saber que todas son "limpiadas"
// antes de ser guardadas, debido a que se  reciben mendiante el ruteo de Laravel el cual requiere que algunas
// rutas tengan datos, para hacer esto se usan datos basura que luego son removidos, ninguna ruta usada esta fuera 
//de este objeto.

var Path = {
  init: function init(paths) {
    for (var name in paths) {
      Path[name] = Path.clearPathDefault(paths[name]);
    }
  },
  clearPathDefault: function clearPathDefault(string) {
    string = string.replace(/\/0/, '');
    if (string.match(/\/0/) == null) return string;
    return Path.clearPathDefault(string);
  }
};
var List = {
  init: function init(id) {
    var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    var columns = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    var filters_columns = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : true;
    var id_jquery = '#' + id;

    if (filters_columns) {
      List.initInputsFilters(id_jquery);
    }

    var table = $(id_jquery).DataTable(List.config(data, columns));

    if (filters_columns) {
      List.applyFilter(table);
    }

    document.getElementById(id).style.visibility = 'visible'; // table.on( 'buttons-action', function ( e, buttonApi, dataTable, node, config ) {
    // 	alert("bton presionado");
    // } );
  },
  config: function config(data, columns) {
    var config = {
      responsive: true,
      fixedHeader: true,
      language: {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      } // dom: 'Bflrtip',
      // buttons: [
      // 	{
      // 		extend: 'copy',
      // 		text: 'Copiar',
      // 		className: 'datatable-btn-copy',
      // 		titleAttr: "Copiar al portapales"
      // 	},
      // 	{
      // 		extend: 'excel',
      // 		text: 'Excel',
      // 		className: 'datatable-btn-excel',
      // 		titleAttr: "Copiar a un archivo de Excel"
      // 	},
      // 	{
      // 		extend: 'print',
      // 		text: 'Imprimir',
      // 		className: 'datatable-btn-print',
      // 		titleAttr: "Imprimir"
      // 	},
      // 	{
      // 		extend: 'csv',
      // 		text: 'CSV',
      // 		className: 'datatable-btn-csv',
      // 		titleAttr: "Copiar a un archivo CSV",
      // 		action: function ( e, dt, node, config ) {
      // 			showLoading();
      // 			$.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, node, config);
      // 			hideLoading();
      // 		}
      // 	},
      // ]

    };
    if (data !== null) config['data'] = data;
    if (columns !== null) config['columns'] = columns;
    return config;
  },
  initInputsFilters: function initInputsFilters(id_jquery) {
    $(id_jquery + ' tfoot th').each(function () {
      var item = $(id_jquery + ' thead th').eq($(this).index());

      if (item.data("orderable") != false) {
        var title = item.text();
        $(this).html('<input type="text" placeholder="' + title + '" />');
      }
    });
  },
  applyFilter: function applyFilter(table) {
    table.columns().every(function () {
      var column = this;
      $('input', this.footer()).on('keyup change', function () {
        column.search(this.value).draw();
      });
    });
  },
  renderResponsiveData: function renderResponsiveData(api, rowIdx, columns) {
    return false;
  },
  htmlTable: function htmlTable(columns) {
    var rows = '';
    var length = columns.length;

    for (var index = 0; index < length; index++) {
      var element = columns[index];
      rows += "<tr></tr>";
    }
  }
};
var ConfigListBasic = {
  renderActive: function renderActive(data, type, row, meta) {
    return row.active == "1" ? '<strong class="text-success">Activo</strong>' : '<strong class="text-warning">Inactivo</strong>';
  },
  renderEdit: function renderEdit(data, type, row, meta) {
    var path = Path.path_edit + '/' + row.id;
    return ConfigListBasic.btnLink(path, "Editar", "btn-primary");
  },
  btnLink: function btnLink(path, txt, css_btn) {
    var new_tab = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : "_self";
    return '<a href="' + path + '" target="' + new_tab + '"><button type="button" class="btn ' + css_btn + '">' + txt + '</button></a>';
  },
  renderDetail: function renderDetail(data, type, row, meta) {
    var path = Path.path_detail + '/' + row.id;
    return ConfigListBasic.btnLink(path, "Detalles", "btn-primary");
  },
  renderDelete: function renderDelete(data, type, row, meta) {
    var path = Path.path_delete + '/' + row.id;
    return ConfigListBasic.btnLink(path, "Borrar", "btn-danger");
  },
  renderBtnEstatus: function renderBtnEstatus(data, type, row, meta) {
    var path = Path.path_status + '/' + row.id;
    var status = row.deleted_at == '' ? "<span class='text-info'>Activo</span>" : "<span class='text-danger'>Inactivo</span>";
    return status + "<br>" + ConfigListBasic.btnLink(path, "Estatus", "btn-warning");
  },
  renderEstatus: function renderEstatus(data, type, row, meta) {
    return row.deleted_at == '' ? '<strong class="text-success">Activo</strong>' : '<strong class="text-warning">Inactivo</strong>';
  },
  btn: function btn(txt, css_btn) {
    var attributes = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "";
    return '<button type="button" class="btn ' + css_btn + '" ' + attributes + '>' + txt + '</button>';
  }
};
var EvaluatePassword = {
  password: null,
  repeat: null,
  _function: null,
  notify_ms: "El campo contraseña y repetir contraseña no son iguales.",
  style: "error",
  notify_length: "La contraseña está vacia",
  init: function init(password, repeat, send, _function) {
    EvaluatePassword.setPropertys(password, repeat, _function);
    EvaluatePassword.setEvents(send);
  },
  evaluate: function evaluate() {
    var password = document.getElementById(EvaluatePassword.password).value;
    var repeat = document.getElementById(EvaluatePassword.repeat).value;

    if (password.length == 0) {
      EvaluatePassword.empty();
      return;
    }

    if (password == repeat) {
      EvaluatePassword._function();
    } else EvaluatePassword.notEquals();
  },
  empty: function empty() {
    $("#" + EvaluatePassword.password).notify(EvaluatePassword.notify_length, EvaluatePassword.style);
  },
  notEquals: function notEquals() {
    $("#" + EvaluatePassword.password).notify(EvaluatePassword.notify_ms, EvaluatePassword.style);
  },
  setEvents: function setEvents(send) {
    document.getElementById(send).onclick = EvaluatePassword.evaluate;
  },
  setPropertys: function setPropertys(password, repeat, _function) {
    EvaluatePassword.password = password;
    EvaluatePassword.repeat = repeat;
    EvaluatePassword._function = _function;
  }
  /*Objeto que ofrece una previsualización de una archivo tipo imagen, requiere un ID del input
  tipo file, ademas de que este debe contener un elemento llamado img en su dataset con el ID
  de un nodo tipo img donde se mostrará la imagen.*/

};
var ImgPreview = {
  init: function init(file) {
    var file = document.getElementById(file);
    if (file !== null) file.onchange = ImgPreview.previewFile;
  },
  previewFile: function previewFile() {
    var preview = document.getElementById(this.dataset.img);
    var file = this.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
      preview.src = reader.result;
    };

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
    }
  },
  initByClass: function initByClass(class_) {
    var elements = document.getElementsByClassName(class_);
    var length = elements.length;

    if (length > 0) {
      for (var i = 0; i < length; i++) {
        elements[i].onchange = ImgPreview.previewFile;
      }
    }
  }
};
var HttpResponses = {
  messages: (_messages = {
    400: "La solicitud tiene un formato incorrecto, recarga tu navegador e intenta de nuevo",
    401: "Requiere autentificación",
    403: "No estás autorizado",
    404: "No encontramos lo que estás buscando",
    409: "El recurso que intentas modificar esta bloqueado, si crees que estos es un error contacta a soporte",
    500: "Error interno del servidor, prueba en otro momento"
  }, _defineProperty(_messages, "500", "Error interno del servidor, prueba en otro momento"), _defineProperty(_messages, 503, "Error interno del servidor, prueba en otro momento"), _messages),
  message: function message(status) {
    var message = "No se encotro un mensaje predefinido";
    if (HttpResponses.messages.hasOwnProperty(status)) message = HttpResponses.messages[status];
    return message;
  },
  errorMs: function errorMs(xhrObj) {
    var ms = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
    var code_ms = HttpResponses.message(xhrObj.status);
    alert(code_ms + "<br>" + ms, "Aviso", "red");
  }
};
