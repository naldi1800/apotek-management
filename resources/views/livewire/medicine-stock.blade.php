<div>
    <div class="mb-3 row">
        <form
            action="{{ $selectedMode == 1 ? route('stock.create') : ($selectedMode == 2 ? route('stock.update') : '#') }}"
            method="post" class="">

            @csrf

            <div class="form-group col-12 mb-3">
                <label for="namaObat">Cari Obat</label>
                <select name="nama_obat" id="namaObat" wire:model.live="namaObat" class="form-control">
                    <option value="">-- Pilih Obat --</option>
                    @foreach ($medicines as $d)
                        <option value="{{ $d->id }}">
                            {{ $d->generic_name }} - {{ $d->brand_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="text" name="medicine_id" wire:model="medicine_id" hidden>
            <input type="text" name="stock_id" wire:model="stock_id" hidden>

            @if($selectMode)
                <div class="form-group col-12 mb-3">
                    <label for="selectedMode">Mode</label>
                    <select name="selectedMode" id="selectedMode" wire:model.live="selectedMode" class="form-control">
                        <option value="">-- Pilih Mode --</option>
                        <option value="1">Batch Baru</option>
                        <option value="2">Batch Lama</option>
                    </select>
                </div>

                @if($batchNumber != null && $batchNumber->count() == 0 && $selectedMode == 2)
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning!</strong> Obat ini belum memiliki batch. Silakan pilih mode "Batch Baru" untuk
                        menambahkan batch baru.
                    </div>
                @else
                    @if($selectedMode == 1)
                        <x-forms.input label="Batch Number" name="batch_number" type="text" isLivewire="1" />
                        @if($isBatchExist)
                            <div class="alert alert-warning" role="alert">
                                <strong>Warning!</strong> Obat dengan batch number yang sama sudah ada. Silakan pilih mode
                                "Batch
                                Lama"
                                untuk memperbarui stok pada batch yang sudah ada.
                            </div>
                        @else

                            <x-forms.input label="Tanggal Kadaluarsa" name="expiry_date" type="date" isLivewire="1" />
                            <x-forms.input label="Tanggal Masuk" name="stock_date" type="date" isLivewire="1" />
                            <x-forms.input label="Stok Awal" name="initial_quantity" type="number" isLivewire="1" />
                            <x-forms.input label="" name="quantity" type="number" isLivewire="1" hidden />

                            {{-- <div class="form-check ms-0">
                                <input name="current_quantity_same" id="current_quantity_same" type="checkbox"
                                    wire:model.live="current_quantity_same" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Sisa Stok sama dengan Stok Awal
                                </label>
                            </div> --}}

                            {{-- @if(!$current_quantity_same) --}}
                                <x-forms.input label="Sisa Stok" name="current_quantity" type="number" isLivewire="1" />
                            {{-- @else
                                <x-forms.input label="" name="current_quantity" type="number" isLivewire="1" hidden />
                            @endif --}}

                            <div class="form-group col-12 mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" wire:model.live="status" class="form-control">
                                    <option value="">-- Pilih Mode --</option>
                                    <option value="ditarik">Ditarik</option>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="expire">Expire</option>
                                </select>
                            </div>
                        @endif

                    @elseif($selectedMode == 2)
                        @if($batchNumber && $batchNumber->count())
                            @livewire('medicine-selectbatch', ['batchNumber' => $batchNumber,], key($namaObat))
                        @endif

                        <x-forms.input label="Tanggal Kadaluarsa" name="expiry_date" type="date" isLivewire="1" />
                        <x-forms.input label="Tanggal Masuk" name="stock_date" type="date" isLivewire="1" />
                        <x-forms.input label="Stok Awal" name="initial_quantity" type="number" isLivewire="1"
                            help="Stok tidak dapat di update, anda hanya bisa menambahkan batch baru atau menghapus batch ini"
                            disabled />
                        <x-forms.input label="Sisa Stok" name="current_quantity" type="number" isLivewire="1"
                            help="Stok tidak dapat di update, anda hanya bisa menambahkan batch baru atau menghapus batch ini"
                            disabled />
                        <x-forms.input label="Harga Beli" name="harga_beli" type="text" isLivewire="1" disabled />
                        <x-forms.input label="Harga Jual" name="harga_jual" type="text" isLivewire="1" disabled />
                        <div class="form-group col-12 mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" wire:model.live="status" class="form-control">
                                <option value="">-- Pilih Mode --</option>
                                <option value="ditarik">Ditarik</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="expire">Expire</option>
                            </select>
                        </div>
                    @endif

                    @if($selectedMode != null)
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    @endif
                @endif
            @endif
        </form>

    </div>
</div>