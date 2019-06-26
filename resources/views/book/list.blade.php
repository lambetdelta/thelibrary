@extends('layouts.app')
@section('css_secondary')
@section('content')
@parent
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12 col-md-12 ">
            <h1>Libros</h1>
            <a href="{{ route('book_view_add') }}">
                <button type="button" class="btn btn-primary mt-3 mb-3">
                    Nuevo
                </button>
            </a>
            <table id="list_books" width="100%" class="table table-hover text-center no-visible"
            data-order="[[ 0, &quot;asc&quot; ]]">
                <thead>
                   <tr>
                        <th>Nombre</th>
                        <th>Autor</th>
                        <th>Categoría</th>
                        <th>Fecha de Publicación</th>
                        <th>Disponibilidad</th>
                        <th data-orderable="false">Editar</th>
                        <th data-orderable="false">Borrar</th>
                   </tr>
               </thead>
               <tbody>
               </tbody>
               <tfoot>
                   <tr>
                        <th>Nombre</th>
                        <th>Autor</th>
                        <th>Categoría</th>
                        <th>Fecha de Publicación</th>
                        <th>Disponibilidad</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                   </tr>
               </tfoot>
           </table>
        </div>
    </div>
</div>
@endsection
@section('js_secondary')
    <script src="{{ asset(mix('js/list_user.js')) }}"></script>
    <script type="text/javascript" nonce="{{ $hash_secondary }}">
        $(document).ready(function(){
            var paths = {
                path_edit:"{{route('book_view_edit', ['id' => 0])}}",
                path_delete:"{{route('book_view_delete', ['id' => 0])}}",
                path_lend:"{{route('lend')}}",
                path_return_book:"{{route('return_book')}}"

            };
            Path.init(paths);
            var data = [];
            var columns = [
                { data : "name", name:"name" },
                { data : "author", name:"author" },
                { data : "category", name:"category" },
                { data : "published_date", name:"published_date" },
                {
                    render:ConfigListBook.renderAvailable
                },
                {
                    render:ConfigListBasic.renderEdit
                },
                {
                    render:ConfigListBasic.renderDelete
                },
            ];
            @foreach ($books as $book)
                data.push({
                    id : "{{$book->id}}",
                    borrowing : "{{$book->borrowing}}",
                    name : "{{formatStringJS($book->name)}}",
                    autor : "{{formatStringJS($book->autor)}}",
                    category : "{{formatStringJS($book->category)}}",
                    published_date : "{{formatDate($book->published_date)}}",
                });
            @endforeach
            List.init("list_books", data, columns);
        })
    </script>
@endsection
