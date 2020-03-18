<label class="{{ $class ?? null }}">
    <span>{{ $label ?? null }}</span>
    {!! Form::password($input, $attributes) !!}
</label>