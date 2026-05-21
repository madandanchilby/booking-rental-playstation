<?php

namespace App\Livewire\Customer\Auth;

use App\Livewire\Forms\CustomerRegisterForm;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.blank')]
class Register extends Component
{
    public string $captchaToken = '';

    public CustomerRegisterForm $form;

    public function mount()
    {
        //
    }

    public function register(): void
    {
        $captcha = $this->captchaToken;

        if (!$captcha) {
            throw ValidationException::withMessages([
                'captcha' => 'Silakan centang CAPTCHA terlebih dahulu.',
            ]);
        }

        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $captcha,
                'remoteip' => request()->ip(),
            ]
        );

        if (!$response->json('success')) {
            $this->captchaToken = '';

            throw ValidationException::withMessages([
                'captcha' => 'Verifikasi CAPTCHA gagal. Silakan centang ulang CAPTCHA.',
            ]);
        }

        try {
            $this->form->register();
            $this->form->reset();
            $this->captchaToken = '';

            $this->redirectRoute('customer.auth.login');
        } catch (ValidationException $ex) {
            $this->captchaToken = '';
            throw $ex;
        } catch (Exception $ex) {
            $this->form->reset();
            $this->captchaToken = '';
            throw $ex;
        }
    }

    public function render()
    {
        return view('livewire.customer.auth.register');
    }
}