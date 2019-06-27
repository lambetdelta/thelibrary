var ConfigListBook = {
    renderAvailable:function(data, type, row, meta){
        if (row.borrowing == '') {
            return '<strong class="text-success">Disponible</strong><br>' + ConfigListBook.btnBorrowing(row.id);
        }
        return  '<strong class="text-warning">Prestado</strong><br>' + ConfigListBook.btnDelivery(row.id);
    },
    btnBorrowing:function(id){
        return ConfigListBasic.btn("Prestar", 'btn-info borrowing', "data-id='"+ id + "'");
    },
    btnDelivery:function(id) {
        return ConfigListBasic.btn("Recibir", 'btn-info delivery', "data-id='"+ id + "'");
    }
}

var Borrowings = {
    books:[],
    init:function (books, members, class_borrowing, class_delivery) {
        $(document).on('click', class_borrowing,Borrowings.lend);
        Borrowings.books = books;
        Borrowings.members = members;
    },
    lend:function(){
        var id = this.dataset.id;
        $.confirm({
            title: "Préstamo",
            content: Borrowings.lendContent(id),
            type: "dark",
            theme: "modern",
            columnClass:"xlarge",
            onContentReady:Borrowings.initSelect,
            buttons: {
                ok: {
                    text: "Prestar",
                    btnClass: 'btn-primary',
                    action: Borrowings.evaluateLend
                },
                close: {
                    text: "Cancelar",
                    btnClass: 'btn-secondary',
                },
            },
          });
    },
    evaluateLend:function(){

    },
    lendContent:function(id) {
        var book = findObject(Borrowings.books,id,"id");
        if (book !=  false) {
            return "<h2>Libro</h2>" +
            "<div class='alert alert-info'><label>Nombre: <strong>" + book.name + "</strong></label><br>" +
            "<label>Autor: <strong>" + book.author + "</strong></label><br>" +
            "<label>Categoría: <strong>" + book.category + "</strong></label><br></div>" +
            "<div><label>Miembros</label><br><select id='members' class='form-control'></select></div>" ;
        }
        return "<div class='alert alert-danger'>Contacta a soporte</div>"
    },
    initSelect:function(){
        $('#members').selectize({
            valueField: 'id',
            options: Borrowings.members,
            render: {
                option: function(member, escape) {
                    return member.name + " " + member.last_name;
                }
            },
        });
    }
}
