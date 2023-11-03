<x-guest-layout>
    @fragment('form')
	<form method="POST" hx-post="{{ route('register') }}">
		@csrf

		<!-- Name -->
		<div>
			<x-input-label for="first_name" :value="__('First Name')" />
			<x-text-input class="mt-1 block w-full" id="first_name" name="first_name" type="text" :value="old('first_name')" required
				autofocus autocomplete="first_name" />
			<x-input-error class="mt-2" :messages="$errors->get('first_name')" />
		</div>

		<div class="mt-4">
			<x-input-label for="last_name" :value="__('Last Name')" />
			<x-text-input class="mt-1 block w-full" id="last_name" name="last_name" type="text" :value="old('last_name')" required
				autofocus autocomplete="last_name" />
			<x-input-error class="mt-2" :messages="$errors->get('last_name')" />
		</div>

		<!-- Email Address -->
		<div class="mt-4">
			<x-input-label for="email" :value="__('Email')" />
			<x-text-input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email')" required
				autocomplete="username" />
			<x-input-error class="mt-2" :messages="$errors->get('email')" />
		</div>

		<div class="mt-4">
			<x-input-label for="phone_number" :value="__('Phone Number')" />
			<x-text-input class="mt-1 block w-full" id="phone_number" name="phone_number" type="text" :value="old('phone_number')"
				required autocomplete="phone" />
			<x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
		</div>

		<div class="mt-4">
			<x-input-label for="date_of_birth" :value="__('Date of birth')" />
			<x-text-input class="mt-1 block w-full" id="date_of_birth" name="date_of_birth" type="date" :value="old('date_of_birth')"
				required autocomplete="birthday" />
			<x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
		</div>

		<div class="mt-4">
			<x-input-label for="password" :value="__('Password')" />
			<x-password-input class="mt-1 block w-full" id="password" name="password" type="password" required
				autocomplete="new-password" />
			<x-input-error class="mt-2" :messages="$errors->get('password')" />
		</div>

		<div class="mt-4">
			<x-input-label for="password_confirmation" :value="__('Confirm Password')" />
			<x-password-input class="mt-1 block w-full" id="password_confirmation" name="password_confirmation"
				type="password_confirmation" required autocomplete="new-password" />
			<x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
		</div>

		<div class="mt-4 flex items-center justify-end">
			<a
				class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
				href="{{ route('login') }}">
				{{ __('Already registered?') }}
			</a>

			<x-primary-button class="ml-4">
				{{ __('Register') }}
			</x-primary-button>
		</div>
	</form>
    @endfragment
</x-guest-layout>
