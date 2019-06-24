var ConfigListUser = {
  renderEmail: function renderEmail(data, type, row, meta) {
    return "Particular:" + row.email;
  },
  renderActive: function renderActive(data, type, row, meta) {
    return row.active == "1" ? '<strong class="text-success">Activo</strong>' : '<strong class="text-warning">Inactivo</strong>';
  },
  renderRoles: function renderRoles(data, type, row, meta) {
    return row.roles.split(",").join("<br>");
  },
  renderEditProfile: function renderEditProfile(data, type, row, meta) {
    var path = Path.path_edit + '/' + row.id;
    return ConfigListUser.btnLink(path, "Editar", "btn-primary");
  },
  btnLink: function btnLink(path, txt, css_btn) {
    var new_tab = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : "_self";
    return '<a href="' + path + '" target="' + new_tab + '"><button type="button" class="btn ' + css_btn + '">' + txt + '</button></a>';
  }
};
