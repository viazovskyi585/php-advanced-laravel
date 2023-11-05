<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link href="https://fonts.bunny.net" rel="preconnect">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="work-sans bg-white font-sans text-base leading-normal tracking-normal text-gray-600 antialiased" hx-boost="true">
	<div class="min-h-screen bg-gray-100">
		@include('layouts.navigation')

		<!-- Page Heading -->
		@if (isset($header))
			<header class="bg-white shadow">
				<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
					{{ $header }}
				</div>
			</header>
		@endif

		<!-- Page Content -->
		<main>
			{{ $slot }}
		</main>

		<footer class="border-t border-gray-400 bg-white py-8">
			<div class="container flex px-3 py-8">
				<div class="mx-auto flex w-full flex-wrap">
					<div class="flex w-full lg:w-1/2">
						<div class="px-3 md:px-0">
							<h3 class="font-bold text-gray-900">About</h3>
							<p class="py-4">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus commodo nec id erat.
								Suspendisse consectetur dapibus velit ut lacinia.
							</p>
						</div>
					</div>
					<div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right">
						<div class="px-3 md:px-0">
							<h3 class="font-bold text-gray-900">Social</h3>
							<ul class="list-reset items-center pt-3">
								<li>
									<a class="inline-block py-1 no-underline hover:text-black hover:underline" href="#">Add social links</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>

    <script src="{{ asset('js/iziToast.js') }}"></script>

    @include('vendor.lara-izitoast.toast')
</body>

</html>
