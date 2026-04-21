<x-layouts.app title="Dashboard Pasien">

<div class="space-y-6">

    {{-- =========================
        BANNER ANTRIAN AKTIF
    ========================== --}}
    @if($antrianAktif)

    <div class="relative overflow-hidden rounded-2xl shadow-xl
        bg-gradient-to-r from-blue-500 via-indigo-500 to-blue-600
        text-white p-6">

        {{-- Ornament --}}
        <div class="absolute top-0 right-10 w-24 h-24 bg-white/10 rounded-full"></div>
        <div class="absolute -top-8 right-0 w-32 h-32 bg-white/5 rounded-full"></div>

        <div class="grid md:grid-cols-3 gap-6 items-center relative z-10">

            {{-- LEFT --}}
            <div class="md:col-span-2">

                <p class="uppercase text-xs font-semibold tracking-wider text-white/80 mb-4">
                    Antrian Aktif Anda
                </p>

                <div class="mb-4">
                    <p class="text-xs text-white/70">Poliklinik</p>
                    <h2 class="text-4xl font-bold">
                        {{ $antrianAktif->jadwalPeriksa->dokter->poli->nama_poli ?? 'Poli Umum' }}
                    </h2>
                </div>

                <div class="mb-4">
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
                <div class="bg-white/15 backdrop-blur-md rounded-2xl p-5 text-center">

                    <p class="text-xs text-white/80 mb-2">
                        Nomor Anda
                    </p>

                    <h1 class="text-6xl font-bold">
                        {{ $antrianAktif->no_antrian }}
                    </h1>

                </div>

                {{-- Sedang Dilayani --}}
                <div class="bg-white rounded-2xl p-5 text-center text-indigo-600">

                    <p class="text-xs font-semibold mb-2">
                        Sedang Dilayani
                    </p>

                    <h1 class="text-6xl font-bold">
                        {{ $antrianAktif->jadwalPeriksa->antrian_saat_ini ?? 0 }}
                    </h1>

                    <p class="text-[11px] mt-2 text-indigo-400">
                        ● Live Update
                    </p>

                </div>

            </div>

        </div>
    </div>

    @else

    {{-- Jika tidak punya antrian --}}
    <div class="rounded-2xl bg-base-100 shadow-lg p-10 text-center">

        <i class="fas fa-calendar-xmark text-5xl text-slate-300 mb-4"></i>

        <h2 class="text-2xl font-bold text-slate-700 mb-2">
            Belum Ada Antrian Aktif
        </h2>

        <p class="text-slate-500 mb-5">
            Silakan daftar poli terlebih dahulu.
        </p>

        <a href="{{ url('/pasien/daftar') }}"
            class="btn bg-blue-600 hover:bg-blue-700 text-white border-none rounded-xl px-6">

            Daftar Sekarang

        </a>

    </div>

    @endif

</div>

{{-- AUTO REFRESH --}}
<script>
setInterval(() => {
    location.reload();
}, 5000);
</script>

</x-layouts.app>