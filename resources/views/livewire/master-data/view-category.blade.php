@section('title', 'View Kategori')

<div class="card">
    <div class="card-header">
        <h3>Detail Kategori</h3>
        <div class="d-flex gap-4">
            <a href="{{ route('master-data.category.edit', ['category' => $category]) }}" class="btn btn-secondary">Edit</a>
            <button wire:click="delete({{ $category }})" type="button" class="btn btn-danger">Hapus</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <h4>Nama Kategori</h4>
                <span>{{ $category->category_name }}</span>
            </div>
        </div>
    </div>

    @livewire('components.notification-toast')

    @script
        <script>
            $wire.on('delete-category', (detail) => {
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
                    window.location.href = '/master-data/kategori'
                }
            })
        </script>
    @endscript
</div>
