<?php

namespace App\Livewire\Pages\Admin\MasterData\Computer;

use App\Livewire\Forms\ComputerForm;
use App\Models\Computer;
use Exception;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ComputerEdit extends Component
{
    public ComputerForm $form;
    public Computer $computer;

    public function mount()
    {
        $this->form->setComputer($this->computer);
    }

    public function update()
    {
        try {
            $this->form->update();

            $this->redirectRoute('admin.master-data.computer');
        } catch (ValidationException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.master-data.computer.computer-edit');
    }
}
