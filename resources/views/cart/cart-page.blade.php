<x-app-layout>
	<section class="mt-10 bg-white">
		<div class="container py-8">
			<h1 class="my-8 text-center text-3xl font-bold">Your Cart</h1>

			<div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
				<div class="rounded-lg md:w-2/3">
					@forelse (Cart::instance('cart')->content() as $row)
						<div class="mb-6 justify-between rounded-lg bg-white p-6 shadow-md lg:flex lg:justify-start">
							<img class="h-40 w-full rounded-lg object-cover lg:w-40" src="{{ $row->model->thumbnailUrl }}" alt="image" />
							<div class="lg:ml-4 lg:flex lg:w-full lg:justify-between">
								<div class="mt-5 lg:mt-0">
									<a href="{{ route('products.show', $row->model) }}">
										<h2 class="text-lg font-bold text-gray-900">{{ $row->name }} {{ $row->qty }}</h2>
									</a>
								</div>
								<div class="flex flex-col items-end">
									<form action="{{ route('cart.count', $row->model) }}" method="POST" x-data
										x-on:change.debounce="$el.submit()">
										@csrf
										<input name="rowId" type="hidden" value="{{ $row->rowId }}" />
										<x-cart-input class="w-16" name="quantity" :value="$row->qty" :max="$row->model->quantity" />
									</form>
									<div class="mt-auto flex w-full items-center justify-between lg:w-auto lg:justify-self-end">
										<div>
											<p class="text-md m-0">Price:
												@if ($row->model->discount)
													<span class="text-xs text-red-400 line-through">{{ $row->model->price }} $</span>
													<span class="font-bold text-green-600">{{ $row->price }} $</span>
												@else
													{{ $row->price }} $
												@endif
											</p>
											<p class="m-0 text-lg">Total:
												@if ($row->model->discount)
													<span class="text-xs text-red-400 line-through">{{ $row->model->price * $row->qty }} $</span>
													<span class="font-bold text-green-600">{{ $row->subtotal }} $</span>
												@else
													{{ $row->subtotal }} $
												@endif
											</p>
										</div>

										<form action="{{ route('cart.remove') }}" method="POST">
											@csrf
											@method('DELETE')
											<input name="rowId" type="hidden" value="{{ $row->rowId }}" />
											<x-app-button class="ml-4" size="sm" theme="warning">
												<i class="fas fa-trash-alt"></i>
											</x-app-button>
										</form>
									</div>
								</div>
							</div>
						</div>
					@empty
						<p class="text-center text-2xl">Your cart is empty</p>
					@endforelse

				</div>
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
					<x-app-button class="w-full" href="{{ route('checkout') }}">Check out</x-app-button>
				</div>
			</div>
		</div>
	</section>

</x-app-layout>
