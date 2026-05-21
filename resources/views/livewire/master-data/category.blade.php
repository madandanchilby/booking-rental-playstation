<div>
    @section('title', 'Daftar Kategori')
    <div class="card">
        <h5 class="card-header">Daftar Kategori</h5>
        <a class="ms-auto me-3" href="{{ route('master-data.category.create') }}" wire:navigate>
            <button type="button" class="btn btn-primary">Tambah Kategori</button>
        </a>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($categories as $category)
                        <tr wire:key="{{ $category->id }}">
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('master-data.category.view', ['category' => $category]) }}"
                                            class="dropdown-item"><i class="bx bx-note me-1"></i>
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
            {{ $categories->links() }}
        </div>
    </div>
</div>
