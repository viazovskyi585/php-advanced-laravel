@props([
    'categories' => [],
])

@php
	$breadcrumbs = [['name' => 'Home', 'link' => route('home')], ['name' => 'Categories', 'link' => route('categories.index')]];
	$prevSlug = '';
	foreach ($categories as $category) {
	    $prevSlug .= $category->slug . '/';
	    $breadcrumbs[] = ['name' => $category->name, 'link' => route('categories.show', $prevSlug)];
	}
@endphp

<x-breadcrumbs :links="$breadcrumbs" />
