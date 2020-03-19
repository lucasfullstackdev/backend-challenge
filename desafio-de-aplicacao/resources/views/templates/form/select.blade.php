<label class="{{ $label ?? null }}">
    <span>{{ $label ?? null }}</span>
    {!! Form::select( $input ?? null, ['free' => 'Free', 'premium' => 'Premium'], 'free') !!}
</label>