@extends('layouts.app')
@section('content')
@parent
<div class="container-fluid mt-3">
    <form id="delete-book" method="POST" action="{{ route('book_delete') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$book->id}}">
    <div class="row">
        <div class="col">
            <h1>Libros</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card border-primary">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title">
                        Eliminar
                    </h5>
                </div>
                <div class="card-body text-primary">
                    <div class="container-fluid">
                        <div class="row">
                            @include('components.label',[
                                'label' => 'Nombre',
                                'name' => 'name',
                                'value' =>  $book->name,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                            @include('components.label',[
                                'label' => 'Autor',
                                'name' => 'author',
                                'value' =>  $book->author,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                            @include('components.label',[
                                'label' => 'Fecha de Publicación',
                                'name' => 'published_date',
                                'value' =>  $book->published_date,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                            @include('components.label',[
                                'label' => 'Categoría',
                                'name' => 'category',
                                'value' =>  $book->category,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                        </div>
                        <div class="text-right">
                            <button id="send" type="button" class="btn btn-primary">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
@section('js_secondary')
    <script type="text/javascript" nonce="{{ $hash_secondary }}">
        $(document).ready(function(){
            document.getElementById('send').onclick = function(){
                confirm("Confirmación Necesaria", "Borrar un libro es una acción irreversible", "BORRAR",
                    "Cancelar", function(){
                        document.getElementById("delete-book").submit();
                    },"red");
            }
        });
    </script>
@endsection
