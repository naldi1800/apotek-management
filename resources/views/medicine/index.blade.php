<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            Data Obat
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-4 mb-3">
            <a href="{{route('medicine.create')}}" class="btn btn-outline-success">Tambah Data Obat</a>
        </div>
        <div class="col-12">
            <table class="table-responsive table table-bordered border-dark">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 15%;">Nama Generik</th>
                        <th scope="col" style="width: 15%;">Nama Merek</th>
                        <th scope="col" style="width: 10%;">Satuan</th>
                        <th scope="col" style="width: 15%;">Harga Beli</th>
                        <th scope="col" style="width: 15%;">Harga Jual</th>
                        <th scope="col" style="width: 15%;">Nomor BPOM</th>
                        <th scope="col" style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($datas))
                        <tr class="text-center">
                            <th scope="col" colspan="8">Tidak ada data</th>
                        </tr>
                    @else
                        @foreach ($datas as $d)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td class="text-start">{{ $d->generic_name }}</td>
                                <td class="text-start">{{ $d->brand_name }}</td>
                                <td class="text-center">{{ $d->unit }}</td>
                                <td class="text-end">{{ App\Helpers\Fungsi::rupiah($d->purchase_price) }}</td>
                                <td class="text-end">{{ App\Helpers\Fungsi::rupiah($d->selling_price) }}</td>
                                <td class="text-center">{{ $d->bpom_number }}</td>
                                <td class="d-flex justify-content-evenly">
                                    <a href="{{ route('medicine.update', ['id' => $d->id]) }}" class="btn btn-outline-info">Update</a>
                                    <form action="{{route('medicine.delete', ['id' => $d->id])}}" method="POST">
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
