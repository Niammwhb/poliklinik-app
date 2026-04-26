<x-layouts.app title="Riwayat Pasien">

<div class="p-6 space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Riwayat Pasien
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Data pasien yang sudah selesai diperiksa oleh dokter.
            </p>
        </div>

        {{-- Export --}}
        <a href="{{ url('/export/riwayat') }}"
            class="inline-flex items-center gap-2 px-5 py-3 bg-white border border-slate-200
            hover:border-green-500 hover:bg-green-50 text-green-600 rounded-xl
            text-sm font-semibold shadow-sm transition">

            <i class="fas fa-file-excel text-sm"></i>
            Export Excel
        </a>

    </div>

    {{-- Statistik (hanya total pendapatan) --}}
    <div class="grid md:grid-cols-1 gap-4">

        <div class="bg-white rounded-2xl p-5 shadow border border-slate-100">
            <p class="text-sm text-slate-500">Total Pendapatan</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2">
                Rp {{ number_format($pasiens->sum(fn($x) => optional($x->periksas->first())->biaya_periksa),0,',','.') }}
            </h3>
        </div>

    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                {{-- Head --}}
                <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-sm">
                    <tr>
                        <th class="px-5 py-4 text-center">No</th>
                        <th class="px-5 py-4 text-left">Pasien</th>
                        <th class="px-5 py-4 text-left">Keluhan</th>
                        <th class="px-5 py-4 text-left">Catatan Dokter</th>
                        <th class="px-5 py-4 text-center">Tanggal</th>
                        <th class="px-5 py-4 text-center">Biaya</th>
                        <th class="px-5 py-4 text-center">Status</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="text-sm text-slate-700">

                    @forelse($pasiens as $item)

                    @php
                        $periksa = $item->periksas->first();
                    @endphp

                    <tr class="border-b hover:bg-slate-50 transition">

                        {{-- No --}}
                        <td class="px-5 py-4 text-center text-slate-500 font-semibold">
                            {{ $loop->iteration }}
                        </td>

                        {{-- Pasien --}}
                        <td class="px-5 py-4">
                            <div class="font-semibold text-slate-800">
                                {{ $item->pasien->nama }}
                            </div>
                        </td>

                        {{-- Keluhan --}}
                        <td class="px-5 py-4 text-slate-600">
                            {{ $item->keluhan }}
                        </td>

                        {{-- Catatan --}}
                        <td class="px-5 py-4 text-slate-600 max-w-xs">
                            {{ $periksa->catatan ?? '-' }}
                        </td>

                        {{-- Tanggal --}}
                        <td class="px-5 py-4 text-center text-slate-600">
                            {{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d M Y') }}
                        </td>

                        {{-- Biaya --}}
                        <td class="px-5 py-4 text-center">
                            <span class="font-bold text-emerald-600">
                                Rp {{ number_format($periksa->biaya_periksa ?? 0,0,',','.') }}
                            </span>
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                Selesai
                            </span>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center py-16 text-slate-400">

                            <div class="flex flex-col items-center gap-3">
                                <i class="fas fa-folder-open text-4xl"></i>
                                <span>Belum ada riwayat pasien</span>
                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-layouts.app>