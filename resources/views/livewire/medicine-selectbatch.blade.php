<div class="form-group col-12 mb-3">
    <label for="batchNumber">Batch Number</label>
    <select wire:model.live="selectedBatch" class="form-control">
        <option value="">-- Pilih Batch Number --</option>
        @foreach ($batchNumber as $d)
            <option value="{{ $d->id }}">
                {{ "Batch: $d->batch_number, Expire: $d->expiry_date" }}
            </option>
        @endforeach
    </select>
</div>