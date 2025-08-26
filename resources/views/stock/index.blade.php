<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            Stock Obat
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-4 mb-3">
            {{-- <a href="{{ route('stock.create') }}" class="btn btn-outline-success">Tambah Stock</a> --}}
            <a href="{{route('stock.manastock')}}" class="btn btn-outline-info">Management Stock</a>
        </div>
        <div class="col-12">
            <table class="table-responsive table table-bordered border-dark">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th style="width: 5%;">#</th>
                        <th style="width: 15%;">Obat</th>
                        <th style="width: 10%;">Nomor Batch</th>
                        <th style="width: 10%;">Tanggal Kedaluwarsa</th>
                        <th style="width: 10%;">Tanggal Stok</th>
                        <th style="width: 10%;">Qty Awal</th>
                        <th style="width: 10%;">Qty Saat Ini</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($stocks) || $stocks->isEmpty())
                        <tr class="text-center">
                            <th colspan="9">Tidak ada data</th>
                        </tr>
                    @else
                        @foreach ($stocks as $stock)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-start">{{ $stock->medicine->generic_name ?? '-' }}</td>
                                <td>{{ $stock->batch_number }}</td>
                                <td>{{ $stock->expiry_date }}</td>
                                <td>{{ $stock->stock_date }}</td>
                                <td>{{ $stock->initial_quantity }}</td>
                                <td>{{ $stock->current_quantity }}</td>
                                <td>
                                    <span class="badge 
                                        @if($stock->status == 'tersedia') bg-success 
                                        @elseif($stock->status == 'expire') bg-warning 
                                        @else bg-danger @endif">
                                        {{ ucfirst($stock->status) }}
                                    </span>
                                </td>
                                <td class="d-flex justify-content-evenly">
                                    {{-- <a href="{{ route('stock.update', ['id' => $stock->id]) }}" class="btn btn-outline-info">Update</a> --}}
                                    <form action="{{route('stock.delete', ['id' => $stock->id])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-main>
