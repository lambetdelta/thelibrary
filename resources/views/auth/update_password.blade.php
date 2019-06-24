@extends('layouts.app')

@section('content')
@parent
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-8 col-sm-12 col-xs-12">
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">Actualizar Contraseña</div>
                <div class="card-body">
                    <form id="form-update-password" class="form-horizontal" method="POST" action="{{ route('updatePassword') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="current-password" class="control-label">*Contraseña actual</label>
                            <div>
                                <input id="current-password" type="password" class="form-control" name="current-password" required>

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">*Contraseña</label>
                            <div>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="repeat-password" class="control-label">*Repetir contraseña</label>
                            <div>
                                <input id="repeat-password" type="password" class="form-control" name="repeat-password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button id="send-form" type="button" class="btn btn-primary">
                                    Actualizar
                                </button>
                            </div>
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
        function sendForm(){
            document.getElementById("form-update-password").submit();
        }
        EvaluatePassword.init("password", "repeat-password", "send-form", sendForm);
    })
</script>
@endsection
