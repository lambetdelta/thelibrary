@extends('layouts.app')
@section('content')
@parent
<div class="container-fluid mt-3">
    <form method="POST" action="{{ route('category_edit') }}" >
    <div class="row">
        <div class="col">
            <h1>Categoría de Libro</h1>
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
                <div class="card-body text-white">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <div class="container-fluid">
                        <div class="row">
                            @include('components.input',[
                                'label' => '*Nombre',
                                'name' => 'name',
                                'input' => 'name',
                                'attributes' => 'required',
                                'value' =>  $category->name,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                            @include('components.textarea',[
                                'label' => 'Descripción',
                                'name' => 'description',
                                'input' => 'description',
                                'value' =>  $category->description,
                                'attributes' => 'required',
                                'form_group' => 'col-lg-12 col-md-12 col-sm-12 col-sx-12'
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
