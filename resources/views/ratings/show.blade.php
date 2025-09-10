<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				{{ __('Rating Detail') }} #{{ $rating->id_rating }}
			</h2>
			<a href="{{ route('ratings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
							<p class="text-lg">{{ $rating->user->name }} ({{ $rating->user->email }})</p>
						</div>
						<div>
							<h3 class="text-sm font-semibold text-gray-500">Talent</h3>
							<p class="text-lg">{{ $rating->talent->user->name }} - {{ $rating->talent->spesialisasi }}</p>
						</div>
						<div>
							<h3 class="text-sm font-semibold text-gray-500">Booking</h3>
							<p class="text-lg">#{{ $rating->booking->id_booking }} - {{ $rating->booking->portfolio->judul ?? 'Tanpa Judul' }}</p>
						</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div>
							<h3 class="text-sm font-semibold text-gray-500">Score</h3>
							<p class="text-lg">{{ $rating->score_rating }}/5</p>
						</div>
						<div>
							<h3 class="text-sm font-semibold text-gray-500">Komentar</h3>
							<p class="text-lg">{{ $rating->komentar }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout> 