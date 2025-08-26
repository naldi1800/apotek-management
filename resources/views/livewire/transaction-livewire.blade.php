<div class="col-6">
    <h4>Total: <span id="total-harga">{{ App\Helpers\Fungsi::rupiah($total) }}</span></h4>
    <div class="mb-3">
        <label for="total-uang" class="form-label">Total Uang</label>
        <input wire:model.live.debounce.300ms='money' type="number" class="form-control" id="total-uang">
    </div>
    <div class="mb-3">
        <label for="kembalian" class="form-label">Kembalian</label>
        <input wire:model='moneyReturn' type="text" class="form-control" id="kembalian" readonly>
    </div>

    <button class="btn btn-success {{ $disabledButton }}" id="btn-bayar" wire:click='bayar'>Bayar</button>


</div>
