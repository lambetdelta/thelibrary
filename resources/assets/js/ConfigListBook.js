var ConfigListBook = {
    renderAvailable:function(data, type, row, meta){
        if (row.borrowing == '') {
            return '<strong class="text-success">Disponible</strong><br>' + ConfigListBook.btnBorrowing(row.id);
        }
        return  '<strong class="text-warning">Prestado</strong><br>' + ConfigListBook.btnDelivery(row.borrowing);
    },
    btnBorrowing:function(id){
        return ConfigListBasic.btn("Prestar", 'btn-info borrowing', "data-id='"+ id + "'");
    },
    btnDelivery:function(id) {
        return ConfigListBasic.btn("Recibir", 'btn-info delivery', "data-id='"+ id + "'");
    }
}
