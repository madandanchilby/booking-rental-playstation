<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{

    public function logout(): void
    {
        $user = getAuthUser();


        if ($user->hasRole('admin')) {
            Auth::logout();

            session()->invalidate();
            $this->redirectRoute('admin.auth.login');
        }

        Auth::logout();
        session()->invalidate();
        
        $this->redirectRoute('customer.auth.login');
    }

    public function render()
    {
        return view('livewire.components.navbar');
    }
}
