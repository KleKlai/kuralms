<x-authentication-layout>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper auth p-0 theme-two">
        <div class="row d-flex align-items-stretch">
            <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
            <div class="slide-content bg-1"> </div>
            </div>
            <div class="col-12 col-md-8 h-100 bg-white">
                <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
                    <div class="nav-get-started">
                    <p>{{ "Don't have an account?" }}</p>
                    <a class="btn get-started-btn" href="{{ route('register') }}">GET STARTED</a>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <h3 class="mr-auto">{{ "Hello! let's get started" }}</h3>
                        <p class="mb-5 mr-auto">Enter your details below.</p>

                        <x-jet-validation-errors class="mb-4" />

                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="mdi mdi-account-outline"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="mdi mdi-lock-outline"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submit-btn">SIGN IN</button>
                        </div>
                        <div class="wrapper mt-5 text-gray">
                            <p class="footer-text">Copyright © {{ date('Y') }} KuraLMS. All rights reserved.</p>
                            <ul class="auth-footer text-gray">
                            <li>
                                <a href="#">Terms & Conditions</a>
                            </li>
                            <li>
                                <a href="#">Cookie Policy</a>
                            </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    {{-- <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card> --}}
</x-authentication-layout>
