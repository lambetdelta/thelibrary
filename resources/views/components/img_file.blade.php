<div class="form-group {{ $errors->has($input) ? ' has-error' : '' }}">
    <label for="{{isset($id) ? $id : $name}}" class="control-label">{{$label}}</label>
    <input id="{{isset($id) ? $id : $name}}" name={{$name}} type="file" data-img="img-preview-{{isset($id) ? $id : $name}}"
    class="form-control img-preview {{isset($css) ? $css : ''}}" value="{{ isset($value) ? $value : '' }}"
    {{isset($attributes) ? $attributes : ''}} accept="{{ isset($accept) ? $accept : '' }}" autocomplete="off">
    @if (isset($small))
        <small id="small-{{isset($id) ? $id : $name}}" class="form-text text-muted mt-3">
            <i class="fas fa-info-circle"></i>{{$small}}
        </small>
    @endif
    <div class="container-img-preview">
        <img src="" alt="" id="img-preview-{{isset($id) ? $id : $name}}">
    </div>
    @if ($errors->has($input))
        <span class="help-block">
            <strong>{{ $errors->first($input) }}</strong>
        </span>
    @endif
</div>
