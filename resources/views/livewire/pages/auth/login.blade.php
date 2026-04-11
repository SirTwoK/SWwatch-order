<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-6 space-y-4">

            {{-- ACTION ROW (Forgot + Login) --}}
            <div class="flex items-center justify-between">
        
                {{-- Forgot password --}}
                @if (Route::has('password.request'))
                    <a class="text-xs text-[#556070] hover:text-[#c9a227] tracking-[1px] uppercase transition-colors"
                       href="{{ route('password.request') }}"
                       wire:navigate>
                        Forgot password?
                    </a>
                @else
                    <span></span>
                @endif
        
                {{-- Login button --}}
                <x-primary-button class="px-5 py-2">
                    {{ __('Log in') }}
                </x-primary-button>
        
            </div>
        
            {{-- Divider --}}
            <div class="flex items-center gap-3">
                <div class="flex-1 h-px bg-[#1a2030]"></div>
                <span class="text-[10px] tracking-[3px] uppercase text-[#556070]">
                    or continue with
                </span>
                <div class="flex-1 h-px bg-[#1a2030]"></div>
            </div>
        
            {{-- Google Login Button --}}
            <a href="/auth/google/redirect"
               class="flex items-center justify-center gap-3 px-4 py-2.5
                      border border-[#1a2030] bg-[#0a0c10]
                      text-xs uppercase tracking-[2px] text-[#8a9aaa]
                      hover:text-[#c9a227] hover:border-[#2a3545]
                      hover:shadow-[0_0_15px_rgba(201,162,39,0.1)]
                      transition-all duration-200">
        
                {{-- Google Icon --}}
                <svg class="w-4 h-4" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.91 2.69 30.6 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.2C12.43 13.14 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.36 5.73c4.29-3.96 6.76-9.82 6.76-17.38z"/>
                    <path fill="#FBBC05" d="M10.54 28.43a14.5 14.5 0 0 1 0-9.16l-7.98-6.2A24 24 0 0 0 0 24c0 3.77.92 7.34 2.56 10.93l7.98-6.5z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.91-5.8l-7.36-5.73c-2.03 1.37-4.6 2.18-8.55 2.18-6.26 0-11.57-3.64-13.46-8.82l-7.98 6.5C6.51 42.62 14.62 48 24 48z"/>
                </svg>
        
                Login with Google
            </a>
        
        </div>
    </form>
</div>
