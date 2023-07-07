<nav
	class="duration-250 ease-soft-in relative mx-6 flex flex-wrap items-center justify-between rounded-2xl px-0 py-2 shadow-none transition-all lg:flex-nowrap lg:justify-start"
	navbar-main navbar-scroll="true">
	<div class="flex-wrap-inherit mx-auto flex w-full items-center justify-between px-4 py-1">
		<nav>
			<ol class="mr-12 flex flex-wrap rounded-lg bg-transparent pt-1 sm:mr-16">
				@foreach ($breadcrumbs as $breadcrumb)
					@if ($loop->last)
						<li class="text-sm leading-normal">
							<span class="text-slate-700">{{ $breadcrumb['text'] }}</span>
						</li>
					@else
						<li class="text-sm leading-normal">
							<a class="text-slate-700 opacity-50" href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a>
							<span class="px-2 text-slate-700 opacity-50">/</span>
						</li>
					@endif
				@endforeach
			</ol>
		</nav>

		<div class="mt-2 flex grow items-center sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
			<div class="flex items-center md:ml-auto md:pr-4">
				<div class="ease-soft relative flex w-full flex-wrap items-stretch rounded-lg transition-all">
					<span
						class="ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center text-sm font-normal text-slate-500 transition-all">
						<i class="fas fa-search"></i>
					</span>
					<input
						class="pl-8.75 focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-sm text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
						type="text" placeholder="Type here..." />
				</div>
			</div>
			<ul class="md-max:w-full mb-0 flex list-none flex-row justify-end pl-0">
				{{-- <li class="flex items-center">
					<a class="ease-nav-brand block px-0 py-2 text-sm font-semibold text-slate-500 transition-all"
						href="../pages/sign-in.html">
						<i class="fa fa-user sm:mr-1"></i>
						<span class="hidden sm:inline">Sign In</span>
					</a>
				</li> --}}
				<li class="flex items-center px-2 xl:hidden">
					<a class="ease-nav-brand block p-0 text-sm text-slate-500 transition-all" href="javascript:;" sidenav-trigger>
						<div class="w-4.5 overflow-hidden">
							<i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
							<i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
							<i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
						</div>
					</a>
				</li>

				<!-- notifications -->

				<li class="relative flex items-center px-2">
					<p class="transform-dropdown-show hidden"></p>
					<a class="ease-nav-brand block p-0 text-sm text-slate-500 transition-all" href="javascript:;" aria-expanded="false"
						dropdown-trigger>
						<i class="fa fa-bell cursor-pointer"></i>
					</a>

					<ul
						class="transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease-soft lg:shadow-soft-3xl duration-250 min-w-44 before:sm:right-7.5 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-sm text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer"
						dropdown-menu>
						<li class="relative mb-2">
							<a
								class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
								href="javascript:;">
								<div class="flex py-1">
									<div class="my-auto">
										<div
											class="mr-4 inline-flex h-9 w-9 max-w-none items-center justify-center rounded-xl bg-gradient-to-tl from-gray-900 to-slate-800 text-sm text-white">
											<i class="fa fa-envelope"></i>
										</div>
									</div>
									<div class="flex flex-col justify-center">
										<h6 class="mb-1 text-sm font-normal leading-normal"><span class="font-semibold">New message</span> from Laur
										</h6>
										<p class="mb-0 text-xs leading-tight text-slate-400">
											<i class="fa fa-clock mr-1"></i>
											13 minutes ago
										</p>
									</div>
								</div>
							</a>
						</li>

						<li class="relative mb-2">
							<a
								class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700"
								href="javascript:;">
								<div class="flex py-1">
									<div class="my-auto">
										<div
											class="mr-4 inline-flex h-9 w-9 max-w-none items-center justify-center rounded-xl bg-gradient-to-tl from-gray-900 to-slate-800 text-sm text-white">
											<i class="fa fa-envelope"></i>
										</div>
									</div>
									<div class="flex flex-col justify-center">
										<h6 class="mb-1 text-sm font-normal leading-normal"><span class="font-semibold">New album</span> by Travis
											Scott</h6>
										<p class="mb-0 text-xs leading-tight text-slate-400">
											<i class="fa fa-clock mr-1"></i>
											1 day
										</p>
									</div>
								</div>
							</a>
						</li>

						<li class="relative">
							<a
								class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg px-4 transition-colors duration-300 hover:bg-gray-200 hover:text-slate-700"
								href="javascript:;">
								<div class="flex py-1">
									<div class="my-auto">
										<div
											class="mr-4 inline-flex h-9 w-9 max-w-none items-center justify-center rounded-xl bg-gradient-to-tl from-gray-900 to-slate-800 text-sm text-white">
											<i class="fa fa-envelope"></i>
										</div>
									</div>
									<div class="flex flex-col justify-center">
										<h6 class="mb-1 text-sm font-normal leading-normal">Payment successfully completed</h6>
										<p class="mb-0 text-xs leading-tight text-slate-400">
											<i class="fa fa-clock mr-1"></i>
											2 days
										</p>
									</div>
								</div>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
