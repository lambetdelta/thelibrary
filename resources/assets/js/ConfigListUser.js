var ConfigListUser = {
    renderEmail:function(data, type, row, meta){
        return "Particular:" +  row.email ;
    },
    renderActive:function(data, type, row, meta){
        return  row.active == "1" ? '<strong class="text-success">Activo</strong>' : '<strong class="text-warning">Inactivo</strong>';
    },
    renderRoles: function(data, type, row, meta){
        return  row.roles.split(",").join("<br>");
    },
    renderEditProfile:function(data, type, row, meta){
        var path =  Path.path_edit + '/' + row.id;
        return ConfigListUser.btnLink(path, "Editar", "btn-primary");
    },
    btnLink:function(path, txt, css_btn, new_tab = "_self"){
        return  '<a href="' + path +  '" target="' + new_tab + '"><button type="button" class="btn ' + css_btn +
            '">' + txt + '</button></a>' ;
    }

}
