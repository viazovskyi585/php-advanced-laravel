<aside
	class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
	<div class="h-19.5">
		<i class="fas fa-times absolute top-0 right-0 hidden cursor-pointer p-4 text-slate-400 opacity-50 xl:hidden"
			aria-hidden="true" sidenav-close=""></i>
		<a class="m-0 block whitespace-nowrap px-8 py-6 text-sm text-slate-700" href="javascript:;" target="_blank">
			<span class="ease-nav-brand ml-1 font-semibold transition-all duration-200">Soft UI Dashboard</span>
		</a>
	</div>

	<hr class="mt-0 h-px bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent">

	<div class="block max-h-screen w-auto grow basis-full items-center overflow-auto">
		<ul class="mb-0 flex flex-col pl-0">

			<x-admin.navigation.sidenav-link title="Dashboard" link="{{ route('admin.dashboard') }}" icon="tachometer-alt"
				active="{{ request()->routeIs('admin.dashboard') }}" />

			<li class="mt-4 w-full">
				<h6 class="ml-2 pl-6 text-xs font-bold uppercase leading-tight opacity-60">Categories</h6>
			</li>

			<x-admin.navigation.sidenav-link title="Categories" link="{{ route('admin.categories.index') }}" icon="table"
				active="{{ request()->routeIs('admin.categories.index') }}" />

			<x-admin.navigation.sidenav-link title="Create Category" link="{{ route('admin.categories.create') }}"
				icon="plus-square" active="{{ request()->routeIs('admin.categories.create') }}" />

			<li class="mt-4 w-full">
				<h6 class="ml-2 pl-6 text-xs font-bold uppercase leading-tight opacity-60">Products</h6>
			</li>

			<x-admin.navigation.sidenav-link title="Products" link="{{ route('admin.products.index') }}" icon="table"
				active="{{ request()->routeIs('admin.products.index') }}" />

			<x-admin.navigation.sidenav-link title="Create Product" link="{{ route('admin.products.create') }}"
				icon="plus-square" active="{{ request()->routeIs('admin.products.create') }}" />

			<li class="mt-4 w-full">
				<h6 class="ml-2 pl-6 text-xs font-bold uppercase leading-tight opacity-60">Account pages</h6>
			</li>

			<x-admin.navigation.sidenav-link title="Profile" link="" icon="user-circle" />
		</ul>
	</div>

</aside>
