<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold leading-tight text-gray-800">
			Order Successfully Placed
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="overflow-hidden bg-white p-5 shadow-xl sm:rounded-lg">
				<h1 class="text-2xl font-bold">Order {{ $order->status->name }}</h1>
				<p class="text-lg">Thank you for your order.</p>
				<a class="text-blue-500 hover:text-blue-700" href="{{ route('orders.show', $order) }}">View Order</a>
				<p class="text-lg">We have emailed your order confirmation, and will send you an update when your order has shipped.
				</p>
			</div>
		</div>
	</div>

</x-app-layout>
