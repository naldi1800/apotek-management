<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ $mode . ' Medicine' }}
        </h2>
    </x-slot>
    <div class="row">
        @php
            $set = isset($data);
        @endphp
        <div class="col-12 mb-3 row">
            <form action="{{ !$set ? route('medicine.store') : route('medicine.set', ['id' => $data->id]) }}"
                method="POST" class="row needs-validation" novalidate>
                @csrf
                @if ($set)
                    @method('put')
                @endif

                {{-- Input Generic Name --}}
                <x-forms.input label="Generic Name" name="generic_name" value="{{ $set ? $data->generic_name : '' }}" />

                {{-- Input Brand Name --}}
                <x-forms.input label="Brand Name" name="brand_name" value="{{ $set ? $data->brand_name : '' }}" />

                {{-- Input Unit --}}
                <x-forms.input label="Unit" name="unit" value="{{ $set ? $data->unit : '' }}" help="Ex: tablet, bottle, box" />

                {{-- Input Purchase Price --}}
                <x-forms.input label="Purchase Price" name="purchase_price" type="number" step="0.01"
                    value="{{ $set ? $data->purchase_price : '' }}" />

                {{-- Input Selling Price --}}
                <x-forms.input label="Selling Price" name="selling_price" type="number" step="0.01"
                    value="{{ $set ? $data->selling_price : '' }}" />

                {{-- Input BPOM Number --}}
                <x-forms.input label="BPOM Number" name="bpom_number" value="{{ $set ? $data->bpom_number : '' }}" />

                {{-- Tombol Submit --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-main>
