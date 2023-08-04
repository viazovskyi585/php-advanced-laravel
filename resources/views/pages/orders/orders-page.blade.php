<x-app-layout>

	<div
		class="container relative my-10 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid border-transparent bg-white bg-clip-border shadow-soft-xl">
		<div
			class="border-b-solid mb-0 flex items-center justify-between rounded-t-2xl border-b-0 border-b-transparent bg-white p-6 pb-0">
			<h4>Orders</h4>
		</div>

		<div class="flex-auto px-0 pb-2 pt-0">
			<div class="overflow-x-auto p-0">
				<table class="mb-0 w-full items-center border-gray-200 align-top text-slate-500">
					<thead class="align-bottom">
						<tr>
							<th
								class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-4 py-3 text-left align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
								Id</th>
							<th
								class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-6 py-3 text-left align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
								Status</th>
							<th
								class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-6 py-3 pl-2 text-left align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
								City</th>
							<th
								class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-6 py-3 text-center align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
								Address</th>
							<th
								class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-6 py-3 text-center align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
								Date</th>
							<th
								class="border-b-solid whitespace-nowrap border-b border-gray-200 bg-transparent px-6 py-3 text-center align-middle text-xs font-bold uppercase tracking-none text-slate-400 opacity-70 shadow-none">
								Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($orders as $order)
							<tr>
								<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
									<div class="flex px-2 py-1">
										<div class="flex flex-col justify-center">
											{{ $order->id }}
										</div>
									</div>
								</td>
								<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
									<div class="flex px-2 py-1">
										<div class="flex flex-col justify-center">
											{{ $order->status->name }}
										</div>
									</div>
								</td>
								<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
									<div class="flex px-2 py-1">
										<div class="flex flex-col justify-center">
											{{ $order->city }}
										</div>
									</div>
								</td>
								<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
									<div class="flex px-2 py-1">
										<div class="flex flex-col justify-center">
											{{ $order->address }}
										</div>
									</div>
								</td>
								<td class="border-b bg-transparent p-2 align-middle shadow-transparent">
									<div class="flex px-2 py-1">
										<div class="flex flex-col justify-center">
											{{ $order->created_at }}
										</div>
									</div>
								</td>
								<td class="border-b bg-transparent p-2 text-center align-middle shadow-transparent">
									<div class="flex items-center justify-center gap-1">
										<x-app-button href="#" theme="info" size="sm">
											<i class="fas fa-eye"></i>
										</x-app-button>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="p-4 pt-2">
			{{ $orders->links() }}
		</div>

	</div>

</x-app-layout>
