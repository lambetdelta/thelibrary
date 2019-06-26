@extends('layouts.app')
@section('content')
@parent
<div class="container-fluid mt-3">
    <form id="delete-category" method="POST" action="{{ route('category_delete') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$category->id}}">
    <div class="row">
        <div class="col">
            <h1>Miembro</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card border-primary">
                <div class="card-header text-white {{$category->deleted_at != null ? 'bg-warning' : 'bg-success'}}">
                    <h5 class="card-title">
                        Estatus
                    </h5>
                </div>
                <div class="card-body text-primary">
                    <div class="container-fluid">
                        <div class="row">
                            @include('components.select_active',[
                                'label' => '*Estatus',
                                'name' => 'status_category',
                                'input' => 'status_category',
                                'attributes' => 'required',
                                'deleted_at' =>  $category->deleted_at,
                                'form_group' => 'col-lg-4 col-md-6 col-sm-12 col-sx-12'
                            ])
                            <div class="alert alert-warning" role="alert">
                                <strong>Importante: </strong>No es posible borrar una categoría (esto para
                                 mantener la integridad de los registros) sin embargo si deseas que esta deje de
                                 aparecer en los buscadores de alta de registros solo cambia su estatus a inactivo
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                Estatus
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
@endsection
