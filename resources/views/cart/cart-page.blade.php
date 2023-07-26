<x-app-layout>
	<section class="mt-10 bg-white">
		<div class="container py-8">
			<h1 class="my-8 text-center text-3xl font-bold">Your Cart</h1>
			<div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
				<div class="rounded-lg md:w-2/3">
					<div class="mb-6 justify-between rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
						<img class="w-full rounded-lg sm:w-40"
							src="https://images.unsplash.com/photo-1515955656352-a1fa3ffcd111?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
							alt="product-image" />
						<div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
							<div class="mt-5 sm:mt-0">
								<h2 class="text-lg font-bold text-gray-900">Nike Air Max 2019</h2>
								<p class="mt-1 text-xs text-gray-700">36EU - 4US</p>
							</div>
							<div class="flex flex-col items-end">
								<x-cart-input class="w-16" name="xx" />
								<div class="mt-auto flex items-center justify-self-end">
									<p class="m-0 text-xl">259.000 $</p>

									<x-app-button class="ml-4" size="sm" theme="warning">Remove</x-app-button>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- Sub total -->
				<div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
					<div class="mb-2 flex justify-between">
						<p class="text-gray-700">Subtotal</p>
						<p class="text-gray-700">$129.99</p>
					</div>
					<div class="flex justify-between">
						<p class="text-gray-700">Shipping</p>
						<p class="text-gray-700">$4.99</p>
					</div>
					<hr class="my-4" />
					<div class="flex justify-between">
						<p class="text-lg font-bold">Total</p>
						<div class="">
							<p class="mb-1 text-lg font-bold">$134.98 USD</p>
							<p class="text-sm text-gray-700">including VAT</p>
						</div>
					</div>
					<x-app-button class="w-full">Check out</x-app-button>
				</div>
			</div>
		</div>
	</section>

</x-app-layout>
