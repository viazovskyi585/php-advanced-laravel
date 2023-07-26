@props([
    'image' => null,
    'header' => null,
    'link' => '',
    'linkText' => '',
])

@php
	$image = $image ?? 'https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80';
@endphp

<section class="bg-nordic-gray-light mx-auto flex w-full bg-cover bg-right pt-12 md:items-center md:pt-0"
	style="max-width:1600px; height: 32rem; background-image: url({{ $image }});">
	<div class="container mx-auto">
		<div class="flex w-full flex-col items-start justify-center px-6 tracking-wide lg:w-1/2">
			<h1 class="my-4 text-2xl text-black">{{ $header ?? 'Stripy Zig Zag Jigsaw Pillow and Duvet Set' }}</h1>
			@if (!empty($link))
				<a
					class="inline-block border-b border-gray-600 text-xl leading-relaxed no-underline hover:border-black hover:text-black"
					href="{{ $link ?? '#' }}">{{ $linkText }}</a>
			@endif
		</div>
	</div>
</section>
