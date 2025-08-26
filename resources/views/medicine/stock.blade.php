<x-main>
    <x-slot name="header">
        <h2 class="ms-5 p-3">
            {{ __('Management Stock') }}
        </h2>
    </x-slot>
    <div class="row">
        <div class="col-4 mb-3">
        </div>
        <div class="col-12">
            @livewire('medicine-stock')
        </div>
</x-main>
