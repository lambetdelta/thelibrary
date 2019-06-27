var ConfigListBasic = {
    renderActive:function(data, type, row, meta){
        return  row.active == "1" ? '<strong class="text-success">Activo</strong>' : '<strong class="text-warning">Inactivo</strong>';
    },
    renderEdit:function(data, type, row, meta){
        var path =  Path.path_edit + '/' + row.id;
        return ConfigListBasic.btnLink(path, "Editar", "btn-primary");
    },
    btnLink:function(path, txt, css_btn, new_tab = "_self"){
        return  '<a href="' + path +  '" target="' + new_tab + '"><button type="button" class="btn ' + css_btn +
            '">' + txt + '</button></a>' ;
    },
    renderDetail:function(data, type, row, meta){
        var path =  Path.path_detail + '/' + row.id;
        return ConfigListBasic.btnLink(path, "Detalles", "btn-primary");
    },
    renderDelete:function(data, type, row, meta){
        var path =  Path.path_delete + '/' + row.id;
        return ConfigListBasic.btnLink(path, "Borrar", "btn-danger");
    },
    renderBtnEstatus:function(data, type, row, meta){
        var path =  Path.path_status + '/' + row.id;
        var status = row.deleted_at == '' ? "<span class='text-info'>Activo</span>" :  "<span class='text-danger'>Inactivo</span>";
        return status + "<br>" + ConfigListBasic.btnLink(path, "Estatus", "btn-warning");
    },
    renderEstatus:function(data, type, row, meta){
        return  row.deleted_at == '' ? '<strong class="text-success">Activo</strong>' : '<strong class="text-warning">Inactivo</strong>';
    },
    btn:function(txt, css_btn, attributes = ""){
        return  '<button type="button" class="btn ' + css_btn +
            '" ' + attributes + '>' + txt + '</button>' ;
    },
}
