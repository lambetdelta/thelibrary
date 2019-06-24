@extends('layouts.app')
@section('content')
@parent
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <h1>Perfil</h1>
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">
                        Actualizar
                    </h5>
                </div>
                <div class="card-body text-primary">
                    <form method="POST" action="{{ route('updateProfile') }}">
                        {{ csrf_field() }}
                        @include('components.input',[
                            'label' => '*Email',
                            'name' => 'email',
                            'input' => 'email',
                            'type' => 'email',
                            'attributes' => 'required',
                            'value' =>  $user->email,
                            'small' => 'Correo electrónico único (No debe estar previamente dado de alta)'
                        ])
                        @include('components.input',[
                            'label' => '*Nombre Completo',
                            'name' => 'name_user',
                            'input' => 'name_user',
                            'attributes' => 'required',
                            'value' =>  $user->name
                        ])
                        <div class="mt-md-3 text-right">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_secondary')
    <script type="text/javascript" nonce="{{ $hash_secondary }}">
        $(document).ready(function(){
            multiselect('roles');
        });
    </script>
@endsection
