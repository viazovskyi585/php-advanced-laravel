@php
	$parentSlugs = $parentSlugs ?? '';
@endphp

<x-app-layout>
	<section class="bg-white">
		<div class="container mt-8 py-8">
			@if (isset($parentCategories))
				<x-categories-breadcrumbs :categories="$parentCategories" />
				<h1 class="mt-4 text-center">{{ $parentCategories->last()->name }}</h1>
			@else
				<h1 class="text-center">Categories</h1>
			@endif


			@if ($categories->count() > 0)
				<div class="mt-8 flex flex-wrap md:-mx-4">
					@foreach ($categories as $category)
						<a class="block w-1/2 p-4 hover:scale-102" href="{{ route('categories.show', $parentSlugs . $category->slug) }}">
							<div class="h-64 w-full overflow-hidden rounded-md bg-cover bg-center"
								style="background-image: url('{{ $category->image->url }}')">
								<div class="flex h-full items-center bg-gray-900 bg-opacity-50">
									<div class="max-w-xl px-10">
										<h2 class="text-2xl font-semibold text-white">{{ $category->name }}</h2>
										<p class="mt-2 text-gray-400">{{ $category->description }}</p>
									</div>
								</div>
							</div>
						</a>
					@endforeach
				</div>
			@endif

			@if (isset($products))
				@if ($products->count() > 0)
					<x-products.products-grid :products="$products" />
				@elseif($categories->count() == 0)
					<h3 class="my-40 text-center">No products found</h3>
				@endif
			@endif
		</div>

	</section>
</x-app-layout>
