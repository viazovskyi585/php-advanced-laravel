<textarea
 {{ $attributes->merge(['class' => 'focus:shadow-soft-primary-outline min-h-unset leading-5.6 ease-soft block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 text-sm font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none']) }}>{{ $slot }}</textarea>
