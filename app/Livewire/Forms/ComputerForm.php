<?php

namespace App\Livewire\Forms;

use App\Models\Computer;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ComputerForm extends Form
{
    #[Validate(rule: 'required|string|min:3|max:50')]
    public string $computer_number;
    #[Validate(rule: 'required|string|regex:/^\d+$/')]
    public string $booking_price_per_hour;

    public ?Computer $computer = null;

    public function setComputer(Computer $computer)
    {
        $this->computer = $computer;
        $this->computer_number = $computer->computer_number;
        $this->booking_price_per_hour = $computer->booking_price_per_hour;
    }

    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            Computer::create([
                'computer_number' => $this->computer_number,
                'booking_price_per_hour' => intval($this->booking_price_per_hour)
            ]);
        });
    }

    public function update(): void
    {
        $this->validate();

        DB::transaction(function () {
            $computer = Computer::findOrFail($this->computer->id);
            $computer->update([
                'computer_number' => $this->computer_number,
                'booking_price_per_hour' => intval($this->booking_price_per_hour)
            ]);
        });
    }
}
