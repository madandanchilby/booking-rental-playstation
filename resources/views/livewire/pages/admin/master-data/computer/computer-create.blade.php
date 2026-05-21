<div>
    @section('title', 'Tambah PlayStation')
    <form wire:submit="save">
        <div class="card">
            <h5 class="card-header">Tambah PlayStation</h5>
            <div class="card-body">
                <div class="mb-3">
                    <label for="computer_number" class="form-label">Nama PlayStation</label>
                    <input wire:model="form.computer_number" type="text" id="computer_number" class="form-control"
                        placeholder="Masukan nama produk" required>
                    @error('form.computer_number')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="booking_price_per_hour" class="form-label">Harga Per Jam</label>
                    <input wire:model="form.booking_price_per_hour" type="text" id="booking_price_per_hour"
                        class="form-control" placeholder="Masukan harga produk" required>
                    @error('form.booking_price_per_hour')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>

    {{-- @livewire('components.notification-toast')

    @script
        <script>
            $wire.on('create-product', (detail) => {
                const {type, message} = detail[0]
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
                    window.location.href = '/master-data/menu'
                }
            })
        </script>
    @endscript --}}
</div>
