<x-layouts.app title="Edit Pemeriksaan">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">

        <a href="{{ route('dokter.periksa.index') }}"
            class="flex items-center justify-center w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition">
            <i class="fas fa-arrow-left text-sm"></i>
        </a>

        <h2 class="text-2xl font-bold text-slate-800">
            Edit Pemeriksaan Pasien
        </h2>

    </div>

    {{-- Card --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-8">

            <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Pasien --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">
                        Nama Pasien
                    </label>

                    <input type="text"
                        value="{{ $periksa->daftarPoli->nama_pasien }}"
                        class="w-full px-4 py-2 border rounded-lg bg-slate-100"
                        readonly>
                </div>

                {{-- Catatan --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold mb-2">
                        Catatan Pemeriksaan
                    </label>

                    <textarea name="catatan"
                        rows="4"
                        class="w-full px-4 py-2 border rounded-lg">{{ $periksa->catatan }}</textarea>
                </div>

                {{-- Obat --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2">
                        Pilih Obat
                    </label>

                    <select name="id_obat"
                        class="w-full px-4 py-2 border rounded-lg">

                        @foreach($obats as $obat)

                            <option value="{{ $obat->id }}"
                                {{ $detail->id_obat == $obat->id ? 'selected' : '' }}>

                                {{ $obat->nama_obat }} (Stok {{ $obat->stok }})

                            </option>

                        @endforeach

                    </select>
                </div>

                {{-- Tombol --}}
                <div class="flex gap-3">

                    <button type="submit"
                        class="px-6 py-2.5 bg-primary text-white rounded-xl font-semibold">
                        Update Pemeriksaan
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