<x-app-layout>
	<section class="bg-white">
		<div class="container mt-8 py-8">
			<x-categories-breadcrumbs :categories="$categories" />
			<h1 class="mt-4 text-center">{{ $category->name }}</h1>

			<x-products.products-grid :products="$products" />
		</div>
	</section>
</x-app-layout>
