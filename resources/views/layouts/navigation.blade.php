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
					<a href="{{ route('home') }}">
						<x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
					</a>
				</div>

				<!-- Navigation Links -->
				<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-nav-link :href="route('home')" :active="request()->routeIs('home')">
						{{ __('Home') }}
					</x-nav-link>
					<x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
						{{ __('Categories') }}
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
								@if (Auth::user())
									<i class="fas fa-user"></i>
								@else
									<i class="fas fa-user-secret"></i>
								@endif
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
			<x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
				{{ __('Home') }}
			</x-responsive-nav-link>
			<x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')">
				{{ __('Categories') }}
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
