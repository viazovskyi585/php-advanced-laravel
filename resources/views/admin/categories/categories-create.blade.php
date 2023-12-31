<x-admin-layout :breadcrumbs="[['text' => 'Categories', 'href' => route('admin.categories.index')], ['text' => 'Create']]">
	<div class="w-full max-w-full flex-none px-3">
		<div
			class="relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border p-4 shadow-soft-xl">
			<div class="mx-auto w-full max-w-[600px]">
				<h4>Create category</h4>

				<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
					@csrf

					<div class="mt-4">
						<x-input-label for="image" :value="__('Image')" />
						<x-form.image-input class="mt-1" id="image" name="image" accept=".png, .jpg, .jpeg" />
						<x-input-error class="mt-2" :messages="$errors->get('image')" />
					</div>

					<div class="mt-4">
						<x-input-label for="name" :value="__('Name')" />
						<x-form.input class="mt-1 block w-full" id="name" name="name" type="text" :value="old('name')" required
							autofocus autocomplete="name" />
						<x-input-error class="mt-2" :messages="$errors->get('name')" />
					</div>

					<div class="mt-4">
						<x-input-label for="description" :value="__('Description')" />
						<x-form.textarea class="mt-1 block w-full" id="description" name="description" type="text" rows="5"
							required autofocus autocomplete="description">{{ old('description') }}</x-form.textarea>
						<x-input-error class="mt-2" :messages="$errors->get('description')" />
					</div>

					@if ($categories->count())
						<div class="mt-4">
							<x-input-label for="parent_id" :value="__('Parent')" />
							@php
								$options = $categories
								    ->map(function ($category) {
								        return ['value' => $category->id, 'text' => $category->name];
								    })
								    ->prepend(['value' => '', 'text' => 'None'])
								    ->toArray();
							@endphp
							<x-form.select class="mt-1 block w-full" id="parent_id" name="parent_id" :value="old('parent_id')" :options="$options"
								autofocus autocomplete="parent_id" />
							<x-input-error class="mt-2" :messages="$errors->get('parent_id')" />
						</div>
					@endif

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
