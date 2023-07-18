<div x-data="imageInput" {{ $attributes->only(['class']) }}>
	<x-form.input type="file" x-ref="input" x-on:change="handleInputChange" {{ $attributes->except(['class']) }} />

	<div class="mt-2 grid grid-cols-2 gap-2" x-show="images.length > 0">
		<template x-for="(image, index) in images" x-bind:key="image.name + index">
			<div class="rounded-2 relative h-64">
				<img class="rounded-2 absolute inset-0 h-full w-full object-cover" x-bind:src="image.src"
					x-bind:alt="image.name" />

				<button
					class="absolute top-2 right-2 flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 p-2 text-lg text-gray-500 hover:text-gray-700"
					type="button" x-on:click.prevent="removeImage(index)">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</template>
	</div>
</div>
