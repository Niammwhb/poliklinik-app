<x-layouts.app title="Periksa Pasien">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-6">

        {{-- Title --}}
        <div>
            <h2 class="text-3xl font-bold text-slate-800">
                Periksa Pasien
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Daftar pasien yang sedang menunggu pemeriksaan dokter.
            </p>
        </div>

    </div>


    {{-- Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full">

                {{-- Head --}}
                <thead class="bg-slate-50 text-slate-500 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4 text-left">Nama Pasien</th>
                        <th class="px-6 py-4 text-left">Keluhan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="text-sm text-slate-700">

                    @forelse($pasiens as $item)

                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                        {{-- No --}}
                        <td class="px-6 py-4 text-center font-medium text-slate-500">
                            {{ $loop->iteration }}
                        </td>

                        {{-- Nama --}}
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            {{ $item->nama_pasien }}
                        </td>

                        {{-- Keluhan --}}
                        <td class="px-6 py-4 text-slate-600">
                            {{ $item->keluhan }}
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                Menunggu
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('dokter.periksa.create', $item->id) }}"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/90
                                text-white rounded-lg text-xs font-semibold transition shadow-sm">

                                <i class="fas fa-stethoscope text-xs"></i>
                                Periksa
                            </a>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center py-16 text-slate-400">
                            <div class="flex flex-col items-center gap-3">
                                <i class="fas fa-inbox text-4xl"></i>
                                <span>Belum ada pasien yang menunggu</span>
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</x-layouts.app>