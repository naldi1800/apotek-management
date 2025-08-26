<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ $mode . ' Pegawai' }}
        </h2>
    </x-slot>
    <div class="row">
        @php
            $set = isset($data);
        @endphp
        <div class="col-12 mb-3 row">
            <form action="{{ !$set ? route('employee.store') : route('employee.set', ['id' => $data->id]) }}"
                method="POST" class="row needs-validation" novalidate>
                @csrf
                @if ($set)
                    @method('put')
                @endif

                {{-- Input Name --}}
                <x-forms.input label="Nama" name="name" value="{{ $set ? $data->name : '' }}" />

                {{-- Input Email --}}
                <x-forms.input label="Email" name="email" type="email" value="{{ $set ? $data->email : '' }}" />

                @if(!$set)
                    {{-- Input Password --}}
                    <x-forms.input label="Password" name="password" type="password" />

                    {{-- Input Confirm Password --}}
                    <x-forms.input label="Confirm Password" name="confirm_password" type="password" />
                    {{-- Input Status --}}
                    {{-- @else --}}
                    {{-- <x-forms.select label="Status" name="status" :options="[
                            0 => 'Kasir Not Active',
                            1 => 'Kasir Active',
                            -1 => 'Employee is suspend'
                        ]" :selected="$set ? $data->status : 0" /> --}}
                @endif

                {{-- Tombol Submit --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-main>