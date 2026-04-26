<x-layouts.app title="Dashboard Pasien">

<div class="space-y-6">

    {{-- ======================================
        BANNER ANTRIAN AKTIF
    ======================================= --}}
    @if($antrianAktif)

    <div class="relative overflow-hidden rounded-3xl shadow-xl
        bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-600
        text-white p-8">

        {{-- Ornament --}}
        <div class="absolute top-0 right-10 w-28 h-28 bg-white/10 rounded-full"></div>
        <div class="absolute -top-10 right-0 w-36 h-36 bg-white/5 rounded-full"></div>

        <div class="grid md:grid-cols-3 gap-8 items-center relative z-10">

            {{-- LEFT --}}
            <div class="md:col-span-2">

                <p class="uppercase text-xs tracking-widest text-white/80 font-semibold mb-5">
                    Antrian Aktif Anda
                </p>

                <div class="mb-5">
                    <p class="text-xs text-white/70">Poliklinik</p>

                    <h2 class="text-5xl font-bold leading-tight">
                        {{ $antrianAktif->jadwalPeriksa->dokter->poli->nama_poli ?? 'Poli Umum' }}
                    </h2>
                </div>

                <div class="mb-5">
                    <p class="text-xs text-white/70">Dokter</p>

                    <h3 class="text-3xl font-semibold">
                        Dr. {{ $antrianAktif->jadwalPeriksa->dokter->nama }}
                    </h3>
                </div>

                <div>
                    <p class="text-xs text-white/70">Jadwal Periksa</p>

                    <p class="text-xl font-medium">
                        {{ $antrianAktif->jadwalPeriksa->hari }}
                        (
                        {{ \Carbon\Carbon::parse($antrianAktif->jadwalPeriksa->jam_mulai)->format('H:i') }}
                        -
                        {{ \Carbon\Carbon::parse($antrianAktif->jadwalPeriksa->jam_selesai)->format('H:i') }}
                        )
                    </p>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="grid grid-cols-2 gap-4">

                {{-- Nomor Anda --}}
                <div class="bg-white/15 backdrop-blur-xl rounded-3xl p-5 text-center">

                    <p class="text-sm text-white/80 mb-3">
                        Nomor Anda
                    </p>

                    <h1 class="text-6xl font-bold">
                        {{ $antrianAktif->no_antrian }}
                    </h1>

                </div>

                {{-- Sedang Dilayani --}}
                <div class="bg-white rounded-3xl p-5 text-center text-indigo-600">

                    <p class="text-sm font-semibold mb-3">
                        Sedang Dilayani
                    </p>

                    <h1 id="nomor-sekarang" class="text-6xl font-bold">
                        {{ $antrianAktif->jadwalPeriksa->nomor_sekarang ?? 0 }}
                    </h1>

                    <p class="text-xs mt-3 text-emerald-500 font-medium">
                        ● Live Update
                    </p>

                </div>

            </div>

        </div>

    </div>

    @endif



    {{-- ======================================
        TABEL JADWAL POLIKLINIK PREMIUM
    ======================================= --}}
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

        {{-- Header --}}
        <div class="px-8 py-6 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800">
                        Jadwal Poliklinik
                    </h2>

                    <p class="text-sm text-slate-400 mt-1">
                        Informasi dokter dan nomor antrian terkini
                    </p>
                </div>

                <div class="flex items-center gap-2 text-emerald-500 text-sm font-medium">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    Live Update
                </div>

            </div>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 text-slate-500 uppercase text-xs tracking-wider">

                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Poliklinik</th>
                        <th class="px-6 py-4 text-left">Dokter</th>
                        <th class="px-6 py-4 text-left">Hari</th>
                        <th class="px-6 py-4 text-left">Jam Praktik</th>
                        <th class="px-6 py-4 text-center">Antrian</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($jadwals as $item)

                    <tr class="hover:bg-blue-50/40 transition duration-200">

                        {{-- NO --}}
                        <td class="px-6 py-5 text-slate-500 font-medium">
                            {{ $loop->iteration }}
                        </td>

                        {{-- POLI --}}
                        <td class="px-6 py-5">

    <div>
       <p class="font-semibold text-slate-800 text-base tracking-wide">
            {{ $item->dokter->poli->nama_poli ?? '-' }}
        </p>

        <p class="text-xs text-slate-400">
            Unit Pelayanan
        </p>
    </div>

</td>

                        </td>

                        {{-- DOKTER --}}
                        <td class="px-6 py-5">

                            <p class="font-semibold text-slate-800">
                                Dr. {{ $item->dokter->nama }}
                            </p>

                            <p class="text-xs text-slate-400">
                                Dokter Pemeriksa
                            </p>

                        </td>

                        {{-- HARI --}}
                        <td class="px-6 py-5 font-medium text-slate-700">
                            {{ $item->hari }}
                        </td>

                        {{-- JAM --}}
                        <td class="px-6 py-5">

                            <span class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-sm font-medium">

                                {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}

                            </span>

                        </td>

                        {{-- ANTRIAN --}}
                        <td class="px-6 py-5 text-center">

                            <span id="row-{{ $item->id }}"
                                class="inline-flex items-center justify-center
                                min-w-[52px] h-11 px-4 rounded-2xl
                                bg-gradient-to-r from-blue-600 to-indigo-600
                                text-white font-bold text-lg shadow-md">

                                {{ $item->nomor_sekarang ?? 0 }}

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center py-16">

                            <div class="flex flex-col items-center gap-3">

                                <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-2xl">
                                    <i class="fas fa-calendar-xmark"></i>
                                </div>

                                <h3 class="font-semibold text-slate-600">
                                    Belum Ada Jadwal Tersedia
                                </h3>

                                <p class="text-sm text-slate-400">
                                    Silakan tunggu jadwal dokter berikutnya
                                </p>

                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



{{-- ======================================
    REALTIME LARAVEL ECHO
====================================== --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    Echo.channel('antrian-channel')
        .listen('.antrian.updated', (e) => {

            let nomor = document.getElementById('nomor-sekarang');
            if (nomor) {
                nomor.innerText = e.antrian.nomor;
            }

            let row = document.getElementById('row-' + e.antrian.id);
            if (row) {
                row.innerText = e.antrian.nomor;
            }

        });

});
</script>

</x-layouts.app>