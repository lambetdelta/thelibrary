@extends('layouts.app')
@section('content')
@parent
<div class="container-fluid mt-3">
    <form method="POST" action="{{ route('book_edit') }}" >
    <div class="row">
        <div class="col">
            <h1>Libros</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">
                        Editar
                    </h5>
                </div>
                <div class="card-body text-primary">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$book->id}}">
                    <div class="container-fluid">
                        <div class="row">
                            @include('components.input',[
                                'label' => '*Nombre',
                                'name' => 'name',
                                'input' => 'name',
                                'attributes' => 'required',
                                'value' =>  $book->name,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                            @include('components.input',[
                                'label' => '*Autor',
                                'name' => 'author',
                                'input' => 'author',
                                'attributes' => 'required',
                                'value' =>  $book->author,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                            @include('components.input',[
                                'label' => '*Fecha de Publicación',
                                'name' => 'published_date',
                                'input' => 'published_date',
                                'css' => 'date',
                                'attributes' => 'required',
                                'value' =>  $book->published_date,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                                @include('components.select_catalog',[
                                'label' => '*Categoría',
                                'name' => 'book_category_id',
                                'input' => 'book_category_id',
                                'attributes' => 'required',
                                'value' =>  $book->book_category_id,
                                'css' => 'selectize',
                                'collection' => $categorys,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                        </div>
                    </div>
                    <div class="mt-md-3 text-right">
                        <button type="submit" class="btn btn-primary">Editar</button>
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
            dateInput('.date');
            $('.selectize').selectize();
        });
    </script>
@endsection
