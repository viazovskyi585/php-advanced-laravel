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
								<a class="text-indigo-600 hover:underline"
									href="{{ route('categories.show', $category->fullUrl) }}">{{ $category->name }}</a>
								@if (!$loop->last)
									,
								@endif
							@endforeach
						</p>

						<div class="my-4 flex items-center space-x-4">
							<div>
								<div class="flex rounded-lg bg-gray-100 px-3 py-2">
									<span class="mr-1 mt-1 text-indigo-400">$</span>
									<span class="text-3xl font-bold text-indigo-600">{{ $product->endPrice }}</span>
								</div>
							</div>
							@if ($product->discount)
								<div class="flex-1">
									<p class="mb-1 text-xl font-semibold text-green-500">Save {{ $product->discount }}%</p>
									<p class="m-0">Was <span class="line-through">${{ $product->price }}</span></p>
								</div>
							@endif
						</div>

						<p class="text-gray-500">{{ $product->description }}</p>

						<div class="flex space-x-4 py-4">

							<x-app-button class="h-14 rounded-xl bg-indigo-600 px-6 py-2 font-semibold text-white hover:bg-indigo-500"
								type="button">
								Add to Cart
							</x-app-button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</x-app-layout>
