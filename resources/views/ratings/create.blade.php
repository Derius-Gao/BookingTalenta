<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				{{ __('Create Rating') }}
			</h2>
			<a href="{{ route('ratings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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

					<form action="{{ route('ratings.store') }}" method="POST" class="space-y-6">
						@csrf

						<div>
							<label for="id_user" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
							<select id="id_user" name="id_user" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required>
								<option value="">-- Pilih User --</option>
								@foreach($users as $user)
									<option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
								@endforeach
							</select>
						</div>

						<div>
							<label for="id_talenta" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Talent</label>
							<select id="id_talenta" name="id_talenta" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required>
								<option value="">-- Pilih Talent --</option>
								@foreach($talents as $talent)
									<option value="{{ $talent->id_talenta }}" {{ old('id_talenta') == $talent->id_talenta ? 'selected' : '' }}>{{ $talent->user->name }} - {{ $talent->spesialisasi }}</option>
								@endforeach
							</select>
						</div>

						<div>
							<label for="id_booking" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Booking</label>
							<select id="id_booking" name="id_booking" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required>
								<option value="">-- Pilih Booking --</option>
								@foreach($bookings as $booking)
									<option value="{{ $booking->id_booking }}" {{ old('id_booking') == $booking->id_booking ? 'selected' : '' }}>
										#{{ $booking->id_booking }} - {{ $booking->portfolio->judul ?? 'Tanpa Judul' }} - {{ $booking->user->name }} -> {{ $booking->talent->user->name }}
									</option>
								@endforeach
							</select>
						</div>

						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<label for="score_rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Score (1-5)</label>
								<input type="number" id="score_rating" name="score_rating" value="{{ old('score_rating') }}" min="1" max="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required />
							</div>
							<div>
								<label for="komentar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Komentar</label>
								<input type="text" id="komentar" name="komentar" value="{{ old('komentar') }}" maxlength="255" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700" required />
							</div>
						</div>

						<div class="flex justify-end">
							<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout> 