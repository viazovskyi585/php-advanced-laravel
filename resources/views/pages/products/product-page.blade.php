<x-app-layout>
	<section class="bg-white">
		<div class="container mt-8 py-8">
			<div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
				<div class="-mx-4 flex flex-col md:flex-row">
					<div class="px-4 md:flex-1">
						<div class="mb-4 h-64 rounded-lg bg-gray-100 md:h-96">
							<img class="h-full w-full object-contain" src="{{ $product->thumbnailUrl }}" alt="{{ $product->name }}" />
						</div>
					</div>
					<div class="px-4 md:flex-1">
						<h2 class="mb-2 text-2xl font-bold leading-tight tracking-tight text-gray-800 md:text-3xl">{{ $product->title }}
						</h2>
						<p class="text-sm text-gray-500">
							<span>Categories: </span>
							@foreach ($product->categories as $category)
								<a class="text-fuchsia-600 hover:underline"
									href="{{ route('categories.show', $category->fullUrl) }}">{{ $category->name }}</a>
								@if (!$loop->last)
									,
								@endif
							@endforeach
						</p>

						<div class="my-4 flex items-center space-x-4">
							<div>
								<div class="flex rounded-lg bg-gray-100 px-3 py-2">
									<span class="mr-1 mt-1 text-fuchsia-400">$</span>
									<span class="text-3xl font-bold text-fuchsia-600">{{ $product->endPrice }}</span>
								</div>
							</div>
							@if ($product->discount)
								<div class="flex-1">
									<p class="mb-1 text-xl font-semibold text-green-500">Save {{ $product->discount }}%</p>
									<p class="m-0">Was <span class="line-through">${{ $product->price }}</span></p>
								</div>
							@endif
						</div>

						<form class="flex space-x-4 py-4" method="POST" action="#" x-data>

							<x-cart-input name="count" :max="$product->quantity" />

							<x-app-button type="submit" x-on:click.prevent="console.log('button click', $root)">
								Add to Cart
							</x-app-button>
						</form>
					</div>
				</div>
			</div>

			<div class="mt-8">
				<h2 class="mt-8">Description</h2>
				<p class="text-gray-600">{{ $product->description }}</p>
			</div>

			@if ($product->images->count() > 0)
				<h2 class="mt-8">Gallery</h2>
				<div class="relative h-120 w-full" x-data="{ image: 0 }">
					@foreach ($product->images as $image)
						<img class="h-full w-full object-contain" src="{{ $image->url }}" alt="{{ $product->name }}"
							x-show="image === {{ $loop->index }}" />
					@endforeach

					<button class="absolute left-0 top-0 h-full w-12 bg-gray-200 hover:bg-gray-300"
						x-on:click="image = image === 0 ? {{ count($product->images) - 1 }} : image - 1">
						<i class="fas fa-chevron-left"></i>
					</button>
					<button class="absolute right-0 top-0 h-full w-12 bg-gray-200 hover:bg-gray-300"
						x-on:click="image = image === {{ count($product->images) - 1 }} ? 0 : image + 1">
						<i class="fas fa-chevron-right"></i>
					</button>
				</div>
			@endif
		</div>
	</section>
</x-app-layout>
