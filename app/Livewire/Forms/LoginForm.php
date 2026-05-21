<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate(rule: 'required|string|min:3|max:100')]
    public string $username;
    #[Validate(rule: 'required|string')]
    public string $password;

    public function login(): bool
    {
        $this->validate();

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            return true;
        }

        return false;
    }
}
