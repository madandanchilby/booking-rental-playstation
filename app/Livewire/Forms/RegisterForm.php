<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate(rule: 'required|string|min:3|max:150')]
    public string $name = '';
    #[Validate(rule: 'required|string|min:3|max:100|unique:users,username')]
    public string $username = '';
    #[Validate(rule: 'required|email|unique:users,email')]
    public string $email = '';
    #[Validate(rule: 'required|string')]
    public string $password = '';

    public function register(): void
    {
        $this->validate();

        DB::transaction(function () {
            $user = User::create([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password
            ]);

            $user->assignRole('admin');
        });
    }
}
