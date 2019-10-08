<div class="form-group @if($errors->has($property)) has-error @endif">
    <label class="col-sm-2 col-form-label">{{ \Illuminate\Support\Str::ucfirst($label) }}</label>
    {{ $slot }}
    @if($errors->has($property))
        <div class="help-block">{{ $errors->first($property) }}</div>
    @endif
</div>

