@props([
    'max' => 0,
    'name' => 'count',
    'value' => 1,
])

<div class="flex items-center space-x-4 rounded-4 bg-gray-50 px-2" x-data="{ value: {{ $value }} }">
	<button
		class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none"
		type="button" x-on:click="value = value === 1 ? 1 : Number(value) - 1">
		<i class="fas fa-minus"></i>
	</button>
	<input
		class="block w-14 appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 text-center text-sm font-normal leading-5.6 text-gray-700 outline-none transition-all ease-soft placeholder:text-gray-500 focus:border-fuchsia-300 focus:shadow-soft-primary-outline focus:outline-none"
		name="{{ $name }}" type="text" min="1" x-model="value" x-init="$watch('value', value => $dispatch('change', value))"
		x-on:change="
            if (isNaN(value)) {
                value = 1
            } else if (value < 1) {
                value = 1
            } else if ({{ $max }} && value > {{ $max }}) {
                value = {{ $max }}
            }
        " />
	<button
		class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none"
		type="button" x-bind:class="{ 'cursor-not-allowed opacity-50': {{ $max }} && value >= {{ $max }} }"
		x-on:click="value = ({{ $max }} && value >= {{ $max }}) ? {{ $max }} : Number(value) + 1">
		<i class="fas fa-plus"></i>
	</button>
</div>
