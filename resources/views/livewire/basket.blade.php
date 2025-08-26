<div>
    <h4>Keranjang</h4>
    <h6>Nota : {{$nota}}</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($baskets as $basket)
                <tr >
                    <td>{{ $basket->medicine->generic_name }}</td>
                    <td>{{ $basket->jumlah }}</td>
                    <td>Rp {{ number_format($basket->subtotal, 2, ',', '.') }}</td>
                    <td>
                        <button wire:click="addItem({{$basket->id}})" class="btn btn-info">+</button>
                        <button wire:click="subItem({{$basket->id}})" class="btn btn-secondary">-</button>
                        <button wire:click="removeItem({{ $basket->id }})" class="btn btn-danger">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
