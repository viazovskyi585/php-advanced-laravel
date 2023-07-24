@php
	$categoriesOptions = $categories
	    ->map(function ($category) {
	        return ['value' => $category->id, 'text' => $category->name];
	    })
	    ->toArray();
	
	$selectedCategoriesIds = $productCategories->pluck('id')->toArray();
@endphp

<x-admin-layout :breadcrumbs="[['text' => 'Products', 'href' => route('admin.products.index')], ['text' => 'Create']]">
	<div class="w-full max-w-full flex-none px-3">
		<div
			class="relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border p-4 shadow-soft-xl">
			<div class="mx-auto w-full max-w-[600px]">
				<h4>Edit Product - {{ $product->title }}</h4>

				<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="mt-4 h-96 w-full">
						<img class="h-full w-full object-contain" src="{{ $product->thumbnailUrl }}" alt="{{ $product->title }}">
					</div>

					<div class="mt-4">
						<x-input-label for="thumbnail" :value="__('Change Thumbnail')" />
						<x-form.image-input class="mt-1" id="thumbnail" name="thumbnail" accept=".png, .jpg, .jpeg" />
						<x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
					</div>

					<hr class="my-6 border-b-2 border-solid border-gray-600">

					<div class="mt-4">
						<x-input-label for="title" :value="__('Title')" />
						<x-form.input class="mt-1 block w-full" id="title" name="title" type="text" :value="$product->title" required
							autofocus autocomplete="title" />
						<x-input-error class="mt-2" :messages="$errors->get('title')" />
					</div>

					<div class="mt-4">
						<x-input-label for="sku" :value="__('SKU')" />
						<x-form.input class="mt-1 block w-full" id="sku" name="SKU" type="text" :value="$product->SKU" required
							autocomplete="sku" />
						<x-input-error class="mt-2" :messages="$errors->get('sku')" />
					</div>

					@if ($categories->count())
						<div class="mt-4">
							<x-input-label for="categories" :value="__('Categories')" />
							<x-form.multiselect id="categories" name="categories[]" :options="$categoriesOptions" :value="$selectedCategoriesIds" />
							<x-input-error class="mt-2" :messages="$errors->get('categories')" />
						</div>
					@endif

					<div class="mt-4">
						<x-input-label for="description" :value="__('Description')" />
						<x-form.textarea class="mt-1 block w-full" id="description" name="description" type="text" rows="5"
							autocomplete="description">{{ $product->description }}</x-form.textarea>
						<x-input-error class="mt-2" :messages="$errors->get('description')" />
					</div>

					<div class="mt-4">
						<x-input-label for="price" :value="__('Price')" />
						<x-form.input class="mt-1 block w-full" id="price" name="price" type="number" :value="$product->price" required
							autocomplete="price" />
						<x-input-error class="mt-2" :messages="$errors->get('price')" />
					</div>

					<div class="mt-4">
						<x-input-label for="discount" :value="__('Discount')" />
						<x-form.input class="mt-1 block w-full" id="discount" name="discount" type="number" :value="$product->discount ?? 0"
							autocomplete="discount" min="0" max="100" />
						<x-input-error class="mt-2" :messages="$errors->get('discount')" />
					</div>

					<div class="mt-4">
						<x-input-label for="quantity" :value="__('Quantity')" />
						<x-form.input class="mt-1 block w-full" id="quantity" name="quantity" type="quantity" :value="$product->quantity" required
							autocomplete="quantity" min="0" />
						<x-input-error class="mt-2" :messages="$errors->get('quantity')" />
					</div>



					@if ($product->images->count())

						<hr class="my-6 border-b-2 border-solid border-gray-600">

						<h4>Uploaded Images</h4>

						<div class="mt-4 grid grid-cols-2 gap-2">
							@foreach ($product->images as $image)
								<div class="relative h-64 rounded-2" x-data="{ loading: false }" x-ref="root">
									<img class="absolute inset-0 h-full w-full rounded-2 object-cover" src="{{ $image->url }}"
										alt="{{ $product->title }} image {{ $loop->index }}">

									<button
										class="absolute right-2 top-2 flex h-8 w-8 items-center justify-center rounded-full bg-red-200 p-2 text-lg text-red-500 hover:text-red-700"
										type="button"
										x-on:click.prevent="
                                            if (loading) return;
                                            loading = true;
                                            try {
                                                await Api.sendRequest('{{ route('ajax.image.delete', $image->id) }}', 'DELETE');
                                                $refs.root.remove();
                                            } catch (e) {
                                                console.error(e);
                                            }
                                            finally { loading = false; }">
										<i class="fas" x-bind:class="{ 'fa-spinner fa-spin': loading, 'fa-trash': !loading }"></i>
									</button>
								</div>
							@endforeach
						</div>
					@endif


					<div class="mt-4">
						<x-input-label for="images" :value="__('Upload additional images')" />
						<x-form.image-input class="mt-1" id="images" name="images[]" multiple accept=".png, .jpg, .jpeg" />
						<x-input-error class="mt-2" :messages="$errors->get('images')" />
					</div>

					<div class="mt-6 flex">
						<x-app-button class="w-40">
							<i class="fas fa-save"></i>
							Save
						</x-app-button>
					</div>

				</form>
			</div>
		</div>
	</div>

</x-admin-layout>
