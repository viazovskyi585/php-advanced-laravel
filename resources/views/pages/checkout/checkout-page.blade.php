@php
	$user = auth()->user();
@endphp

<x-app-layout>
	<section class="mt-10 bg-white">
		<div class="container py-8">
			<h1 class="my-8 text-center text-3xl font-bold">Your Cart</h1>

			<div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
				<form class="w-full" id="checkout-form">
					@fragment('form')
						<div class="mt-6 rounded-lg border bg-white p-6 shadow-md md:mt-0">
							<div class="mt-4">
								<x-input-label for="first_name" :value="__('first_name')" />
								<x-form.input class="mt-1 block w-full" id="first_name" name="first_name" type="text" :value="old('first_name') ?? $user->first_name"
									required autofocus autocomplete="first_name" />
								<x-input-error class="mt-2" :messages="$errors->get('first_name')" />
							</div>

							<div class="mt-4">
								<x-input-label for="last_name" :value="__('last_name')" />
								<x-form.input class="mt-1 block w-full" id="last_name" name="last_name" type="text" :value="old('last_name') ?? $user->last_name" required
									autocomplete="last_name" />
								<x-input-error class="mt-2" :messages="$errors->get('last_name')" />
							</div>

							<div class="mt-4">
								<x-input-label for="email" :value="__('email')" />
								<x-form.input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email') ?? $user->email" required
									autocomplete="email" />
								<x-input-error class="mt-2" :messages="$errors->get('email')" />
							</div>

							<div class="mt-4">
								<x-input-label for="phone_number" :value="__('phone_number')" />
								<x-form.input class="mt-1 block w-full" id="phone_number" name="phone_number" type="text" :value="old('phone_number') ?? $user->phone_number"
									required autocomplete="phone_number" />
								<x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
							</div>

							<div class="mt-4">
								<x-input-label for="city" :value="__('city')" />
								<x-form.input class="mt-1 block w-full" id="city" name="city" type="text" :value="old('city')"
									autocomplete="city" min="0" max="100" />
								<x-input-error class="mt-2" :messages="$errors->get('city')" />
							</div>

							<div class="mt-4">
								<x-input-label for="address" :value="__('address')" />
								<x-form.input class="mt-1 block w-full" id="address" name="address" type="address" :value="old('address')"
									autocomplete="address" min="0" />
								<x-input-error class="mt-2" :messages="$errors->get('address')" />
							</div>
						</div>
					@endfragment
				</form>
				<!-- Sub total -->
				<div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
					<div class="mb-1 flex justify-between">
						<p class="m-0 text-gray-700">Subtotal</p>
						<p class="m-0 text-gray-700">${{ Cart::instance('cart')->subTotal() }}</p>
					</div>
					<div class="flex justify-between">
						<p class="m-0 text-gray-700">Tax</p>
						<p class="m-0 text-gray-700">${{ Cart::instance('cart')->tax() }}</p>
					</div>
					<hr class="my-4" />
					<div class="flex justify-between">
						<p class="text-lg font-bold">Total</p>
						<div class="">
							<p class="mb-1 text-lg font-bold">${{ Cart::instance('cart')->total() }}</p>
						</div>
					</div>

					<x-payment.paypal-button />

				</div>
			</div>
		</div>
	</section>

</x-app-layout>
