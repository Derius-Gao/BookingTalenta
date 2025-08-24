<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Booking Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('bookings.edit', $booking) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit Booking') }}
                </a>
                <a href="{{ route('bookings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Bookings') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Booking Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-6 text-gray-900 dark:text-gray-100">Booking Information</h3>
                            
                            <div class="space-y-4">
                                <div class="border-b border-gray-200 dark:border-gray-600 pb-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Booking ID</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">#{{ $booking->id_booking }}</p>
                                </div>

                                <div class="border-b border-gray-200 dark:border-gray-600 pb-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $booking->user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->user->email }}</p>
                                </div>

                                <div class="border-b border-gray-200 dark:border-gray-600 pb-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
                                        @if($booking->status == 'selesai') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                        @elseif($booking->status == 'batal') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                        @elseif($booking->status == 'confirmed') bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100
                                        @elseif($booking->status == 'ongoing') bg-purple-100 text-purple-800 dark:bg-purple-800 dark:text-purple-100
                                        @else bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>

                                <div class="border-b border-gray-200 dark:border-gray-600 pb-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi Acara</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $booking->lokasi_acara }}</p>
                                </div>

                                <div class="border-b border-gray-200 dark:border-gray-600 pb-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Harga</label>
                                    <p class="mt-1 text-lg font-bold text-green-600 dark:text-green-400">Rp {{ number_format($booking->jumlah_harga) }}</p>
                                </div>

                                <div class="border-b border-gray-200 dark:border-gray-600 pb-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi Acara</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $booking->deskripsi_acara }}</p>
                                </div>

                                <div class="border-b border-gray-200 dark:border-gray-600 pb-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $booking->created_at->format('M d, Y H:i') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Updated At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $booking->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Talent and Portfolio Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-6 text-gray-900 dark:text-gray-100">Talent & Portfolio Details</h3>
                            
                            <!-- Talent Info -->
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6">
                                <h4 class="font-medium text-lg mb-3 text-gray-900 dark:text-gray-100">Talent Information</h4>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Name:</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100 ml-2">{{ $booking->talent->user->name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Email:</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100 ml-2">{{ $booking->talent->user->email }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Phone:</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100 ml-2">{{ $booking->talent->no_hp }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Specialization:</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100 ml-2">{{ $booking->talent->spesialisasi }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Portfolio Info -->
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <h4 class="font-medium text-lg mb-3 text-gray-900 dark:text-gray-100">Portfolio Information</h4>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Title:</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100 ml-2">{{ $booking->portfolio->judul }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Category:</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100 ml-2">{{ $booking->portfolio->kategori->nama_kategori }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Description:</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100 ml-2">{{ $booking->portfolio->deskripsi }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Price Range:</span>
                                        <span class="text-sm text-gray-900 dark:text-gray-100 ml-2">
                                            Rp {{ number_format($booking->portfolio->harga_minimal) }} - Rp {{ number_format($booking->portfolio->harga_maximal) }}
                                        </span>
                                    </div>
                                    @if($booking->portfolio->foto)
                                        <div>
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Portfolio Image:</span>
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $booking->portfolio->foto) }}" 
                                                     alt="{{ $booking->portfolio->judul }}" 
                                                     class="w-32 h-32 object-cover rounded-lg">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Additional Information -->
                            @if($booking->pembayaran)
                            <div class="bg-blue-50 dark:bg-blue-900 rounded-lg p-4 mt-6">
                                <h4 class="font-medium text-lg mb-3 text-blue-900 dark:text-blue-100">Payment Information</h4>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm font-medium text-blue-700 dark:text-blue-300">Payment Status:</span>
                                        <span class="text-sm text-blue-900 dark:text-blue-100 ml-2">{{ ucfirst($booking->pembayaran->status ?? 'N/A') }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-blue-700 dark:text-blue-300">Amount:</span>
                                        <span class="text-sm text-blue-900 dark:text-blue-100 ml-2">Rp {{ number_format($booking->pembayaran->jumlah ?? 0) }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($booking->rating)
                            <div class="bg-yellow-50 dark:bg-yellow-900 rounded-lg p-4 mt-6">
                                <h4 class="font-medium text-lg mb-3 text-yellow-900 dark:text-yellow-100">Rating Information</h4>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm font-medium text-yellow-700 dark:text-yellow-300">Rating:</span>
                                        <span class="text-sm text-yellow-900 dark:text-yellow-100 ml-2">
                                            {{ $booking->rating->rating ?? 'N/A' }}/5 ⭐
                                        </span>
                                    </div>
                                    @if($booking->rating->komentar)
                                    <div>
                                        <span class="text-sm font-medium text-yellow-700 dark:text-yellow-300">Comment:</span>
                                        <span class="text-sm text-yellow-900 dark:text-yellow-100 ml-2">{{ $booking->rating->komentar }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('bookings.edit', $booking) }}" 
                           class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                            Edit Booking
                        </a>
                        
                        @if($booking->status !== 'selesai' && $booking->status !== 'batal')
                        <form action="{{ route('bookings.update', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="selesai">
                            <input type="hidden" name="id_user" value="{{ $booking->id_user }}">
                            <input type="hidden" name="id_talenta" value="{{ $booking->id_talenta }}">
                            <input type="hidden" name="id_portfolio" value="{{ $booking->id_portfolio }}">
                            <input type="hidden" name="deskripsi_acara" value="{{ $booking->deskripsi_acara }}">
                            <input type="hidden" name="lokasi_acara" value="{{ $booking->lokasi_acara }}">
                            <input type="hidden" name="jumlah_harga" value="{{ $booking->jumlah_harga }}">
                            
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to mark this booking as completed?')"
                                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                Mark as Completed
                            </button>
                        </form>

                        <form action="{{ route('bookings.update', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="batal">
                            <input type="hidden" name="id_user" value="{{ $booking->id_user }}">
                            <input type="hidden" name="id_talenta" value="{{ $booking->id_talenta }}">
                            <input type="hidden" name="id_portfolio" value="{{ $booking->id_portfolio }}">
                            <input type="hidden" name="deskripsi_acara" value="{{ $booking->deskripsi_acara }}">
                            <input type="hidden" name="lokasi_acara" value="{{ $booking->lokasi_acara }}">
                            <input type="hidden" name="jumlah_harga" value="{{ $booking->jumlah_harga }}">
                            
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to cancel this booking?')"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                Cancel Booking
                            </button>
                        </form>
                        @endif

                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this booking? This action cannot be undone.')"
                                    class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                Delete Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>