<div class="form-group {{ isset($form_group) ? $form_group : '' }}">
    <label for="{{isset($id) ? $id : $name}}" class="control-label">{{$label}}</label>
    <input id="{{isset($id) ? $id : $name}}" name={{$name}} type="{{ isset($type) ? $type : 'text' }}"
    class="form-control {{isset($css) ? $css : ''}}" value="{{ isset($value) ? $value : '' }}"
    {{isset($attributes) ? $attributes : ''}} title="{{ isset($value) ? $value : '' }}" readonly>
</div>
