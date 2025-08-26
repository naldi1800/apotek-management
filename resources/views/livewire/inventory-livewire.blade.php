<div class="row">
    <div class="d-flex align-items-end justify-content-center mb-3 col-12">
        <div class="col ms-2">
            <label for="from" class="form-label">Dari Tanggal</label>
            <input wire:model='from' type="date" class="form-control" id="from" name="from">
        </div>
        <div class="col ms-2">
            <label for="to" class="form-label">Sampai Tanggal</label>
            <input wire:model='to' type="date" class="form-control" id="to" name="to">
        </div>
        <div class="col-2 ms-2 row d-flex align-items-between">
            <button wire:click='search' type="submit" class="btn btn-primary col">Cari</button>
            <button wire:click='toNowMonth' type="button" class="btn btn-info text-white col ms-1">Bulan ini</button>
        </div>

    </div>

    <div class="col-12 mt-3">
        <p class="text-center">
            @if (\Carbon\Carbon::parse($from)->format('F Y') == \Carbon\Carbon::parse($to)->format('F Y'))
                Menampilkan data tanggal:
                <strong>{{ \Carbon\Carbon::parse($from)->format('d') }}-{{ \Carbon\Carbon::parse($to)->format('d') }}
                    {{ \Carbon\Carbon::parse($to)->format('F Y') }}</strong>
            @else
                Menampilkan data dari tanggal <strong>{{ \Carbon\Carbon::parse($from)->format('d F Y') }}</strong>
                sampai tanggal <strong>{{ \Carbon\Carbon::parse($to)->format('d F Y') }}</strong>
            @endif
        </p>
    </div>
    <div class="col-12 mb-2">
        <a href="{{ route('inventory.generatePdf', ['from' => $from, 'to' => $to]) }}" class="btn btn-success">
            PDF
        </a>
        <a href="{{ route('inventory.print', ['from' => $from, 'to' => $to]) }}" class="btn btn-info" target="_blank">
            Print
        </a>
    </div>
    <div class="col-12 mb-2">
        <label for="page" class="form-label">Jumlah data perhalaman</label>
        <select wire:model.live='halaman' class="form-control" id="halaman" name="halaman">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>


    <table class="table table-bordered mt-2 col-12">
        <thead>
            <tr class="text-center text-align-middle text-capitalize">
                <th>No</th>
                <th>Nama Obat</th>
                <th>Batch Number</th>
                <th>Keteragan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @if($datas->isEmpty())
                <tr class="text-center text-align-middle text-capitalize">
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            @else
                @php
                    $no = ($datas->currentPage() - 1) * $datas->perPage() + 1;
                @endphp
                @foreach ($datas as $d)
                    <tr class="text-center text-align-middle text-capitalize">
                        <td>{{ $no++ }}</td>
                        <td>{{ $d->medicine->generic_name }}</td>
                        <td>{{ $d->stock->batch_number }}</td>
                        <td>{{ $d->type }}</td>
                        <td>{{ $d->quantity }}</td>
                        <td>{{ $d->date }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>


    <div class="d-flex justify-content-between col-3 mb-2">
        @if ($datas->onFirstPage())
            <button class="btn btn-outline-secondary" disabled>Prev</button>
        @else
            <button class="btn btn-outline-secondary" wire:click="previousPage">Prev</button>
        @endif

        @php
            $totalPages = $datas->lastPage();
            $currentPage = $datas->currentPage();
            $start = $totalPages <= 5 ? 1 : max(1, $currentPage - 2);
            $end = $totalPages <= 5 ? $totalPages : min($totalPages, $start + 4);
        @endphp

        @if ($start > 1)
            <button class="btn btn-outline-secondary" wire:click="gotoPage(1)">1</button>
            <button class="btn btn-outline-secondary" disabled>...</button>
        @endif

        @for ($i = $start; $i <= $end; $i++)
            <button class="btn btn-outline-secondary {{ $i == $currentPage ? 'active' : '' }}"
                wire:click="gotoPage({{ $i }})">
                {{ $i }}
            </button>
        @endfor

        @if ($end < $totalPages)
            <button class="btn btn-outline-secondary" disabled>...</button>
            <button class="btn btn-outline-secondary" wire:click="gotoPage({{ $totalPages }})">{{ $totalPages }}</button>
        @endif


        @if ($datas->hasMorePages())
            <button class="btn btn-outline-secondary" wire:click="nextPage">Next</button>
        @else
            <button class="btn btn-outline-secondary" disabled>Next</button>
        @endif
    </div>

    <div class="col-12 mb-4">
        <span>Menampilkan {{ $datas->firstItem() }} - {{ $datas->lastItem() }} dari {{ $datas->total() }} data</span>
    </div>


</div>