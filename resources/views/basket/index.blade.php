<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            Transaksi
        </h2>
    </x-slot>
    <div class="container">
        {{-- Input Field Nama Barang dan Tombol Search --}}
        <div class="row mb-3">
            <div class="col-12">
                {{-- <form method="GET" action="{{ route('search.sparepart') }}">
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        class="form-control" placeholder="Cari barang...">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
                <div id="result"></div> --}}
                @livewire('medicine-search')
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                @livewire('basket')
            </div>
            <livewire:transaction-livewire/>
        </div>
    </div>
</x-main>
