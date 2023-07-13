@php
	$categoriesOptions = $categories
	    ->map(function ($category) {
	        return ['value' => $category->id, 'text' => $category->name];
	    })
	    ->toArray();
@endphp

<x-admin-layout :breadcrumbs="[['text' => 'Products', 'href' => route('admin.products.index')], ['text' => 'Create']]">
	<div class="w-full max-w-full flex-none px-3">
		<div
			class="shadow-soft-xl relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border p-4">
			<div class="mx-auto w-full max-w-[600px]">
				<h4>Create Product</h4>

				<form action="{{ route('admin.products.store') }}" method="POST">
					@csrf

					<div class="mt-4">
						<x-input-label for="title" :value="__('Title')" />
						<x-form.input class="mt-1 block w-full" id="title" name="title" type="text" :value="old('title')" required
							autofocus autocomplete="title" />
						<x-input-error class="mt-2" :messages="$errors->get('title')" />
					</div>

					<div class="mt-4">
						<x-input-label for="sku" :value="__('SKU')" />
						<x-form.input class="mt-1 block w-full" id="sku" name="SKU" type="text" :value="old('SKU')" required
							autocomplete="sku" />
						<x-input-error class="mt-2" :messages="$errors->get('sku')" />
					</div>

					@if ($categories->count())
						<div class="mt-4">
							<x-input-label for="categories" :value="__('Categories')" />
							<x-form.multiselect id="categories" name="categories[]" :options="$categoriesOptions" :value="old('categories') ?? []" />
							<x-input-error class="mt-2" :messages="$errors->get('categories')" />
						</div>
					@endif

					<div class="mt-4">
						<x-input-label for="description" :value="__('Description')" />
						<x-form.textarea class="mt-1 block w-full" id="description" name="description" type="text" rows="5"
							autocomplete="description">{{ old('description') }}</x-form.textarea>
						<x-input-error class="mt-2" :messages="$errors->get('description')" />
					</div>

					<div class="mt-4">
						<x-input-label for="price" :value="__('Price')" />
						<x-form.input class="mt-1 block w-full" id="price" name="price" type="number" :value="old('price')" required
							autocomplete="price" />
						<x-input-error class="mt-2" :messages="$errors->get('price')" />
					</div>

					<div class="mt-4">
						<x-input-label for="discount" :value="__('Discount')" />
						<x-form.input class="mt-1 block w-full" id="discount" name="discount" type="number" :value="old('discount') ?? 0"
							autocomplete="discount" min="0" max="100" />
						<x-input-error class="mt-2" :messages="$errors->get('discount')" />
					</div>

					<div class="mt-4">
						<x-input-label for="quantity" :value="__('Quantity')" />
						<x-form.input class="mt-1 block w-full" id="quantity" name="quantity" type="quantity" :value="old('quantity')"
							autocomplete="quantity" min="0" />
						<x-input-error class="mt-2" :messages="$errors->get('quantity')" />
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
