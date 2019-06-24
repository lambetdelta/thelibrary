<div class="form-group {{ $errors->has($input) ? ' has-error' : '' }}
    {{ isset($form_group) ? $form_group : '' }}">
    <label for="{{isset($id) ? $id : $name}}" class="control-label">
        {{$label}}
        @if ($deleted_at != null)
            <br>
            <span class="text-info">
                {{formatDate($deleted_at)}}
            </span>
        @endif
    </label>
    <select id="{{isset($id) ? $id : $name}}" name={{$name}} class="form-control {{isset($css) ? $css : ''}}"
    {{isset($attributes) ? $attributes : ''}}>
        <option value="1" {{$deleted_at == null ? 'selected' : ''}}>Activo</option>
        <option value="0" {{$deleted_at != null ? 'selected' : ''}}>Inactivo</option>
    </select>
    @if ($errors->has($input))
        <span class="help-block">
            <strong>{{ $errors->first($input) }}</strong>
        </span>
    @endif
</div>
