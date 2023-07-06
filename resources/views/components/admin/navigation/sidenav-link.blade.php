@props([
    'active' => false,
    'link' => '#',
    'icon' => '',
    'title' => '',
])

<li class="{{ $attributes->merge(['class' => 'mt-0.5 w-full'])->get('class') }}">
	<a
		class="py-2.7 ease-nav-brand {{ $active ? 'bg-white font-semibold text-slate-700' : '' }} my-0 mx-4 flex items-center whitespace-nowrap rounded-lg px-4 text-sm transition-colors"
		href="{{ $link }}">
		@if (!empty($icon))
			<div
				class="shadow-soft-2xl {{ $active ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
				<i class="fas fa-{{ $icon }}" aria-hidden="true"></i>
			</div>
		@endif
		<span class="ease-soft pointer-events-none ml-1 opacity-100 duration-300">{{ $title }}</span>
	</a>
</li>
