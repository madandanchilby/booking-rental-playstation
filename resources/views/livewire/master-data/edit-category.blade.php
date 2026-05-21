@section('title', 'Edit Kategori')

<div>

    <form wire:submit="update">
        <div class="card">
            <h5 class="card-header">Edit Kategori</h5>

            <div class="card-body">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Nama Kategori</label>
                    <input wire:model="form.category_name" type="text" id="category_name" class="form-control"
                        placeholder="Masukan nama kategori" value="{{ $category->category_name }}" required>
                    @error('form.category_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
            $wire.on('update-category', (detail) => {
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
