<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create New Booking') }}
            </h2>
            <a href="{{ route('bookings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Back to Bookings') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="id_user" :value="__('User')" />
                            <select id="id_user" name="id_user" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select a user</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_user')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="id_talenta" :value="__('Talent')" />
                            <select id="id_talenta" name="id_talenta" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select a talent</option>
                                @foreach($talents as $talent)
                                    <option value="{{ $talent->id_talenta }}" {{ old('id_talenta') == $talent->id_talenta ? 'selected' : '' }}>
                                        {{ $talent->user->name }} - {{ $talent->spesialisasi }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_talenta')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="id_portfolio" :value="__('Portfolio')" />
                            <select id="id_portfolio" name="id_portfolio" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select a portfolio</option>
                                @foreach($portfolios as $portfolio)
                                    <option value="{{ $portfolio->id_portfolio }}" 
                                            data-talent="{{ $portfolio->id_talenta }}"
                                            data-min-price="{{ $portfolio->harga_minimal }}"
                                            data-max-price="{{ $portfolio->harga_maximal }}"
                                            {{ old('id_portfolio') == $portfolio->id_portfolio ? 'selected' : '' }}>
                                        {{ $portfolio->judul }} - {{ $portfolio->talent->user->name }} (Rp {{ number_format($portfolio->harga_minimal) }} - Rp {{ number_format($portfolio->harga_maximal) }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('id_portfolio')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="deskripsi_acara" :value="__('Deskripsi Acara')" />
                            <textarea id="deskripsi_acara" name="deskripsi_acara" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('deskripsi_acara') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi_acara')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="lokasi_acara" :value="__('Lokasi Acara')" />
                            <x-text-input id="lokasi_acara" class="block mt-1 w-full" type="text" name="lokasi_acara" :value="old('lokasi_acara')" required />
                            <x-input-error :messages="$errors->get('lokasi_acara')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="jumlah_harga" :value="__('Jumlah Harga')" />
                            <x-text-input id="jumlah_harga" class="block mt-1 w-full" type="number" name="jumlah_harga" :value="old('jumlah_harga')" min="0" step="1000" required />
                            <x-input-error :messages="$errors->get('jumlah_harga')" class="mt-2" />
                            <small class="text-gray-500 dark:text-gray-400">Price range will be shown when you select a portfolio</small>
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select status</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Booking') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const portfolioSelect = document.getElementById('id_portfolio');
            const talentSelect = document.getElementById('id_talenta');
            const priceInput = document.getElementById('jumlah_harga');
            
            // Filter portfolios based on selected talent
            talentSelect.addEventListener('change', function() {
                const selectedTalent = this.value;
                const portfolioOptions = portfolioSelect.querySelectorAll('option');
                
                portfolioOptions.forEach(option => {
                    if (option.value === '') return; // Keep the default option
                    
                    if (selectedTalent === '' || option.dataset.talent === selectedTalent) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                        if (option.selected) {
                            option.selected = false;
                        }
                    }
                });
                
                // Reset portfolio selection if no talent selected
                if (selectedTalent === '') {
                    portfolioSelect.value = '';
                }
            });
            
            // Show price range when portfolio is selected
            portfolioSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value !== '') {
                    const minPrice = selectedOption.dataset.minPrice;
                    const maxPrice = selectedOption.dataset.maxPrice;
                    const talent = selectedOption.dataset.talent;
                    
                    // Auto-select the corresponding talent
                    talentSelect.value = talent;
                    
                    // Set suggested price (you can modify this logic)
                    priceInput.min = minPrice;
                    priceInput.placeholder = `Range: Rp ${new Intl.NumberFormat('id-ID').format(minPrice)} - Rp ${new Intl.NumberFormat('id-ID').format(maxPrice)}`;
                }
            });
        });
    </script>
</x-app-layout>