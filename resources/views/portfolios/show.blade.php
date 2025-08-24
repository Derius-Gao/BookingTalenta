<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Portfolio Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('portfolios.edit', $portfolio) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Edit Portfolio') }}
                </a>
                <a href="{{ route('portfolios.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Back to Portfolios') }}
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
                            <h3 class="text-lg font-semibold mb-4">Portfolio Information</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ID Portfolio</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $portfolio->id_portfolio }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Talent</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $portfolio->talent->user->name }}</p>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $portfolio->talent->spesialisasi }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $portfolio->kategori->nama_kategori }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $portfolio->judul }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $portfolio->deskripsi }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Range</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">Rp {{ number_format($portfolio->harga_minimal) }} - Rp {{ number_format($portfolio->harga_maximal) }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $portfolio->created_at->format('M d, Y H:i') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Updated At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $portfolio->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Portfolio Image</h3>
                            
                            @if($portfolio->foto)
                                <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                                    <img src="{{ Storage::url($portfolio->foto) }}" 
                                         alt="Portfolio" 
                                         class="w-full h-auto max-h-96 object-contain rounded-lg">
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        Portfolio image for {{ $portfolio->judul }}
                                    </p>
                                </div>
                            @else
                                <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center">
                                    <p class="text-gray-500 dark:text-gray-400">No portfolio image available</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 