

    <label for="{{ $name }}">{{ $label }}</label>

    <input type="{{ $type ?? 'text' }}" class="form-control" id="{{ $name }}"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '' }}" {{ $required ?? '' }}>

    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif