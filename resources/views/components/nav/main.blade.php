{{-- <style>
    /* Custom Styles */
    .curved-nav {
        /* background: linear-gradient(135deg, #001F3F, #3A6D8C); */
        background-color: var(--fg-palettes-color);
        color: var(--object-palettes-color);
        position: sticky;
        top: 0;
        z-index: 1030;
        border-radius: 0 0 50px 50px;
        /* Curved bottom edges */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .curved-nav a {
        color: var(--object-palettes-color);
        font-weight: bold;
    }

    .curved-nav a:hover {
        color: #FFFF;
        text-decoration: none;
    }

    .content {
        padding: 50px 15px;
        background: #f8f9fa;
        min-height: 100vh;
    }
</style>
<nav class="navbar navbar-expand-lg curved-nav">
    <div class="container">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @php
                $rute = request()->route()->uri();
                $rute = explode('/', $rute);
                @endphp
                <x-nav.link active="{{ request()->routeIs('home') }}" label="Home" href="{{ route('home') }}" />
                <x-nav.link active="{{ request()->routeIs('house') || in_array('house', $rute) }}" label="Kos Kosan"
                    href="{{ route('house') }}" />
                <x-nav.link active="{{ request()->routeIs('facility') || in_array('facility', $rute) }}"
                    label="Fasilitas Umum" href="{{ route('facility') }}" />
                {{-- <x-nav.link active="{{ request()->routeIs('facility') || in_array('facility', $rute) }}"
                    label="Fasilitas Kamar" href="{{ route('facility') }}" />
                <x-nav.link active="{{ request()->routeIs('facility') || in_array('facility', $rute) }}" label="Logout"
                    href="{{ route('logout') }}" />
            </ul>

        </div>
    </div>
</nav> --}}



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{Auth::guard('employee')->check() ? 'Pegawai' : 'Admin'}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @php
                    $rute = request()->route()->uri();
                    $rute = explode('/', $rute);
                @endphp
                @if(Auth::user() && Auth::guard('web')->check())
                    <x-nav.link active="{{ request()->routeIs('home') }}" label="Home" href="{{ route('home') }}" />
                    {{-- <x-nav.link active="{{ request()->routeIs('basket') || in_array('basket', $rute) }}"
                        label="Penjualan" href="{{ route('basket') }}" /> --}}
                    {{-- <x-nav.link active="{{ request()->routeIs('sparepart') || in_array('sparepart', $rute) }}"
                        label="Sparepart" href="{{ route('sparepart') }}" /> --}}
                    <x-nav.link active="{{ request()->routeIs('medicine') || in_array('medicine', $rute) }}" label="Obat"
                        href="{{ route('medicine') }}" />
                    <x-nav.link active="{{ request()->routeIs('stock') || in_array('stock', $rute) }}" label="Stock"
                        href="{{ route('stock') }}" />
                    <x-nav.link active="{{ request()->routeIs('transaction') || in_array('transaction', $rute) }}"
                        label="Histori Transaksi" href="{{ route('transaction') }}" />
                    <x-nav.link active="{{ request()->routeIs('inventory') || in_array('inventory', $rute) }}"
                        label="Data Barang Masuk/Keluar" href="{{ route('inventory') }}" />
                    <x-nav.link active="{{ request()->routeIs('employee') || in_array('employee', $rute) }}" label="Pegawai"
                        href="{{ route('employee') }}" />
                @elseif(Auth::guard('employee') && Auth::guard('employee')->check())
                    <x-nav.link active="{{ request()->routeIs('home-employee') }}" label="Home"
                        href="{{ route('home-employee') }}" />
                    <x-nav.link active="{{ request()->routeIs('basket') || in_array('basket', $rute) }}" label="Penjualan"
                        href="{{ route('basket') }}" />
                @endif
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" class="d-flex" method="POST">
                @csrf
                <button class="btn btn-outline-light" type="submit" form="logout-form">Logout</button>
            </form>
        </div>
    </div>
</nav>