<x-layouts.app title="Form Periksa Pasien">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">

        <a href="{{ route('dokter.periksa.index') }}"
            class="flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>

        <h2 class="text-2xl font-bold text-slate-800">
            Form Pemeriksaan Pasien
        </h2>

    </div>


    {{-- Alert Error --}}
    @if(session('error'))
        <div class="mb-4 p-4 rounded-xl bg-red-100 text-red-700">
            {{ session('error') }}
        </div>
    @endif


    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-8">

            <form action="{{ route('dokter.periksa.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id_daftar_poli" value="{{ $pasien->id }}">

                {{-- Nama Pasien --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">
                        Nama Pasien
                    </label>

                    <input type="text"
                        value="{{ $pasien->pasien->nama }}"
                        class="w-full px-4 py-2 border rounded-lg bg-slate-100"
                        readonly>
                </div>


                {{-- Keluhan --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">
                        Keluhan
                    </label>

                    <textarea
                        rows="3"
                        class="w-full px-4 py-2 border rounded-lg bg-slate-100 resize-none"
                        readonly>{{ $pasien->keluhan }}</textarea>
                </div>


                {{-- Catatan --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">
                        Catatan Pemeriksaan
                    </label>

                    <textarea name="catatan"
                        rows="4"
                        class="w-full px-4 py-2 border rounded-lg"
                        placeholder="Tulis hasil pemeriksaan..."
                        required></textarea>
                </div>


                {{-- Biaya Pemeriksaan --}}
                <div class="mb-5">
                    <label class="block font-medium mb-2">
                        Biaya Pemeriksaan
                    </label>

                    <input type="number"
                        name="biaya_periksa"
                        min="0"
                        required
                        placeholder="Masukkan biaya pemeriksaan"
                        class="w-full border rounded-lg px-4 py-3">
                </div>


                {{-- Pilih Obat --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2">
                        Pilih Obat
                    </label>

                    <select name="id_obat"
                        class="w-full px-4 py-2 border rounded-lg"
                        required>

                        <option value="">-- Pilih Obat --</option>

                        @foreach($obats as $obat)

                            @if($obat->stok == 0)

                                <option disabled>
                                    {{ $obat->nama_obat }} (Stok Habis)
                                </option>

                            @else

                                <option value="{{ $obat->id }}">
                                    {{ $obat->nama_obat }} - Stok {{ $obat->stok }}
                                </option>

                            @endif

                        @endforeach

                    </select>
                </div>


                {{-- Tombol --}}
                <div class="flex gap-3">

                    <button type="submit"
                        class="px-6 py-2.5 bg-primary text-white rounded-xl font-semibold">
                        Simpan Pemeriksaan
                    </button>

                    <a href="{{ route('dokter.periksa.index') }}"
                        class="px-6 py-2.5 bg-slate-100 text-slate-700 rounded-xl font-semibold">
                        Batal
                    </a>

                </div>

            </form>

        </div>
    </div>

</x-layouts.app>