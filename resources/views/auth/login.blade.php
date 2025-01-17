<x-guest-layout>
    <x-jet-authentication-card>
        <h1></h1>
        <x-slot name="logo">
            <a name="Home" href="{{ route('home') }}">
                <img src="{{ asset('assets/img/my-bakery.png') }}" alt="my-bakery-logo" width="250">
                <div hidden>Home</div>
            </a>
        </x-slot>

        <p class="text-center mt-4 mb-4">Login Untuk Memesan Menu Tanpa Perlu Antri 😊</p>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <x-jet-label for="phone" value="{{ __('Nomor WhatsApp (ex. 08xxxxxxxxxx)') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Nama Anda') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="text" name="password" :value="old('name')" required />
            </div>

            <!-- <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ingat Aku') }}</span>
                </label>
            </div> -->

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __("Belum mempunyai akun? Daftar") }}
                </a>
                @if (Route::has('password.request'))
                <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900 ml-4" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a> -->
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
        <!-- <div class="mt-4">
            <x-jet-label value="{{ __('Admin') }}" />
            <x-jet-input class="block mt-1 w-full" readonly value="habibirrahman18@gmail.com Habibarief123" />
        </div>
        <div class="mt-4">
            <x-jet-label value="{{ __('Costumer') }}" />
            <x-jet-input class="block mt-1 w-full" readonly value="jiwaedo@gmail.com Jiwaedo123" />
            <x-jet-input class="block mt-1 w-full" readonly value="aripuex@gmail.com Aripuex123" />
        </div> -->
    </x-jet-authentication-card>
</x-guest-layout>
