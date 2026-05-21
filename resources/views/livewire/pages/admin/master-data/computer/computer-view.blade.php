@section('title', 'View PlayStation')

<div class="card">
    <div class="card-header">
        <h3>Detail PlayStation</h3>
        <div class="d-flex gap-4">
            <a href="{{ route('admin.master-data.computer.edit', ['computer' => $computer]) }}" class="btn btn-secondary">Edit</a>
            <button wire:click="delete" type="button" class="btn btn-danger">Hapus</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <h4>Nama PlayStation</h4>
                <span>{{ $computer->computer_number }}</span>
            </div>
            <div class="col-3">
                <h4>Harga Sewa Per Jam</h4>
                <span>Rp. {{ number_format($computer->booking_price_per_hour, thousands_separator: '.') }}</span>
            </div>
        </div>
    </div>

    {{-- @livewire('components.notification-toast')

    @script
        <script>
            const modalEl = $('#modal-create-additional-product')
            const modal = new bootstrap.Modal(modalEl)

            $wire.on('delete-product', (detail) => {
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
                    window.location.href = '/master-data/menu'
                }
            })

            $wire.on('create-additional-product-status', (detail) => {
                const {
                    type,
                    message
                } = detail[0]
                const toastEl = $('#notification-toast')
                const toastBody = $('#notification-toast .toast-body')
                const toast = new bootstrap.Toast(toastEl)
                toastBody.text(message)

                if (type === 'error') {
                    toastEl.addClass('bg-danger')
                    toast.show()
                    modal.hide()
                } else {
                    toastEl.addClass('bg-success')
                    toast.show()
                    modal.hide()
                    window.location.reload()
                }

            })

            modalEl.bind('hide.bs.modal', event => {
                console.log('test');

            })
        </script>
    @endscript --}}
</div>
