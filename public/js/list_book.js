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


var Borrowings = {
    books:[],
    init:function (books, members, class_borrowing, class_delivery) {
        $(document).on('click', class_borrowing,Borrowings.lend);
        $(document).on('click', class_delivery,Borrowings.receiveAsk);
        Borrowings.books = books;
        Borrowings.members = members;
    },
    receiveAsk:function(){
        var borrowing_id = this.dataset.id;
        confirm("Recibir", "¿Cambiar el estado del libro a disponible?" , "Si", "No",
        function(){
            Borrowings.receive(borrowing_id);
        });
    },
    receive:function(borrowing_id){
        var request = $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : "post",
            url : Path.path_return_book,
            data: {
                borrowing_id:borrowing_id
            },
        });
        request.then(Borrowings.lendReceive, HttpResponses.errorMs);
    },
    lendReceive:function(response){
        alert('Libro Devuelto');
        location.reload();
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
                    action: Borrowings.requestLend
                },
                close: {
                    text: "Cancelar",
                    btnClass: 'btn-secondary',
                },
            },
          });
    },
    requestLend:function(){
        var book_input = document.getElementById("book-id");
        var select_member = document.getElementById("members");
        if (book_input != null && select_member != null) {
            var request = $.ajax({
                            headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type : "post",
                            url : Path.path_lend,
                            data: {
                                book_id:book_input.value,
                                member_id:select_member.value,
                            },
                        });
            request.then(Borrowings.lendResponse, HttpResponses.errorMs);
        }
    },
    lendResponse:function(response){
        alert('Libro Prestado');
        location.reload();
    },
    lendContent:function(id) {
        var book = findObject(Borrowings.books,id,"id");
        if (book !=  false) {
            return "<h2>Libro</h2>" +
            "<input type='hidden' id='book-id' value='" + book.id + "'>" +
            "<div class='alert alert-info'><label>Nombre: <strong>" + book.name + "</strong></label><br>" +
            "<label>Autor: <strong>" + book.author + "</strong></label><br>" +
            "<label>Categoría: <strong>" + book.category + "</strong></label><br></div>" +
            "<div><label>Miembros</label><br><select id='members' class='form-control'>" +
            Borrowings.optionMember() +  "</select></div>" ;
        }
        return "<div class='alert alert-danger'>Contacta a soporte</div>"
    },
    optionMember:function(){
        var length = Borrowings.members.length;
        var option = "";
        for (let index = 0; index < length; index++) {
            const member = Borrowings.members[index];
            option += "<option value='" + member.id + "'>" + member.first_name + " " +member.last_name + "</option>"
        }
        return option;
    }
}
