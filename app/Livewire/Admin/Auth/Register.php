<?php

namespace App\Livewire\Admin\Auth;

use App\Livewire\Forms\RegisterForm;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.blank')]
class Register extends Component
{
    public RegisterForm $form;

    public function mount()
    {
        
    }

    public function register(): void
    {
        try {
            $this->form->register();
            $this->form->reset();
            $this->redirectRoute('admin.auth.login');
        } catch (ValidationException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            $this->form->reset();
            dd($ex);
        }
    }

    public function render()
    {
        return view('livewire.admin.auth.register');
    }
}
