@extends('layouts.app')
@section('content')
@parent
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <h1>Actualizar</h1>
            <div class="card border-primary">
                <div class="card-header {{$user->active == 1 ? 'bg-success' : 'bg-warning'}} text-white">
                    <h5 class="card-title">
                        usuario: <strong>{{ $user->username }}</strong>
                    </h5>
                </div>
                <div class="card-body text-primary">
                    <form method="POST" action="{{ route('editUser') }}">
                        <input type="hidden" name="id" value="{{$user->id }}">
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
                        <div class="form-group">
                            <label for="active">*Estado</label><br>
                            <select id="active" name="active" class="form-control" autocomplete="off">
                                <option value="1" {{$user->active == 1 ? 'selected' : ''}}>Activo</option>
                                <option value="0" {{$user->active == 0 ? 'selected' : ''}}>Inactivo</option>
                            </select>
                            @if ($errors->has('active'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('active') }}</strong>
                                </span>
                            @endif
                        </div>
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
