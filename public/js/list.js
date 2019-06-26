var ConfigListBook = {
    renderAvailable:function(data, type, row, meta){
        return  row.borrowing == 'null' ? '<strong class="text-success">Disponible</strong>' : '<strong class="text-warning">Prestado</strong>';
    },
}
