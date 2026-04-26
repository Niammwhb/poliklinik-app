{{-- resources/views/dokter/dashboard.blade.php --}}
<x-layouts.app title="Dashboard Dokter">

<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-slate-100 to-slate-200 rounded-2xl p-6 shadow-sm border border-slate-200">
        <h1 class="text-3xl font-bold text-slate-800">
            Selamat Datang, Dokter
        </h1>

        <p class="text-sm text-slate-500 mt-2">
            {{ now()->translatedFormat('l, d F Y') }} —
            Berikut ringkasan aktivitas praktik Anda hari ini.
        </p>
    </div>


    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

        {{-- Total Jadwal --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 relative overflow-hidden">
            <div class="flex justify-between items-start">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                <a href="{{ url('/dokter/jadwal-periksa') }}"
                   class="text-sm font-semibold text-blue-600 hover:underline">
                    Lihat
                </a>

            </div>

            <h2 class="text-4xl font-bold text-slate-800 mt-6">
                {{ $totalJadwal ?? 0 }}
            </h2>

            <p class="text-slate-500 mt-2">Total Jadwal</p>

            <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500"></div>
        </div>



        {{-- Pasien Menunggu --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 relative overflow-hidden">
            <div class="flex justify-between items-start">

                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5V10H2v10h5m10 0v-4a3 3 0 00-3-3H10a3 3 0 00-3 3v4m10 0H7"/>
                    </svg>
                </div>

                <a href="{{ url('/dokter/periksa') }}"
                   class="text-sm font-semibold text-amber-600 hover:underline">
                    Lihat
                </a>

            </div>

            <h2 class="text-4xl font-bold text-slate-800 mt-6">
                {{ $pasienMenunggu ?? 0 }}
            </h2>

            <p class="text-slate-500 mt-2">Pasien Menunggu</p>

            <div class="absolute bottom-0 left-0 w-full h-1 bg-amber-500"></div>
        </div>



        {{-- Total Riwayat --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 relative overflow-hidden">
            <div class="flex justify-between items-start">

                <div class="w-12 h-12 rounded-xl bg-pink-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                    </svg>
                </div>

                <a href="{{ url('/dokter/riwayat') }}"
                   class="text-sm font-semibold text-pink-600 hover:underline">
                    Lihat
                </a>

            </div>

            <h2 class="text-4xl font-bold text-slate-800 mt-6">
                {{ $totalRiwayat ?? 0 }}
            </h2>

            <p class="text-slate-500 mt-2">Total Riwayat</p>

            <div class="absolute bottom-0 left-0 w-full h-1 bg-pink-500"></div>
        </div>

    </div>



    {{-- Konten --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- Jadwal Periksa --}}
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">

            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-bold text-slate-800">
                    Jadwal Periksa
                </h2>

                <a href="{{ url('/dokter/jadwal-periksa') }}"
                   class="text-sm font-semibold text-indigo-600 hover:underline">
                    Lihat Semua →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead>
                        <tr class="text-left text-slate-400 border-b">
                            <th class="pb-3">Hari</th>
                            <th class="pb-3">Jam Mulai</th>
                            <th class="pb-3">Jam Selesai</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($jadwalList ?? [] as $jadwal)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 font-medium text-slate-700">
                                {{ $jadwal->hari }}
                            </td>
                            <td class="py-4 text-slate-600">
                                {{ $jadwal->jam_mulai }}
                            </td>
                            <td class="py-4 text-slate-600">
                                {{ $jadwal->jam_selesai }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center text-slate-400">
                                Belum ada jadwal periksa
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>



        {{-- Akses Cepat --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">

            <h2 class="text-lg font-bold text-slate-800 mb-5">
                Akses Cepat
            </h2>

            <div class="space-y-4">

                <a href="{{ url('/dokter/jadwal-periksa/create') }}"
                   class="block p-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition">
                    <div class="font-semibold text-slate-800">
                        Tambah Jadwal
                    </div>
                    <div class="text-sm text-slate-500">
                        Tambahkan jadwal baru
                    </div>
                </a>

                <a href="{{ url('/dokter/periksa') }}"
                   class="block p-4 rounded-xl bg-amber-50 hover:bg-amber-100 transition">
                    <div class="font-semibold text-slate-800">
                        Periksa Pasien
                    </div>
                    <div class="text-sm text-slate-500">
                        Lihat daftar pasien menunggu
                    </div>
                </a>

                <a href="{{ url('/dokter/riwayat') }}"
                   class="block p-4 rounded-xl bg-pink-50 hover:bg-pink-100 transition">
                    <div class="font-semibold text-slate-800">
                        Riwayat Pasien
                    </div>
                    <div class="text-sm text-slate-500">
                        Lihat riwayat pemeriksaan
                    </div>
                </a>

            </div>

        </div>

    </div>

</div>

</x-layouts.app>