<div class="form-group {{ $errors->has($input) ? ' has-error' : '' }}">
    <label for="{{isset($id) ? $id : $name}}" class="control-label">{{$label}}</label>
    <select id="{{isset($id) ? $id : $name}}" name={{$name}} class="form-control {{isset($css) ? $css : ''}}" 
    {{isset($attributes) ? $attributes : ''}} multiple>
        @foreach ($collection as $item)
            <option value="{{$item->id}}" {{ isset($value) ? (in_array($item->id, $value)  ? 'selected' : '') : '' }}>
                {{$item->display_name}}
            </option>
        @endforeach
    </select>
    @if ($errors->has($input))
        <span class="help-block">
            <strong>{{ $errors->first($input) }}</strong>
        </span>
    @endif
</div>
