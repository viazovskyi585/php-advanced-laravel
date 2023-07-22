<x-app-layout>

	{{-- <x-banner link="#" linkText="test"></x-banner> --}}

	<section class="bg-white py-8">

		<div class="container mx-auto flex flex-wrap items-center pb-12 pt-4">


			<nav class="top-0 z-30 w-full px-6 py-1" id="store">
				<div class="container mx-auto mt-0 flex w-full flex-wrap items-center justify-between px-2 py-3">

					<a class="text-xl font-bold uppercase tracking-wide text-gray-800 no-underline hover:no-underline" href="#">
						Categories
					</a>
				</div>
				<div class="container mx-auto mt-0 flex w-full flex-wrap items-center justify-start px-2 py-3">
					@foreach ($categories as $category)
						<a
							class="mr-3 inline-block rounded-full border-2 border-solid border-gray-300 px-4 py-1 text-xl tracking-wide text-gray-500 no-underline hover:no-underline"
							href="#">{{ $category->name }}</a>
					@endforeach
				</div>
			</nav>

			<nav class="top-0 z-30 w-full px-6 py-1" id="store">
				<div class="container mx-auto mt-0 flex w-full flex-wrap items-center justify-between px-2 py-3">

					<a class="text-xl font-bold uppercase tracking-wide text-gray-800 no-underline hover:no-underline" href="#">
						Store
					</a>

					<div class="flex items-center" id="store-nav-content">

						<a class="inline-block pl-3 no-underline hover:text-black" href="#">
							<svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24">
								<path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
							</svg>
						</a>

						<a class="inline-block pl-3 no-underline hover:text-black" href="#">
							<svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24">
								<path
									d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
							</svg>
						</a>

					</div>
				</div>
			</nav>

			{{-- @foreach ($products as $product)
				<x-product-grid :product="$product" />
			@endforeach --}}
		</div>
	</section>

</x-app-layout>
