{{--
    Helper for form controls, horizontal layout

    $label    [  $name  ]
              errormessage

--}}
<div class="form-group">
    <label class="{{ $required ?? '' }}" for="{{ $name }}">{{ $label }}</label>

    <input type="{{ $type ?? 'text' }}"
           class="form-control  {{ $errors->has($name)? 'is-invalid' : ''}}"
           id="{{ $name }}"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? '' }}"
           value="{{ $value ?? '' }}"
           {{ $required ?? '' }}>

    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif

</div>