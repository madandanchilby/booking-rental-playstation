<?php

namespace App\Livewire\Pages\Admin\MasterData\Computer;

use App\Models\Computer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ComputerList extends Component
{
    use WithPagination;

    public function mount(): void {
        
    }

    public function render()
    {
        return view('livewire.pages.admin.master-data.computer.computer-list', [
            'computers' => Computer::paginate(10)
        ]);
    }
}
