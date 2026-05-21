<?php

namespace App\Livewire\Customer\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.blank')]
class Login extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $isLogged = $this->form->login();

        if ($isLogged) {
            session()->regenerate();

            $this->redirectRoute('customer.booking');
        }

        session()->flash('auth.error', 'username atau password anda salah');
    }

    public function render()
    {
        return view('livewire.customer.auth.login');
    }
}
