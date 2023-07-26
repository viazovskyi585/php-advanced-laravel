@props([
    'max' => 1,
    'name' => 'count',
])

<div class="flex items-center space-x-4 rounded-4 bg-gray-50 px-2" x-data="{ value: 1 }">
	<button
		class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none"
		type="button" x-on:click="value = value === 1 ? 1 : value - 1">
		<i class="fas fa-minus"></i>
	</button>
	<input
		class="block w-14 appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 text-center text-sm font-normal leading-5.6 text-gray-700 outline-none transition-all ease-soft placeholder:text-gray-500 focus:border-fuchsia-300 focus:shadow-soft-primary-outline focus:outline-none"
		type="text" min="1" x-model="value"
		x-on:change="
            if (isNaN(value)) {
                value = 1
            } else if (value < 1) {
                value = 1
            } else if (value > {{ $max }}) {
                value = {{ $max }}
            }
        " />
	<button
		class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none"
		class="fas fa-plus" type="button"
		x-on:click="value = value >= {{ $max }} ? {{ $max }} : value + 1">
		<i class="fas fa-plus"></i>
	</button>
</div>
