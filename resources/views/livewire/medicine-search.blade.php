<div>
    <div class="mb-3 row">
        <input type="text" class="form-control col-8" name="search" placeholder="Cari barang..."
            wire:model.live.debounce.300ms="search">
        {{-- <button wire:click="searchFromEvent" class="btn btn-secondary col-2">
            Search
        </button> --}}
    </div>

    @if ($medicines && $medicines->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $index => $medicine)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $medicine->generic_name . '-' . $medicine->brand_name }}</td>
                        <td>Rp {{ number_format($medicine->selling_price, 2, ',', '.') }}</td>
                        <td>
                            {{-- @dd($medicine) --}}
                            @if($medicine->stock->count() > 0)
                                <button wire:click.prevent="addToBasketButton({{$medicine->id}})" class="btn btn-success">
                                    Tambah
                                </button>
                            @else
                                <button class="btn btn-danger" disabled>
                                    Stock Tidak Tersedia
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Obat tidak ditemukan.</p>
    @endif
</div>