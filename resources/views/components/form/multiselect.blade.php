@props([
    'options' => [],
    'value' => [],
])

<div class="relative flex flex-col items-center" x-data="multiselect">
	<select class="hidden" name="{{ $attributes->get('name') }}" x-ref="select" multiple>
		<option value=""></option>
		@foreach ($options as $option)
			<option value="{{ $option['value'] }}" {{ in_array($option['value'], $value) ? 'selected' : '' }}>
				{{ $option['text'] }}</option>
		@endforeach
	</select>

	{{-- Input --}}
	<div {{ $attributes->merge(['class' => 'w-full']) }}>
		<div
			class="focus-within:shadow-soft-primary-outline my-2 flex rounded-lg border border-solid border-gray-300 bg-white p-1 focus-within:border-fuchsia-300">
			<div class="flex flex-auto flex-wrap">
				<template x-for="(selectedOption, index) in selectedOptions" :key="index">
					<div
						class="m-1 flex items-center justify-center rounded-full border border-fuchsia-300 bg-fuchsia-100 py-1 px-2 font-medium text-fuchsia-700">
						<div class="max-w-full flex-initial text-xs font-normal leading-none" x-text="selectedOption.text"></div>
						<div class="flex flex-auto flex-row-reverse" x-on:click="removeSelectedOption(selectedOption)">
							<i class="fa fa-times ml-2 h-4 w-4 cursor-pointer hover:text-fuchsia-400" aria-hidden="true"></i>
						</div>
					</div>
				</template>
			</div>
			<div class="flex w-8 items-center border-l border-gray-200 py-1 pl-2 pr-1 text-gray-300">
				<button class="h-6 w-6 cursor-pointer text-gray-600 outline-none focus:outline-none" type="button"
					x-on:click="open = !open">
					<i class="fa" x-bind:class="{ 'fa-chevron-down': !open, 'fa-chevron-up': open }"></i>
				</button>
			</div>
		</div>
	</div>

	{{--  Dropdown  --}}
	<div class="absolute left-0 top-full z-40 max-h-96 w-full overflow-y-auto rounded bg-white shadow"
		x-on:click.away="open = false" x-show="open" x-transition>
		<div class="flex w-full flex-col">
			<template x-for="(option, index) in options" :key="index">
				<div class="w-full cursor-pointer rounded-t border-b border-gray-100 hover:bg-fuchsia-100"
					x-bind:data-index="index" x-on:click="handleOptionClick(index)">
					<div class="relative flex w-full items-center border-l-2 border-transparent p-2 pl-2 hover:border-fuchsia-100"
						x-bind:class="{ 'border-fuchsia-600': option.selected }">
						<div class="flex w-full items-center">
							<div class="mx-2 leading-6" x-text="option.text"></div>
						</div>
					</div>
				</div>
			</template>
		</div>
	</div>
</div>
