<!-- resources/views/livewire/transaction-view-livewire.blade.php -->
<div class="row">
    <div class="col-4 mb-3">
        <input type="text" class="form-control" id="search" placeholder="Cari nota..."
            wire:model.live.debounce.300ms="search">
    </div>

    <div class="col-12">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nota</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Jumlah Pembelian</th>
                    <th scope="col">Harga Satuan</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Total Transaksi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @if ($transactions && $transactions->count() > 0)
                    @foreach ($transactions as $transaction)
                        @if ($transaction->transactionModels->count() > 0)
                            @foreach ($transaction->transactionModels as $index => $model)
                                <tr>
                                    @if ($index === 0)
                                        <th class="align-middle text-center" scope="row" rowspan="{{ $transaction->transactionModels->count() }}">
                                            {{ $loop->parent->index + 1 }}
                                        </th>
                                        <td class="align-middle text-center" rowspan="{{ $transaction->transactionModels->count() }}">
                                            {{ $transaction->nomor_nota }}
                                        </td>
                                    @endif
                                    
                                    <td>{{ $model->medicine->generic_name }}</td>
                                    <td class="align-middle text-center">{{ $model->jumlah }}</td>
                                    <td class="align-middle text-end">{{ App\Helpers\Fungsi::rupiah($model->harga_satuan) }}</td>
                                    <td class="align-middle text-end">{{ App\Helpers\Fungsi::rupiah($model->subtotal) }}</td>
                                    
                                    @if ($index === 0)
                                        <td class="align-middle text-end" rowspan="{{ $transaction->transactionModels->count() }}">
                                            {{ App\Helpers\Fungsi::rupiah($transaction->total_harga) }}
                                        </td>
                                        <td class="align-middle text-center" rowspan="{{ $transaction->transactionModels->count() }}">
                                            {{ $transaction->tanggal_transaksi }}
                                        </td>
                                        <td class="align-middle" rowspan="{{ $transaction->transactionModels->count() }}">
                                            {{ $transaction->keterangan }}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $transaction->nomor_nota }}</td>
                                <td colspan="5" class="text-center">Tidak ada item transaksi</td>
                                <td class="align-middle text-end">{{ App\Helpers\Fungsi::rupiah($transaction->total_harga) }}</td>
                                <td class="align-middle text-center">{{ $transaction->tanggal_transaksi }}</td>
                                <td class="align-middle">{{ $transaction->keterangan }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr class="text-center">
                        <td colspan="9">Tidak ada data transaksi</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>