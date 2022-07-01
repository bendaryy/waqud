@extends('layouts.main')
@section('content')
    <div class="col-12">

        <x-guest-layout>
            <x-jet-authentication-card>
                <x-slot name="logo">
                    <x-jet-authentication-card-logo />
                </x-slot>

                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div>
                        <x-jet-label for="name" class="text-center" value="{{ __('messages.Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" class="text-center" value="{{ __('messages.Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="phone" class="text-center" value="{{ __('messages.phone') }}" />
                        <x-jet-input id="phone" class="block mt-1 w-full" type="number" name="phone"
                            :value="old('phone')" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="address" class="text-center" value="{{ __('messages.user address') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address"
                            :value="old('address')"  autofocus autocomplete="name" />
                    </div>


                    <div class="mt-4">
                        <x-jet-label for="address" class="text-center" value="{{ __('messages.user type') }}" />
                        <select name="role" required class="block mt-1 w-full text-center">
                            <option value="company">شركة</option>
                            <option value="station">محطة</option>
                        </select>
                    </div>


                    <div class="mt-4">
                        <x-jet-label for="password" class="text-center" value="{{ __('messages.password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" class="text-center"
                            value="{{ __('messages.password_confirmation') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="confirm-password" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="terms" id="terms" />

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
]) !!}
                                    </div>
                                </div>
                            </x-jet-label>
                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a> --}}

                        <x-jet-button style="margin: auto">
                            {{ __('messages.add user') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
@endsection
