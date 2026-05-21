<div>
    @section('title', 'Daftar Menu')
    <div class="card">
        <h5 class="card-header">Daftar Menu</h5>
        <a class="ms-auto me-3" href="{{ route('master-data.menu.create') }}" wire:navigate>
            <button type="button" class="btn btn-primary">Tambah Produk</button>
        </a>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Takeaway</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>Rp. {{ number_format($product->product_price, thousands_separator: '.') }}</td>
                            <td>Rp. {{ number_format($product->product_takeaway_price, thousands_separator: '.') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('master-data.menu.view', ['product' => $product]) }}"
                                            class="dropdown-item" wire:navigate><i class="bx bx-note me-1"></i>
                                            Detail</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

        <div class="p-2">
            {{ $products->links() }}
        </div>
    </div>
</div>
