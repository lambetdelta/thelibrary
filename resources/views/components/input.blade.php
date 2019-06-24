<div class="form-group {{ $errors->has($input) ? ' has-error' : '' }}
    {{ isset($form_group) ? $form_group : '' }}">
    <label for="{{isset($id) ? $id : $name}}" class="control-label">{{$label}}</label>
    <input id="{{isset($id) ? $id : $name}}" name={{$name}} type="{{ isset($type) ? $type : 'text' }}"
    class="form-control {{isset($css) ? $css : ''}}" value="{{ isset($value) ? $value : '' }}"
    {{isset($attributes) ? $attributes : ''}} autocomplete="off">
    @if ($errors->has($input))
        <span class="help-block">
            <strong>{{ $errors->first($input) }}</strong>
        </span>
    @endif
    @if (isset($small))
        <small id="small-{{isset($id) ? $id : $name}}" class="form-text text-muted">
            {{$small}}
        </small>
    @endif
</div>
