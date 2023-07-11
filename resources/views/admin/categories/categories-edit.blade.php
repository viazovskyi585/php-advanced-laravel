<x-admin-layout :breadcrumbs="[['text' => 'Categories', 'href' => route('admin.categories.index')], ['text' => 'Edit']]">
	<div class="w-full max-w-full flex-none px-3">
		<div
			class="shadow-soft-xl relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border p-4">
			<div class="mx-auto w-full max-w-[600px]">
				<h4>Edit category "{{ $category->name }}"</h4>

				<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
					@csrf
					@method('PUT')

					<div class="mt-4">
						<x-input-label for="name" :value="__('Name')" />
						<x-form.input class="mt-1 block w-full" id="name" name="name" type="text" :value="$category->name" required
							autofocus autocomplete="name" />
						<x-input-error class="mt-2" :messages="$errors->get('name')" />
					</div>

					<div class="mt-4">
						<x-input-label for="description" :value="__('Description')" />
						<x-form.textarea class="mt-1 block w-full" id="description" name="description" type="text" rows="5"
							required autofocus autocomplete="description">{{ $category->description }}</x-form.textarea>
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
							<x-form.select class="mt-1 block w-full" id="parent_id" name="parent_id" :value="$category->parent_id" :options="$options"
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
