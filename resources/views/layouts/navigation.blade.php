@php
	use App\Enums\Roles;
@endphp

<nav class="border-b border-gray-100 bg-white" x-data="{ open: false }">
	<!-- Primary Navigation Menu -->
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
		<div class="flex h-16 justify-between">
			<div class="flex">
				<!-- Logo -->
				<div class="flex shrink-0 items-center">
					<a href="{{ route('dashboard') }}">
						<x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
					</a>
				</div>

				<!-- Navigation Links -->
				<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
						{{ __('Dashboard') }}
					</x-nav-link>
				</div>
			</div>

			<div class="ml-auto flex">
				<!-- Settings Dropdown -->
				<div class="hidden sm:ml-6 sm:flex sm:items-center">

					<x-dropdown align="right" width="48">
						<x-slot name="trigger">
							<button
								class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
								<i class="fas fa-user"></i>
							</button>
						</x-slot>

						<x-slot name="content">
							@if (Auth::user())
								<!-- User Name -->
								<div class="block px-4 py-2 text-xs text-gray-500">
									{{ Auth::user()->getFullName() }}
								</div>

								<x-dropdown-link :href="route('profile.edit')">
									{{ __('Profile') }}
								</x-dropdown-link>

								@hasanyrole(implode('|', [Roles::EDITOR->value, Roles::MANAGER->value, Roles::ADMIN->value]))
									<x-dropdown-link :href="route('admin.dashboard')">
										{{ __('Admin Dashboard') }}
									</x-dropdown-link>
								@endhasanyrole

								<!-- Authentication -->
								<form method="POST" action="{{ route('logout') }}">
									@csrf

									<x-dropdown-link :href="route('logout')"
										onclick="event.preventDefault();
                                                    this.closest('form').submit();">
										{{ __('Log Out') }}
									</x-dropdown-link>
								</form>
							@else
								<x-dropdown-link :href="route('login')">
									{{ __('Login') }}
								</x-dropdown-link>
								<x-dropdown-link :href="route('register')">
									{{ __('Register') }}
								</x-dropdown-link>
							@endif
						</x-slot>
					</x-dropdown>

				</div>

				<!-- Cart -->
				<a
					class="flex items-center justify-center px-4 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
					href="#">
					<i class="fas fa-shopping-cart"></i>
				</a>
			</div>

			<!-- Hamburger -->
			<div class="-mr-2 flex items-center sm:hidden">
				<button
					class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
					x-on:click="open = ! open">
					<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path class="inline-flex" :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
						<path class="hidden" :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Responsive Navigation Menu -->
	<div class="hidden sm:hidden" :class="{ 'block': open, 'hidden': !open }">
		<div class="space-y-1 pb-3 pt-2">
			<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
				{{ __('Dashboard') }}
			</x-responsive-nav-link>
		</div>

		<!-- Responsive Settings Options -->
		<div class="border-t border-gray-200 pb-1 pt-4">
			<div class="px-4">
				@if (Auth::user())
					<div class="text-base font-medium text-gray-800">{{ Auth::user()->getFullName() }}
					</div>
					<div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
				@else
					<div class="text-base font-medium text-gray-800">Guest</div>
					<div class="text-sm font-medium text-gray-500">
						<a class="text-sm text-gray-700 underline" href="{{ route('login') }}">Login</a>
						<a class="ml-4 text-sm text-gray-700 underline" href="{{ route('register') }}">Register</a>
					</div>
				@endif
			</div>

			<div class="mt-3 space-y-1">
				<x-responsive-nav-link :href="route('profile.edit')">
					{{ __('Profile') }}
				</x-responsive-nav-link>

				<!-- Authentication -->
				<form method="POST" action="{{ route('logout') }}">
					@csrf

					<x-responsive-nav-link :href="route('logout')"
						onclick="event.preventDefault();
                                        this.closest('form').submit();">
						{{ __('Log Out') }}
					</x-responsive-nav-link>
				</form>
			</div>
		</div>
	</div>
</nav>

{{-- <nav class="top-0 z-30 w-full py-1" x-data="{ open: false }">
	<!-- Primary Navigation Menu -->
	<div class="container mx-auto mt-0 flex w-full flex-wrap items-center justify-between px-6 py-3">
		<div class="container mx-auto mt-0 flex w-full flex-wrap items-center justify-between px-6 py-3">
			<!-- Logo -->
			<div class="flex shrink-0 items-center">
				<a href="{{ route('dashboard') }}">
					<x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
				</a>
			</div>

			<div class="flex">

				<!-- Navigation Links -->
				<div class="order-3 hidden w-full md:order-1 md:flex md:w-auto md:items-center" id="menu">
					<nav>
						<ul class="items-center justify-between pt-4 text-base text-gray-700 md:flex md:pt-0">
							<li>
								<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
									{{ __('Dashboard') }}
								</x-nav-link>
							</li>
						</ul>
					</nav>
				</div>
			</div>

			<!-- Settings Dropdown -->
			<div class="order-2 flex items-center md:order-3" id="nav-content">
				<x-dropdown align="right" width="48">
					<x-slot name="trigger">
						<button
							class="inline-block inline-flex items-center no-underline transition duration-150 ease-in-out hover:text-black focus:outline-none">
							<svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24">
								<circle fill="none" cx="12" cy="7" r="3" />
								<path
									d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
							</svg>

							<div class="ml-1">
								<svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
									<path fill-rule="evenodd"
										d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
										clip-rule="evenodd" />
								</svg>
							</div>
						</button>
						<a class="inline-block pl-3 no-underline hover:text-black" href="#">
							<svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24">
								<path
									d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z" />
								<circle cx="10.5" cy="18.5" r="1.5" />
								<circle cx="17.5" cy="18.5" r="1.5" />
							</svg>
						</a>
					</x-slot>

					<x-slot name="content">
						<x-dropdown-link :href="route('profile.edit')">
							{{ __('Profile') }}
						</x-dropdown-link>

						@hasanyrole('moderator|admin')
							<x-dropdown-link :href="route('admin.dashboard')">
								{{ __('Admin Dashboard') }}
							</x-dropdown-link>
						@endhasanyrole

						<!-- Authentication -->
						<form method="POST" action="{{ route('logout') }}">
							@csrf

							<x-dropdown-link :href="route('logout')"
								onclick="event.preventDefault();
                                                this.closest('form').submit();">
								{{ __('Log Out') }}
							</x-dropdown-link>
						</form>
					</x-slot>
				</x-dropdown>
			</div>

			<!-- Hamburger -->
			<div class="-mr-2 flex items-center sm:hidden">
				<button
					class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
					@click="open = ! open">
					<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path class="inline-flex" :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
						<path class="hidden" :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Responsive Navigation Menu -->
	<div class="hidden sm:hidden" :class="{ 'block': open, 'hidden': !open }">
		<div class="space-y-1 pb-3 pt-2">
			<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
				{{ __('Dashboard') }}
			</x-responsive-nav-link>
		</div>

		<!-- Responsive Settings Options -->
		<div class="border-t border-gray-200 pb-1 pt-4">
			<div class="px-4">
				<div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
				<div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
			</div>

			<div class="mt-3 space-y-1">
				<x-responsive-nav-link :href="route('profile.edit')">
					{{ __('Profile') }}
				</x-responsive-nav-link>

				<!-- Authentication -->
				<form method="POST" action="{{ route('logout') }}">
					@csrf

					<x-responsive-nav-link :href="route('logout')"
						onclick="event.preventDefault();
                                        this.closest('form').submit();">
						{{ __('Log Out') }}
					</x-responsive-nav-link>
				</form>
			</div>
		</div>
	</div>
</nav> --}}
