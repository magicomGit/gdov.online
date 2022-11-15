<x-app-layout>
    <x-auth-card>


        <h2 class="text-2xl font-bold my-4">Вход</h2>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input checked id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-[#3C8C73] shadow-sm focus:border-transparent focus:ring focus:ring-transparent"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
                </label>
            </div>

            <!-- button and links-->
            <div class="flex items-center justify-between mt-4">
                <div>
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('register') }}">
                            {{ __('Регистрация') }}
                        </a>
                </div>
                <div>
                    @if (Route::has('password.request'))
                        <a class="hidden underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            {{ __('Забыли пароль?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-3">
                        {{ __('Войти') }}
                    </x-primary-button>
                </div>

            </div>
        </form>
    </x-auth-card>
</x-app-layout>
