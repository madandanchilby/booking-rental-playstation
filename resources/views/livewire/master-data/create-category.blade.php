@section('title', 'Tambah Kategori')

<div>
    <form wire:submit="store">
        <div class="card">
            <h5 class="card-header">Tambah Kategori</h5>

            <div class="card-body">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Nama Kategori</label>
                    <input wire:model="form.category_name" type="text" id="category_name" class="form-control" placeholder="Masukan nama kategori" required>
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
</div>
