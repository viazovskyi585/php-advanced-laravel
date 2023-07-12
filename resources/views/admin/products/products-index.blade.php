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
			class="shadow-soft-xl relative mb-6 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border">
			<div
				class="border-b-solid mb-0 flex items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
				<h4>Products</h4>

				<x-app-button href="{{ route('admin.products.create') }}" theme="primary" size="sm">
					<i class="fas fa-plus"></i>
					Add new product
				</x-app-button>
			</div>

			<div class="flex-auto px-0 pt-0 pb-2">
				<div class="overflow-x-auto p-0">
					<table class="mb-0 w-full items-center border-gray-200 align-top text-slate-500">
						<thead class="align-bottom">
							<tr>
								<th
									class="border-b-solid tracking-none whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-left align-middle text-xs font-bold uppercase text-slate-400 opacity-70 shadow-none">
									Thumbnail</th>
								<th
									class="border-b-solid tracking-none whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-left align-middle text-xs font-bold uppercase text-slate-400 opacity-70 shadow-none">
									Title</th>
								<th
									class="border-b-solid tracking-none whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-center align-middle text-xs font-bold uppercase text-slate-400 opacity-70 shadow-none">
									SKU</th>
								<th
									class="border-b-solid tracking-none whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-center align-middle text-xs font-bold uppercase text-slate-400 opacity-70 shadow-none">
									Categories</th>
								<th
									class="border-b-solid tracking-none whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-right align-middle text-xs font-bold uppercase text-slate-400 opacity-70 shadow-none">
									Discount</th>
								<th
									class="border-b-solid tracking-none whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-right align-middle text-xs font-bold uppercase text-slate-400 opacity-70 shadow-none">
									Price</th>
								<th
									class="border-b-solid tracking-none whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-right align-middle text-xs font-bold uppercase text-slate-400 opacity-70 shadow-none">
									Quantity</th>
								<th
									class="border-b-solid tracking-none whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-center align-middle text-xs font-bold uppercase text-slate-400 opacity-70 shadow-none">
									Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $product)
								<tr>
									<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
										<div class="px-2 py-1">
											<img class="w-30 h-10 object-cover object-center" src="{{ $product->thumbnail_url }}"
												alt="{{ $product->title }}">
										</div>
									</td>
									<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
										<div class="px-2 py-1">
											<div class="text-sm font-bold leading-normal">{{ $product->title }}</div>
										</div>
									</td>
									<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
										<div class="px-2 py-1">
											<div class="text-sm leading-normal">{{ $product->SKU }}</div>
										</div>
									</td>
									<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
										<div class="px-2 py-1">
											@if ($product->categories->isNotEmpty())
												@foreach ($product->categories as $category)
													<a class="text-xs font-semibold leading-tight text-slate-400 hover:underline"
														href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a>
													@if (!$loop->last)
														,
													@endif
												@endforeach
											@else
												<span>-</span>
											@endif
										</div>
									</td>
									<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
										<div class="px-2 py-1">
											<div class="text-right text-sm font-semibold leading-normal">{{ $product->discount }}</div>
										</div>
									</td>
									<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
										<div class="px-2 py-1">
											<div class="text-right text-sm font-semibold leading-normal">{{ $product->price }}</div>
										</div>
									</td>
									<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
										<div class="px-2 py-1">
											<div class="text-right text-sm font-semibold leading-normal">{{ $product->quantity }}</div>
										</div>
									</td>
									<td class="border-b bg-transparent p-2 text-center align-middle shadow-transparent">
										<div class="flex items-center gap-1">
											<x-app-button href="{{ route('admin.products.edit', $product) }}" theme="info" size="sm">
												<i class="fas fa-edit"></i>
											</x-app-button>
											<form class="inline-block" action="{{ route('admin.products.destroy', $product) }}" method="POST">
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
				{{ $products->links() }}
			</div>

		</div>

	</div>
</x-admin-layout>
