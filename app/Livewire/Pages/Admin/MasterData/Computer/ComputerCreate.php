<?php

namespace App\Livewire\Pages\Admin\MasterData\Computer;

use App\Livewire\Forms\ComputerForm;
use Exception;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ComputerCreate extends Component
{

    public ComputerForm $form;

    public function save()
    {
        try {
            $this->form->save();

            $this->redirectRoute('admin.master-data.computer');
        } catch (ValidationException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function render()
    {
        return view('livewire.pages.admin.master-data.computer.computer-create');
    }
}
