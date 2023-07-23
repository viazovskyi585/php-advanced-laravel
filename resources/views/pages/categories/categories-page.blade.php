@php
	$parentSlugs = $parentSlugs ?? '';
@endphp

<x-app-layout>
	<section class="bg-white">
		<div class="container mt-8 py-8">
			@if (isset($parentCategories))
				@php
					$breadcrumbs = [['name' => 'Home', 'link' => route('home')], ['name' => 'Categories', 'link' => route('categories.index')]];
					$prevSlug = '';
					foreach ($parentCategories as $parentCategory) {
					    $prevSlug .= $parentCategory->slug . '/';
					    $breadcrumbs[] = ['name' => $parentCategory->name, 'link' => route('categories.show', $prevSlug)];
					}
				@endphp
				<x-breadcrumbs :links="$breadcrumbs" />
				<h1 class="mt-4 text-center">{{ $parentCategories->last()->name }}</h1>
			@else
				<h1 class="text-center">Categories</h1>
			@endif


			<div class="mt-8 flex flex-wrap md:-mx-4">
				@foreach ($categories as $category)
					<a class="block w-1/2 p-4 hover:scale-102" href="{{ route('categories.show', $parentSlugs . $category->slug) }}">
						<div class="h-64 w-full overflow-hidden rounded-md bg-cover bg-center"
							style="background-image: url('{{ $category->image->url }}')">
							<div class="flex h-full items-center bg-gray-900 bg-opacity-50">
								<div class="max-w-xl px-10">
									<h2 class="text-2xl font-semibold text-white">{{ $category->name }}</h2>
									<p class="mt-2 text-gray-400">{{ $category->description }}</p>
									{{-- <button
										class="mt-4 flex items-center rounded text-sm font-medium uppercase text-white hover:underline focus:outline-none">
										<span>Shop Now</span>
										<svg class="mx-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											viewBox="0 0 24 24" stroke="currentColor">
											<path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
										</svg>
									</button> --}}
								</div>
							</div>
						</div>
					</a>
				@endforeach
			</div>
		</div>

	</section>
</x-app-layout>
