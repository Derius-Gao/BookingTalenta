<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				{{ __('Payment Detail') }} #{{ $pembayaran->id_pembayaran }}
			</h2>
			<a href="{{ route('pembayarans.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
				{{ __('Back') }}
			</a>
		</div>
	</x-slot>

	<div class="py-12">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div>
							<h3 class="text-sm font-semibold text-gray-500">User</h3>
							<p class="text-lg">{{ $pembayaran->user->name }} ({{ $pembayaran->user->email }})</p>
						</div>
						<div>
							<h3 class="text-sm font-semibold text-gray-500">Booking</h3>
							<p>
								#{{ $pembayaran->booking->id_booking }} - {{ $pembayaran->booking->portfolio->judul ?? 'Tanpa Judul' }}<br>
								Client: {{ $pembayaran->booking->user->name }}<br>
								Talent: {{ $pembayaran->booking->talent->user->name }}
							</p>
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div>
							<h3 class="text-sm font-semibold text-gray-500">Jumlah Harga</h3>
							<p class="text-lg">Rp {{ number_format($pembayaran->jumlah_harga) }}</p>
						</div>
						<div>
							<h3 class="text-sm font-semibold text-gray-500">Metode</h3>
							<p class="text-lg">{{ strtoupper($pembayaran->metode_pembayaran) }}</p>
						</div>
						<div>
							<h3 class="text-sm font-semibold text-gray-500">Status</h3>
							<p class="text-lg">{{ ucfirst($pembayaran->status_pembayaran) }}</p>
						</div>
						<div>
							<h3 class="text-sm font-semibold text-gray-500">Tanggal</h3>
							<p class="text-lg">{{ $pembayaran->tanggal_pembayaran->format('M d, Y H:i') }}</p>
						</div>
					</div>

					<div>
						<h3 class="text-sm font-semibold text-gray-500 mb-2">Bukti Pembayaran</h3>
						@if($pembayaran->bukti_pembayaran)
							<img src="{{ Storage::url($pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="h-48 object-cover rounded">
						@else
							<p class="text-gray-500">Tidak ada bukti.</p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout> 