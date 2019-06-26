@extends('layouts.app')
@section('content')
@parent
<div class="container-fluid mt-3">
    <form id="delete-member" method="POST" action="{{ route('member_delete') }}">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$member->id}}">
    <div class="row">
        <div class="col">
            <h1>Miembro</h1>
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
                                'label' => 'Nombre Completo',
                                'name' => 'first_name',
                                'value' =>  $member->first_name,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                            @include('components.label',[
                                'label' => 'Apellidos',
                                'name' => 'first_name',
                                'value' =>  $member->first_name,
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <strong>Importante: </strong>Una vez que borres el miembro todos los registros de
                            los préstamos realizados a él serán borrado también.
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
                confirm("Confirmación Necesaria", "Borrar un miembro es una acción irreversible", "BORRAR",
                    "Cancelar", function(){
                        document.getElementById("delete-member").submit();
                    },"red");
            }
        });
    </script>
@endsection
