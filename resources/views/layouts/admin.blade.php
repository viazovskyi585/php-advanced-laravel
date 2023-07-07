<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link href="https://fonts.bunny.net" rel="preconnect">
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/css/admin/admin.styles.css', 'resources/js/admin/admin.app.js'])
</head>

<body class="leading-default m-0 bg-gray-50 font-sans text-base font-normal text-slate-500 antialiased">
	<x-admin.navigation.sidenav />

	<main
		class="ease-soft-in-out xl:ml-68.5 relative flex h-screen max-h-screen flex-col rounded-xl transition-all duration-200">
		<!-- Navbar -->
		<x-admin.navigation.navbar />
		<div class="mx-auto flex w-full flex-1 flex-col px-6 py-6">
			{{ $slot }}
			<x-admin.footer class="" />
		</div>
	</main>
</body>

</html>
