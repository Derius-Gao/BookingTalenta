<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Portfolio') }}
            </h2>
            <a href="{{ route('portfolios.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Back to Portfolios') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('portfolios.update', $portfolio) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="id_talenta" :value="__('Talent')" />
                            <select id="id_talenta" name="id_talenta" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select a talent</option>
                                @foreach($talents as $talent)
                                    <option value="{{ $talent->id_talenta }}" {{ old('id_talenta', $portfolio->id_talenta) == $talent->id_talenta ? 'selected' : '' }}>
                                        {{ $talent->user->name }} ({{ $talent->spesialisasi }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_talenta')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="id_kategori" :value="__('Category')" />
                            <select id="id_kategori" name="id_kategori" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select a category</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori', $portfolio->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_kategori')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="judul" :value="__('Judul')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $portfolio->judul)" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('deskripsi', $portfolio->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="foto" :value="__('Foto')" />
                            
                            @if($portfolio->foto)
                                <div class="mt-2 mb-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Current portfolio image:</p>
                                    <img src="{{ Storage::url($portfolio->foto) }}" 
                                         alt="Current Portfolio" 
                                         class="h-32 w-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                </div>
                            @endif
                            
                            <input id="foto" type="file" name="foto" class="block mt-1 w-full border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" accept="image/*" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload a new portfolio image (JPEG, PNG, JPG, GIF, max 2MB). Leave empty to keep current image.</p>
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="harga_minimal" :value="__('Harga Minimal')" />
                                <x-text-input id="harga_minimal" class="block mt-1 w-full" type="number" name="harga_minimal" :value="old('harga_minimal', $portfolio->harga_minimal)" min="0" step="1000" required />
                                <x-input-error :messages="$errors->get('harga_minimal')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="harga_maximal" :value="__('Harga Maximal')" />
                                <x-text-input id="harga_maximal" class="block mt-1 w-full" type="number" name="harga_maximal" :value="old('harga_maximal', $portfolio->harga_maximal)" min="0" step="1000" required />
                                <x-input-error :messages="$errors->get('harga_maximal')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update Portfolio') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 