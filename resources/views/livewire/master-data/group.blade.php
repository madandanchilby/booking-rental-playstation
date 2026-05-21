<div>
    @section('title', 'Daftar Grup Produk')
    <div class="card">
        <h5 class="card-header">Daftar Grup Produk</h5>
        <a class="ms-auto me-3" href="{{ route('master-data.group-product.create') }}" wire:navigate>
            <button type="button" class="btn btn-primary">Tambah Grup Produk</button>
        </a>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Grup Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->group_name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="#"
                                            class="dropdown-item" wire:navigate><i class="bx bx-pencil me-1"></i>
                                            Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

        <div class="p-2">
            {{ $groups->links() }}
        </div>
    </div>
</div>
