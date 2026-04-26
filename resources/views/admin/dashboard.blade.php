{{-- resources/views/admin/dashboard.blade.php --}}

<x-layouts.app title="Admin Dashboard">

@php
    $today = \Carbon\Carbon::now()->translatedFormat('l, d F Y');
@endphp

<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-slate-100 to-slate-200 rounded-2xl p-6 shadow-sm border border-slate-200">
        <h1 class="text-3xl font-bold text-slate-800">
            Selamat Datang, Admin
        </h1>

        <p class="text-sm text-slate-500 mt-2">
            {{ $today }} — Berikut ringkasan data sistem poliklinik.
        </p>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        {{-- Total Poli --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <div class="flex justify-between">
                <span class="text-sm text-slate-500">Total Poli</span>
                <span class="text-blue-600 text-sm font-medium">Data</span>
            </div>

            <h2 class="text-3xl font-bold text-slate-800 mt-4">
                {{ $totalPoli }}
            </h2>

            <div class="h-1 bg-blue-500 rounded-full mt-4"></div>
        </div>

        {{-- Total Dokter --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <div class="flex justify-between">
                <span class="text-sm text-slate-500">Total Dokter</span>
                <span class="text-emerald-600 text-sm font-medium">Data</span>
            </div>

            <h2 class="text-3xl font-bold text-slate-800 mt-4">
                {{ $totalDokter }}
            </h2>

            <div class="h-1 bg-emerald-500 rounded-full mt-4"></div>
        </div>

        {{-- Total Pasien --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <div class="flex justify-between">
                <span class="text-sm text-slate-500">Total Pasien</span>
                <span class="text-amber-600 text-sm font-medium">Data</span>
            </div>

            <h2 class="text-3xl font-bold text-slate-800 mt-4">
                {{ $totalPasien }}
            </h2>

            <div class="h-1 bg-amber-500 rounded-full mt-4"></div>
        </div>

        {{-- Total Obat --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
            <div class="flex justify-between">
                <span class="text-sm text-slate-500">Total Obat</span>
                <span class="text-pink-600 text-sm font-medium">Data</span>
            </div>

            <h2 class="text-3xl font-bold text-slate-800 mt-4">
                {{ $totalObat }}
            </h2>

            <div class="h-1 bg-pink-500 rounded-full mt-4"></div>
        </div>

    </div>

    {{-- Bawah --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Daftar Poli --}}
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100">

            <div class="px-6 py-4 border-b">
                <h3 class="font-semibold text-slate-800 text-lg">
                    Daftar Poli
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 text-left">Nama Poli</th>
                            <th class="px-6 py-4 text-left">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($polis as $poli)
                            <tr>
                                <td class="px-6 py-4 font-medium text-slate-700">
                                    {{ $poli->nama_poli }}
                                </td>

                                <td class="px-6 py-4 text-slate-500">
                                    {{ $poli->keterangan }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center py-6 text-slate-400">
                                    Belum ada data poli.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        {{-- Akses Cepat --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">

            <h3 class="font-semibold text-slate-800 text-lg mb-4">
                Akses Cepat
            </h3>

            <div class="space-y-3">

                <div class="p-4 rounded-xl bg-blue-50">
                    <div class="font-semibold text-blue-700">Tambah Poli</div>
                    <div class="text-sm text-blue-500">Menu manajemen poli</div>
                </div>

                <div class="p-4 rounded-xl bg-emerald-50">
                    <div class="font-semibold text-emerald-700">Tambah Dokter</div>
                    <div class="text-sm text-emerald-500">Menu manajemen dokter</div>
                </div>

                <div class="p-4 rounded-xl bg-amber-50">
                    <div class="font-semibold text-amber-700">Tambah Pasien</div>
                    <div class="text-sm text-amber-500">Menu manajemen pasien</div>
                </div>

                <div class="p-4 rounded-xl bg-pink-50">
                    <div class="font-semibold text-pink-700">Tambah Obat</div>
                    <div class="text-sm text-pink-500">Menu manajemen obat</div>
                </div>

            </div>

        </div>

    </div>

</div>

</x-layouts.app>