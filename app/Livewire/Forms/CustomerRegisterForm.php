<?php

namespace App\Livewire\Forms;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerRegisterForm extends Form
{
    #[Validate(rule: 'required|string|min:3|max:150')]
    public string $name = '';

    #[Validate(rule: 'required|string|min:3|max:100|unique:users,username')]
    public string $username = '';

    #[Validate(rule: 'required|email|unique:users,email')]
    public string $email = '';

    #[Validate(rule: 'required|string|min:8')]
    public string $password = '';

    #[Validate(rule: 'required|string|min:3|max:200')]
    public string $address = '';

    #[Validate(rule: 'required|string|in:male,female')]
    public string $gender = '';

    #[Validate(rule: 'required|string|min:10|max:12|regex:/^\d+$/')]
    public string $phone = '';

    public function register(): void
    {
        $this->validate();

        DB::transaction(function () {
            $user = User::create([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password,
            ]);

            Customer::create([
                'name' => $this->name,
                'address' => $this->address,
                'gender' => $this->gender,
                'phone' => $this->phone,
                'user_id' => $user->id,
            ]);

            $user->assignRole('customer');

            event(new Registered($user));
            Auth::login($user);
        });
    }
}
