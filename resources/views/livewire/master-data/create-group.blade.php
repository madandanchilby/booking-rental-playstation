@section('title', 'Tambah Group Produk')

<div>
    <form wire:submit="store">
        <div class="card">
            <h5 class="card-header">Tambah Group Produk</h5>

            <div class="card-body">
                <div class="mb-3">
                    <label for="group_name" class="form-label">Nama Group</label>
                    <input wire:model="form.group_name" type="text" id="group_name" class="form-control"
                        placeholder="Masukan nama grup" required>
                    @error('form.group_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @error('form.items')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button type="button" wire:click="add_item" class="btn btn-info">Tambah Item</button>
                <button type="button" wire:click="delete_item" class="btn btn-danger">Hapus Item</button>
                <div class="mb-3">
                    @for ($i = 0; $i < sizeof($form->items); $i++)
                        <div key="{{ uniqid('item_input_') }}" class="row">
                            <div class="col-6">
                                <label for="form.items.{{ $i }}.item_name" class="form-label">Nama
                                    Item</label>
                                <input wire:model="form.items.{{ $i }}.item_name" type="text"
                                    id="form.items.{{ $i }}.item_name" class="form-control"
                                    placeholder="Nama item" required>
                                @error('form.items.{{ $i }}.item_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="form.items.{{ $i }}.item_price" class="form-label">Harga
                                    Item</label>
                                <input wire:model="form.items.{{ $i }}.item_price" type="numeric"
                                    id="form.items.{{ $i }}.item_price" class="form-control"
                                    placeholder="Masukan harga per item" required>
                                @error('form.items.{{ $i }}.item_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="mb-3">
                    <div class="col-4">
                        <div class="form-check mt-3">
                            <input wire:model="form.is_multiple" class="form-check-input" type="checkbox"
                                id="is_multiple" />
                            <label class="form-check-label" for="is_multiple">Pilihan Lebih Dari 1</label>
                        </div>
                        @error('form.is_multiple')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-check">
                            <input wire:model="form.is_optional" class="form-check-input" type="checkbox"
                                id="is_optional" />
                            <label class="form-check-label" for="is_optional">Optional</label>
                        </div>
                        @error('form.is_optional')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>

    @livewire('components.notification-toast')

    @script
        <script>
            $wire.on('create-group-product', (detail) => {
                const {
                    type,
                    message
                } = detail[0]
                const toastEl = $('#notification-toast')
                const toastBody = $('#notification-toast .toast-body')

                if (type === 'error') {
                    toastEl.removeClass('bg-success')
                    toastEl.addClass('bg-danger')
                } else {
                    toastEl.removeClass('bg-danger')
                    toastEl.addClass('bg-success')
                }
                const toast = new bootstrap.Toast(toastEl)
                toastBody.text(message)
                toast.show()
                if (type !== 'error') {
                    window.location.href = '/master-data/grup-produk'
                }
            })
        </script>
    @endscript
</div>
