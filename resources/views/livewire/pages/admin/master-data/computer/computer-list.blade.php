<div>
    @section('title', 'List PlayStation')
    <div class="card">
        <h5 class="card-header">List PlayStation</h5>
        <a class="ms-auto me-3" href="{{ route('admin.master-data.computer.create') }}">
            <button type="button" class="btn btn-primary">Tambah PlayStation</button>
        </a>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Harga Per Jam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($computers as $computer)
                        <tr>
                            <td>{{ $computer->computer_number }}</td>
                            <td>Rp. {{ number_format($computer->booking_price_per_hour, thousands_separator: '.') }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('admin.master-data.computer.view', ['computer' => $computer]) }}"
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
            {{ $computers->links() }}
        </div>
    </div>
</div>
