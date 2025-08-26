<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="row">
        {{-- <div class="col-4 mb-3"> </div> --}}

        <div class="row col-12 text-center">
            <div class="col-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">
                        Total Obat
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $medicine }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">
                        Total Transaksi
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $transaction }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">
                        Total Barang Masuk
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $inventory }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">
                        Total Barang Keluar
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $inventory_keluar }}</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-main>