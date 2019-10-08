<div class="form-group row @if($errors->has($property)) has-error @endif">
    <label class="col-sm-2 col-form-label">{{ \Illuminate\Support\Str::ucfirst($label) }}</label>
    <div class="col-sm-10">
        {{ $slot }}
        @if($errors->has($property))
            <div class="help-block">{{ $errors->first($property) }}</div>
        @endif
    </div>
</div>

