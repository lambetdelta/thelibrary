@extends('layouts.app')
@section('content')
@parent
<div class="container-fluid mt-3">
    <form method="POST" action="{{ route('member_add') }}" >
    <div class="row">
        <div class="col">
            <h1>Miembro</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">
                        Nuevo
                    </h5>
                </div>
                <div class="card-body text-primary">
                    {{ csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            @include('components.input',[
                                'label' => '*Nombre Completo',
                                'name' => 'first_name',
                                'input' => 'first_name',
                                'attributes' => 'required',
                                'value' =>  old('first_name'),
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                            @include('components.input',[
                                'label' => '*Apellidos',
                                'name' => 'last_name',
                                'input' => 'last_name',
                                'attributes' => 'required',
                                'value' =>  old('last_name'),
                                'form_group' => 'col-lg-6 col-md-6 col-sm-12 col-sx-12'
                            ])
                        </div>
                    </div>
                    <div class="mt-md-3 text-right">
                        <button type="submit" class="btn btn-primary">Registrar</button>
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

    </script>
@endsection
