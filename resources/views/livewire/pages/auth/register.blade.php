<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen flex items-center justify-center px-4" style="background: transparent;">

    <div class="w-full max-w-sm">

        {{-- Logo / Title --}}
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full border border-[#2a3545] mb-6"
                 style="background: radial-gradient(circle at 60% 40%, #1a2535, #06080c);">
                <svg viewBox="0 0 32 32" fill="none" class="w-8 h-8">
                    <circle cx="16" cy="16" r="13" stroke="#c9a227" stroke-width="1.2"/>
                    <circle cx="16" cy="16" r="6.5" stroke="#c9a227" stroke-width="0.8"/>
                    <line x1="3" y1="16" x2="29" y2="16" stroke="#c9a227" stroke-width="0.8"/>
                </svg>
            </div>
        </div>

        {{-- Card --}}
        <div class="border border-[#2a3545] rounded-lg overflow-hidden"
             style="background: rgba(10,12,18,0.85); backdrop-filter: blur(8px);">

            {{-- Card header --}}
            <div class="px-6 pt-6 pb-4 border-b border-[#2a3545]">
                <p class="text-xs tracking-[3px] uppercase text-[#556070]">New here</p>
                <p class="text-lg font-semibold text-[#c8c4b8] mt-0.5 font-['Exo_2'] tracking-wide">Create your account</p>
            </div>

            <div class="px-6 py-6">
                <form wire:submit="register" class="space-y-5">

                    {{-- Name --}}
                    <div>
                        <label class="block text-xs tracking-[2px] uppercase text-[#7a8fa0] mb-2">
                            Name
                        </label>
                        <input wire:model="name"
                               id="name" type="text" name="name"
                               required autofocus autocomplete="name"
                               class="w-full bg-[#0a0e16] border border-[#2a3545] rounded text-sm text-[#d0ccbc] px-3 py-3
                                      placeholder-[#3a4555] tracking-wide
                                      focus:outline-none focus:border-[#c9a227] focus:ring-0
                                      transition-colors duration-150"
                               placeholder="Your name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs tracking-[2px] uppercase text-[#7a8fa0] mb-2">
                            Email
                        </label>
                        <input wire:model="email"
                               id="email" type="email" name="email"
                               required autocomplete="username"
                               class="w-full bg-[#0a0e16] border border-[#2a3545] rounded text-sm text-[#d0ccbc] px-3 py-3
                                      placeholder-[#3a4555] tracking-wide
                                      focus:outline-none focus:border-[#c9a227] focus:ring-0
                                      transition-colors duration-150"
                               placeholder="your@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs tracking-[2px] uppercase text-[#7a8fa0] mb-2">
                            Password
                        </label>
                        <input wire:model="password"
                               id="password" type="password" name="password"
                               required autocomplete="new-password"
                               class="w-full bg-[#0a0e16] border border-[#2a3545] rounded text-sm text-[#d0ccbc] px-3 py-3
                                      placeholder-[#3a4555] tracking-wide
                                      focus:outline-none focus:border-[#c9a227] focus:ring-0
                                      transition-colors duration-150"
                               placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label class="block text-xs tracking-[2px] uppercase text-[#7a8fa0] mb-2">
                            Confirm Password
                        </label>
                        <input wire:model="password_confirmation"
                               id="password_confirmation" type="password" name="password_confirmation"
                               required autocomplete="new-password"
                               class="w-full bg-[#0a0e16] border border-[#2a3545] rounded text-sm text-[#d0ccbc] px-3 py-3
                                      placeholder-[#3a4555] tracking-wide
                                      focus:outline-none focus:border-[#c9a227] focus:ring-0
                                      transition-colors duration-150"
                               placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
                    </div>

                    {{-- Register button --}}
                    <button type="submit"
                            class="w-full mt-2 py-3 px-4 border border-[#c9a227] rounded
                                   text-sm font-bold tracking-[3px] uppercase
                                   text-[#c9a227] bg-transparent
                                   hover:bg-[#c9a227] hover:text-[#06080c]
                                   transition-all duration-200 cursor-pointer">
                        Create Account
                    </button>

                    {{-- Divider --}}
                    <div class="flex items-center gap-3 py-1">
                        <div class="flex-1 h-px bg-[#2a3545]"></div>
                        <span class="text-xs tracking-[3px] uppercase text-[#3a4555]">or</span>
                        <div class="flex-1 h-px bg-[#2a3545]"></div>
                    </div>

                    {{-- Google --}}
                    <a href="/auth/google/redirect"
                       class="flex items-center justify-center gap-3 w-full py-3 px-4
                              border border-[#2a3545] rounded
                              text-sm tracking-[2px] uppercase text-[#7a8fa0]
                              hover:border-[#3a4f60] hover:text-[#9aaabb]
                              transition-all duration-200">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 48 48">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.91 2.69 30.6 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.2C12.43 13.14 17.74 9.5 24 9.5z"/>
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.36 5.73c4.29-3.96 6.76-9.82 6.76-17.38z"/>
                            <path fill="#FBBC05" d="M10.54 28.43a14.5 14.5 0 0 1 0-9.16l-7.98-6.2A24 24 0 0 0 0 24c0 3.77.92 7.34 2.56 10.93l7.98-6.5z"/>
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.91-5.8l-7.36-5.73c-2.03 1.37-4.6 2.18-8.55 2.18-6.26 0-11.57-3.64-13.46-8.82l-7.98 6.5C6.51 42.62 14.62 48 24 48z"/>
                        </svg>
                        Continue with Google
                    </a>

                </form>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t border-[#2a3545] text-center"
                 style="background: rgba(6,8,12,0.5);">
                <span class="text-sm tracking-[1.5px] uppercase text-[#445060]">Already have an account?</span>
                <a href="{{ route('login') }}" wire:navigate
                   class="text-sm tracking-[1.5px] uppercase text-[#c9a227] hover:text-[#f0d060] transition-colors ml-2">
                    Sign in
                </a>
            </div>
        </div>

    </div>
</div>