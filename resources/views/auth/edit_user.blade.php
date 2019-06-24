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
                <div class="card-body text-white">
                    <form method="POST" action="{{ route('editUser') }}">
                        <input type="hidden" name="id" value="{{$user->id }}">
                            {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class=" control-label">*Nombre de usuario</label>
                            <input id="username" type="text" class="form-control" name="username"
                            value="{{ $user->username }}" required autofocus>
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class=" control-label">*Nombre</label>
                            <input id="name" type="text" class="form-control" name="name"
                            value="{{ $user->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class=" control-label">*E-Mail</label>
                            <input id="email" type="email" class="form-control" name="email"
                            value="{{ $user->email }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="roles">*Privelegios</label><br>
                            <select id="roles" name="roles[]" multiple class="form-control no-visible" required>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}"
                                        {{$user->hasRole($role->name) == true ? 'selected' : ''}}>
                                        {{$role->display_name}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('roles'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('roles') }}</strong>
                                </span>
                            @endif
                        </div>
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
