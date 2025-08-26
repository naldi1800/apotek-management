<div class="mb-3 col-{{ $cols }} {{ $hidden ? 'visually-hidden' : '' }}">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    @if (!$disabled)
        @if ($isLivewire)
            <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
                id="{{ $name }}" class="form-control @error($name) is-invalid @enderror" wire:model.live="{{ $name }}" @if ($type == 'number') min="{{ $min }}" @endif>
        @else
            <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
                id="{{ $name }}" class="form-control @error($name) is-invalid @enderror" @if ($type == 'number') min="{{ $min }}" @endif>
        @endif
    @else
        @if ($isLivewire)
            <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
                id="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
                aria-describedby="{{ $name }}-help" wire:model.live="{{ $name }}" @if ($type == 'number') min="{{ $min }}" @endif disabled>
        @else
            <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
                id="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
                aria-describedby="{{ $name }}-help" @if ($type == 'number') min="{{ $min }}" @endif disabled>
        @endif
        @if ($help)
            <div id="{{ $name }}-help" class="form-text">{{ $help }}</div>
        @endif
    @endif
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
