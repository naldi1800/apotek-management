<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Home Pegawai') }}
        </h2>
    </x-slot>
    <div class="row">
        {{-- <div class="col-4 mb-3"> </div> --}}

        <div class="row col-12 text-center">
            <div class="col-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">
                        Transaksi Hari ini
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $transaction_today }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">
                        Transaksi 1 Minggu ini
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $transaction_1week }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">
                        Transaksi 1 Bulan ini
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $transaction_1month }}</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-main>