@props([
    'products' => [],
])

<div {{ $attributes->merge(['class' => 'flex flex-wrap items-center']) }}>
	@foreach ($products as $product)
		<div class="{{ $product->quantity === 0 ? 'opacity-50' : '' }} flex w-full flex-col p-6 md:w-1/3 xl:w-1/4">
			<a href="{{ route('products.show', $product->slug) }}">
				<div class="relative h-64">
					<img class="h-full w-full object-cover hover:grow hover:shadow-lg" src="{{ $product->thumbnailUrl }}">
					@if ($product->discount)
						<div class="absolute right-0 top-0 flex h-4 w-12 items-center justify-center rounded-bl bg-red-500 text-white">
							{{ $product->discount }}%
						</div>
					@endif
					@if ($product->quantity === 0)
						<div class="absolute right-0 top-4 flex h-4 items-center justify-center rounded-bl bg-red-500 text-white">
							Out of stock
						</div>
					@endif
				</div>
				<div class="flex items-center justify-between pt-3">
					<p class="">{{ $product->title }}</p>
					<i class="fas fa-heart text-gray-500 hover:text-black"></i>
				</div>
				<p class="pt-1 text-gray-900">
					@if ($product->price !== $product->endPrice)
						<span class="text-red-400 line-through">${{ $product->price }}</span>
					@endif
					${{ $product->endPrice }}
				</p>
			</a>
		</div>
	@endforeach
</div>
