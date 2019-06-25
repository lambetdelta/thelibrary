<div class="form-group {{ $errors->has($input) ? ' has-error' : '' }}
    {{ isset($form_group) ? $form_group : '' }}">
    <label for="{{isset($id) ? $id : $name}}" class="control-label">{{$label}}</label>
    <textarea id="{{isset($id) ? $id : $name}}" name={{$name}} type="{{ isset($type) ? $type : 'text' }}"
    class="form-control {{isset($css) ? $css : ''}}" {{isset($attributes) ? $attributes : ''}}
    cols="{{ isset($cols) ? $cols : '30' }}" rows="{{ isset($rows) ? $rows : '5' }}" autocomplete="off">
        {{ isset($value) ? $value : '' }}
    </textarea>
    @if ($errors->has($input))
        <span class="help-block">
            <strong>{{ $errors->first($input) }}</strong>
        </span>
    @endif
</div>
