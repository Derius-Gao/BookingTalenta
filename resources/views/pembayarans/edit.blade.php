<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				{{ __('Edit Payment') }} #{{ $pembayaran->id_pembayaran }}
			</h2>
			<a href="{{ route('pembayarans.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
				{{ __('Back') }}
			</a>
		</div>
	</x-slot>

	<div class="py-12">
		<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					@if ($errors->any())
						<div class="mb-4 p-4 rounded bg-red-100 text-red-700">
							<ul class="list-disc list-inside">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form action="{{ route('pembayarans.update', $pembayaran) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
						@csrf
						@method('PUT')

						<div>
							<label for="id_user" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
							<select id="id_user" name="id_user" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required>
								@foreach($users as $user)
									<option value="{{ $user->id }}" {{ old('id_user', $pembayaran->id_user) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
								@endforeach
							</select>
						</div>

						<div>
							<label for="id_booking" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Booking</label>
							<select id="id_booking" name="id_booking" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required>
								@foreach($bookings as $booking)
									<option value="{{ $booking->id_booking }}" {{ old('id_booking', $pembayaran->id_booking) == $booking->id_booking ? 'selected' : '' }}>
										#{{ $booking->id_booking }} - {{ $booking->portfolio->judul ?? 'Tanpa Judul' }} - {{ $booking->user->name }} -> {{ $booking->talent->user->name }}
									</option>
								@endforeach
							</select>
						</div>

						<div>
							<label for="jumlah_harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Harga (Rp)</label>
							<input type="number" id="jumlah_harga" name="jumlah_harga" value="{{ old('jumlah_harga', $pembayaran->jumlah_harga) }}" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required />
						</div>

						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pembayaran</label>
								<select id="metode_pembayaran" name="metode_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required>
									<option value="cash" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'cash' ? 'selected' : '' }}>Cash</option>
									<option value="qris" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'qris' ? 'selected' : '' }}>QRIS</option>
									<option value="gopay" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'gopay' ? 'selected' : '' }}>GoPay</option>
								</select>
							</div>
							<div>
								<label for="status_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status Pembayaran</label>
								<select id="status_pembayaran" name="status_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required>
									<option value="menunggu pembayaran" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
									<option value="menunggu verifikasi" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'menunggu verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
									<option value="selesai" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'selesai' ? 'selected' : '' }}>Selesai</option>
									<option value="batal" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'batal' ? 'selected' : '' }}>Batal</option>
								</select>
							</div>
						</div>

						<div>
							<label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bukti Pembayaran (Gambar)</label>
							@if($pembayaran->bukti_pembayaran)
								<div class="mb-2">
									<img src="{{ Storage::url($pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="h-24 w-24 object-cover rounded" />
								</div>
							@endif
							<input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300" />
							<p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti.</p>
						</div>

						<div>
							<label for="tanggal_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pembayaran</label>
							<input type="datetime-local" id="tanggal_pembayaran" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required />
						</div>

						<div class="flex justify-end">
							<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout> 