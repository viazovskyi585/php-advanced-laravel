@props([
    'theme' => 'primary',
    'size' => 'md',
])

@php
	$defaultClasses = 'inline-block font-bold text-center bg-gradient-to-tl text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs';
	
	$themeClassesDict = [
	    'primary' => 'from-purple-700 to-pink-500',
	    'secondary' => 'from-slate-600 to-slate-300',
	    'info' => 'from-blue-600 to-cyan-400',
	    'success' => 'from-green-600 to-lime-400',
	    'danger' => 'from-red-600 to-rose-400',
	    'warning' => 'from-red-500 to-yellow-400',
	];
	
	$sizeClassesDict = [
	    'sm' => 'px-4 py-2 text-xs',
	    'md' => 'px-6 py-3 text-sm',
	    'lg' => 'px-8 py-4 text-base',
	];
	
	$themeClasses = $themeClassesDict[$theme];
	$sizeClasses = $sizeClassesDict[$size];
	$tag = $attributes->get('href') ? 'a' : 'button';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $defaultClasses . ' ' . $sizeClasses . ' ' . $themeClasses]) }}>
	{{ $slot }}
	</{{ $tag }}>
