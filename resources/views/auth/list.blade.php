@extends('layouts.app')
@section('css_secondary')
@section('content')
@parent
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-10 col-md-12 ">
            <h1>Lista de usuarios</h1>
            <a href="{{ route('register') }}">
                <button class="btn btn-primary mb-3">
                    Nuevo
                </button>
            </a>
            <table id="list_user"  width="100%" class="table table-hover text-center no-visible" data-order="[[ 0, &quot;asc&quot; ]]">
                <thead>
                   <tr>
                       <th>Usuario</th>
                       <th>Nombre</th>
                       <th>Email</th>
                       <th>Estado</th>
                       <th>Privilegios</th>
                       <th>Editar</th>
                   </tr>
               </thead>
               <tbody>
               </tbody>
               <tfoot>
                   <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Privilegios</th>
                    <th>Editar</th>
                   </tr>
               </tfoot>
           </table>
        </div>
    </div>
</div>
@endsection
@section('js_secondary')
    <script type="text/javascript" src="{{asset('js/ConfigListUser.js')}}"></script>
    <script type="text/javascript" nonce="{{ $hash_secondary }}">
        $(document).ready(function(){
            var paths = {
                path_edit:"{{route('view_edit_user', ['user_id' => 0])}}",
            };
            Path.init(paths);
            var data = [];
            var columns = [
                { data : "username","name":"username" },
                { data : "name","name":"name" },
                { data : "email","email":"email" },
                {
                    render:ConfigListUser.renderActive
                },
                { data : "roles","roles":"roles" },
                {
                    render:ConfigListUser.renderEditProfile
                },
            ];
            @foreach ($users as $user)
                @php
                    $user_roles = $roles_users->where('user_id', $user->id);
                @endphp
                data.push({
                    id: "{{$user->id}}",
                    username: "{{$user->username}}",
                    name: "{{$user->name}}",
                    email: "{{$user->email}}",
                    active: "{{$user->active}}",
                    roles:"{{$user_roles->implode('display_name', ',')}}",
                });
            @endforeach
            List.init("list_user", data, columns);
        })
    </script>
@endsection