@extends('layouts.app')
@section('css_secondary')
@section('content')
@parent
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12 col-md-12 ">
            <h1>Categorías de Libros</h1>
            <a href="{{ route('category_view_add') }}">
                <button type="button" class="btn btn-primary mt-3 mb-3">
                    Nueva
                </button>
            </a>
            <table id="list_category" width="100%" class="table table-hover text-center no-visible"
            data-order="[[ 0, &quot;asc&quot; ]]">
                <thead>
                   <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de Alta</th>
                        <th data-orderable="false">Editar</th>
                        <th>Activo</th>
                        <th data-orderable="false">Borrar</th>
                   </tr>
               </thead>
               <tbody>
               </tbody>
               <tfoot>
                   <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de Alta</th>
                        <th>Editar</th>
                        <th>Activo</th>
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
                path_edit:"{{route('category_view_edit', ['id' => 0])}}",
                path_status:"{{route('category_view_delete', ['id' => 0])}}",
            };
            Path.init(paths);
            var data = [];
            var columns = [
                { data : "name", name:"name" },
                { data : "description", name:"description" },
                { data : "created_at", name:"created_at" },
                {
                    render:ConfigListBasic.renderEdit
                },
                {
                    render:ConfigListBasic.renderEstatus
                },
                {
                    render:ConfigListBasic.renderBtnEstatus
                },
            ];
            @foreach ($categorys as $category)
                data.push({
                    id : "{{$category->id}}",
                    name : "{{formatStringJS($category->name)}}",
                    description :"{{formatStringJS($category->description)}}",
                    created_at : "{{formatDate($category->created_at)}}",
                    deleted_at : "{{$category->deleted_at}}",
                });
            @endforeach
            List.init("list_category", data, columns);
        })
    </script>
@endsection
