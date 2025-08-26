<div class="form-group  col-{{ $cols }} mb-3">
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select select2">
            <option>Pilih</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{($selected == $value)? 'selected' : ''}}>{{ $text }}</option>
        @endforeach
    </select>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select an option',
            allowClear: true
        });
    });
</script>
