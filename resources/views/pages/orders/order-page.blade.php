<x-app-layout>
	<div class="container">
		<div class="my-8 flex justify-center">
			<div class="px-4 md:w-1/2">
				<div class="mb-6 rounded-lg bg-white p-4 shadow-md">
					<h2 class="text-xl font-semibold capitalize text-gray-700">{{ __('Order Details') }}</h2>
					<div class="-mx-2 flex flex-col md:flex-row">
						<div class="px-2 md:w-1/2">
							<div class="flex flex-col">
								<span class="text-sm text-gray-500">{{ __('Order ID') }}</span>
								<span class="text-sm font-semibold text-gray-900">{{ $order->id }}</span>
							</div>
						</div>
						<div class="px-2 md:w-1/2">
							<div class="flex flex-col">
								<span class="text-sm text-gray-500">{{ __('Order Status') }}</span>
								<span class="text-sm font-semibold text-gray-900">{{ $order->status->name }}</span>
							</div>
						</div>
					</div>
					<div class="-mx-2 flex flex-col md:flex-row">
						<div class="px-2 md:w-1/2">
							<div class="flex flex-col">
								<span class="text-sm text-gray-500">{{ __('City') }}</span>
								<span class="text-sm font-semibold text-gray-900">{{ $order->city }}</span>
							</div>
						</div>
						<div class="px-2 md:w-1/2">
							<div class="flex flex-col">
								<span class="text-sm text-gray-500">{{ __('Address') }}</span>
								<span class="text-sm font-semibold text-gray-900">{{ $order->address }}</span>
							</div>
						</div>
					</div>
					<div class="-mx-2 flex flex-col md:flex-row">
						<div class="px-2 md:w-1/2">
							<div class="flex flex-col">
								<span class="text-sm text-gray-500">{{ __('Created At') }}</span>
								<span class="text-sm font-semibold text-gray-900">{{ $order->created_at }}</span>
							</div>

						</div>
						<div class="px-2 md:w-1/2">
							<div class="flex flex-col">
								<span class="text-sm text-gray-500">{{ __('Updated At') }}</span>
								<span class="text-sm font-semibold text-gray-900">{{ $order->updated_at }}</span>
							</div>
						</div>
					</div>

					<div class="mb-6 rounded-lg bg-white p-4 shadow-md">
						<h2 class="text-xl font-semibold capitalize text-gray-700">{{ __('Order Products') }}</h2>
						<div class="flex flex-col">
							<div class="-mx-2 flex flex-col md:flex-row">
								<div class="px-2 md:w-1/3">
									<div class="flex flex-col">
										<span class="text-sm text-gray-500">{{ __('Image') }}</span>
									</div>
								</div>
								<div class="px-2 md:w-1/3">
									<div class="flex flex-col">
										<span class="text-sm text-gray-500">{{ __('Product') }}</span>
									</div>
								</div>
								<div class="px-2 md:w-1/3">
									<div class="flex flex-col">
										<span class="text-sm text-gray-500">{{ __('Quantity') }}</span>
									</div>
								</div>
							</div>
							@foreach ($order->products as $product)
								<div class="-mx-2 mt-2 flex flex-col md:flex-row">
									<div class="px-2 md:w-1/3">
										<div class="flex flex-col">
											<img class="h-10 w-30 rounded-2 object-cover object-center" src="{{ $product->thumbnailUrl }}"
												alt="{{ $product->title }}">
										</div>
									</div>
									<div class="px-2 md:w-1/3">
										<div class="flex flex-col">
											<a class="text-sm font-semibold text-gray-900"
												href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
										</div>
									</div>
									<div class="px-2 md:w-1/3">
										<div class="flex flex-col">
											<span class="text-sm font-semibold text-gray-900">{{ $product->quantity }}</span>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</x-app-layout>
