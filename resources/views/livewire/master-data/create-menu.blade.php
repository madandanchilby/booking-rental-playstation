<div>
    @section('title', 'Tambah Menu')
    <form wire:submit="save">
        <div class="card">
            <h5 class="card-header">Tambah Menu</h5>

            <div class="card-body">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Nama Produk</label>
                    <input wire:model="form.product_name" type="text" id="product_name" class="form-control"
                        placeholder="Masukan nama produk" required>
                    @error('form.product_name')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_description" class="form-label">Deskripsi Produk</label>
                    <textarea wire:model="form.product_description" id="product_description" class="form-control"
                        placeholder="Masukan deskripsi produk" rows="5" required></textarea>
                    @error('form.product_description')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_price" class="form-label">Harga Produk</label>
                    <input wire:model="form.product_price" type="text" id="product_price" class="form-control"
                        placeholder="Masukan harga produk" required>
                    @error('form.product_price')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="product_takeaway_price" class="form-label">Harga Takeaway Produk</label>
                    <input wire:model="form.product_takeaway_price" type="text" id="product_takeaway_price"
                        class="form-control" placeholder="Masukan harga takeaway produk" required>
                    @error('form.product_takeaway_price')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="form.category_id" class="form-label">Kategori Produk</label>
                    <select wire:model.lazy="form.category_id" class="form-select" id="form.category_id"
                        name="form.category_id">
                        <option value=""></option>
                        @foreach ($categories as $category)
                            <option wire:key="{{ $category->id }}" value="{{ $category->id }}">
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('form.category_id')
                        <span class="text-danger">{{ $message }} </span>
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
    @endscript
</div>
