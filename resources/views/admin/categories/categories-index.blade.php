<x-admin-layout>
	<div class="w-full max-w-full flex-none px-3">

		<ul>
			@foreach ($errors->all() as $error)
				<li
					class="relative mb-4 w-full rounded-lg border border-solid border-red-300 bg-gradient-to-tl from-red-600 to-rose-400 px-4 py-2 font-bold text-white">
					{{ $error }}</li>
			@endforeach
		</ul>

		<div
			class="relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border shadow-soft-xl">
			<div
				class="border-b-solid mb-0 flex items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
				<h4>Categories</h4>

				<x-app-button href="{{ route('admin.categories.create') }}" theme="primary" size="sm">
					<i class="fas fa-plus"></i>
					Add new category
				</x-app-button>
			</div>

			<div class="flex-auto px-0 pb-2 pt-0">
				<div class="overflow-x-auto p-0">
					<table class="mb-0 w-full items-center border-gray-200 align-top text-slate-500">
						<thead class="align-bottom">
							<tr>
								<th
									class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-left align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
									Image</th>
								<th
									class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-6 py-3 text-left align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
									Name</th>
								<th
									class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-6 py-3 pl-2 text-left align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
									Description</th>
								<th
									class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-6 py-3 text-center align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
									Parent</th>
								<th
									class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-6 py-3 text-center align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
									Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $category)
								<tr>
									<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
										<div class="px-2 py-1">
											@if ($category->image)
												<img class="h-10 w-30 rounded-2 object-cover object-center" src="{{ $category->image->url }}"
													alt="{{ $category->name }}">
											@endif
										</div>
									</td>
									<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
										<div class="flex px-2 py-1">
											<div class="flex flex-col justify-center">
												<h6 class="mb-0 text-sm leading-normal">{{ $category->name }}</h6>
											</div>
										</div>
									</td>
									<td class="w-1/2 border-b bg-transparent p-2 align-middle shadow-transparent">
										<p class="mb-0 text-xs leading-tight text-slate-400">{{ $category->description }}</p>
									</td>
									<td class="border-b bg-transparent p-2 text-center align-middle shadow-transparent">
										@if ($category->parent)
											<a class="text-xs font-semibold leading-tight text-slate-400 hover:underline"
												href="{{ route('admin.categories.edit', $category->parent) }}">{{ $category->parent->name }}</a>
										@endif
									</td>
									<td class="border-b bg-transparent p-2 text-center align-middle shadow-transparent">
										<div class="flex items-center justify-center gap-1">
											<x-app-button href="{{ route('admin.categories.edit', $category) }}" theme="info" size="sm">
												<i class="fas fa-edit"></i>
											</x-app-button>
											<form class="inline-block" action="{{ route('admin.categories.destroy', $category) }}" method="POST">
												@csrf
												@method('DELETE')
												<x-app-button type="submit" theme="danger" size="sm">
													<i class="fas fa-trash"></i>
												</x-app-button>
											</form>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="p-4 pt-2">
				{{ $categories->links() }}
			</div>

		</div>

	</div>
</x-admin-layout>
