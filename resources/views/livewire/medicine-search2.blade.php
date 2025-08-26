<div>
    <div class="mb-3 row">
        <input type="text" class="form-control col-8" name="search" placeholder="Cari barang..." wire:model.live.debounce.300ms="search">
        {{-- <button wire:click="searchFromEvent" class="btn btn-secondary col-2">
            Search
        </button> --}}
    </div>

    @if ($medicine && $medicine->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $index => $medicine)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $medicine->nama_barang }}</td>
                        <td>Rp {{ number_format($medicine->harga_jual, 2, ',', '.') }}</td>
                        <td>
                            <button wire:click.prevent="addToBasketButton({{$medicine->id}})" class="btn btn-success">
                                Tambah
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Obat tidak ditemukan.</p>
    @endif
</div>
