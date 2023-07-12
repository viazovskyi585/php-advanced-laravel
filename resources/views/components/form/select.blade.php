@props([
    'size' => 'md',
    'options' => [],
    'value' => '',
])

@php
	$sizes = [
	    'sm' => 'py-1',
	    'md' => 'py-2',
	    'lg' => 'py-3',
	];
	
	if ($attributes->has('multiple')) {
	    $value = is_array($value) ? $value : [];
	}
	
	function isOptionSelected($option, $value)
	{
	    if (is_array($value)) {
	        return in_array($option['value'], $value);
	    }
	
	    return $option['value'] == $value;
	}
@endphp

<select
	{{ $attributes->merge(['class' => 'focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none ' . $sizes[$size]]) }}>
	@foreach ($options as $option)
		<option value="{{ $option['value'] }}" {{ isOptionSelected($option, $value) ? 'selected' : '' }}>
			{{ $option['text'] }}</option>
	@endforeach
	{{ $slot }}
</select>
