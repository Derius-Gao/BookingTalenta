<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Talent Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('talents.edit', $talent) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit Talent') }}
                </a>
                <a href="{{ route('talents.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Talents') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Talent Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $talent->id }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">User Name</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $talent->user->name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">User Email</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $talent->user->email }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No HP</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $talent->no_hp }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Spesialisasi</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $talent->spesialisasi }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $talent->created_at->format('M d, Y H:i') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Updated At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $talent->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Portfolios</h3>
                            
                            @if($talent->portfolios->count() > 0)
                                <div class="space-y-4">
                                    @foreach($talent->portfolios as $portfolio)
                                        <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                                            <h4 class="font-medium text-lg">{{ $portfolio->judul }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $portfolio->kategori->nama_kategori }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($portfolio->harga_minimal) }} - Rp {{ number_format($portfolio->harga_maximal) }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center">
                                    <p class="text-gray-500 dark:text-gray-400">No portfolios available</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 