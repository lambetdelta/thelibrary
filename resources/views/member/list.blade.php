@extends('layouts.app')
@section('css_secondary')
@section('content')
@parent
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12 col-md-12 ">
            <h1>Miembros</h1>
            <a href="{{ route('member_view_add') }}">
                <button type="button" class="btn btn-primary mt-3 mb-3">
                    Nuevo
                </button>
            </a>
            <table id="list_members" width="100%" class="table table-hover text-center no-visible"
            data-order="[[ 0, &quot;asc&quot; ]]">
                <thead>
                   <tr>
                        <th>Nombre Completo</th>
                        <th>Apellidos</th>
                        <th>Fecha de Alta</th>
                        <th data-orderable="false">Editar</th>
                        <th data-orderable="false">Borrar</th>
                   </tr>
               </thead>
               <tbody>
               </tbody>
               <tfoot>
                   <tr>
                        <th>Nombre Completo</th>
                        <th>Apellidos</th>
                        <th>Fecha de Alta</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                   </tr>
               </tfoot>
           </table>
        </div>
    </div>
</div>
@endsection
@section('js_secondary')
    <script type="text/javascript" nonce="{{ $hash_secondary }}">
        $(document).ready(function(){
            var paths = {
                path_edit:"{{route('member_view_edit', ['id' => 0])}}",
                path_delete:"{{route('member_view_delete', ['id' => 0])}}",
            };
            Path.init(paths);
            var data = [];
            var columns = [
                { data : "first_name", name:"first_name" },
                { data : "last_name", name:"last_name" },
                { data : "created_at", name:"created_at" },
                {
                    render:ConfigListBasic.renderEdit
                },
                {
                    render:ConfigListBasic.renderDelete
                },
            ];
            @foreach ($members as $member)
                data.push({
                    id : "{{$member->id}}",
                    first_name : "{{$member->first_name}}",
                    last_name : "{{$member->last_name}}",
                    created_at : "{{formatDate($member->created_at)}}",
                });
            @endforeach
            List.init("list_members", data, columns);
        })
    </script>
@endsection
