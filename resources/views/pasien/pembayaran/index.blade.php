<x-layouts.app title="Pembayaran">

<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Pembayaran
        </h1>

        <p class="text-slate-500 mt-1">
            Upload bukti pembayaran tagihan pemeriksaan.
        </p>
    </div>

    @forelse($data as $item)

    @php
        $tanggal = \Carbon\Carbon::parse($item->created_at)
                    ->translatedFormat('l, d F Y');
    @endphp

    {{-- Card Tagihan --}}
    <div class="bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500
                text-white rounded-3xl p-8 shadow-xl">

        <div class="grid md:grid-cols-2 gap-8">

            {{-- KIRI --}}
            <div>

                <p class="text-indigo-100 text-sm uppercase tracking-wide">
                    Informasi Pemeriksaan
                </p>

                <h2 class="text-2xl font-bold mt-2">
                    {{ $item->nama_tagih }}
                </h2>

                <div class="mt-6 space-y-3 text-sm text-indigo-100">

                    {{-- Nama Dokter Asli --}}
                    <div class="flex items-center gap-3">
                        <i class="fas fa-user-md w-5"></i>
                        <span>
                            Dokter :
                            {{ $item->pasien
                                ->daftarPoli
                                ->jadwalPeriksa
                                ->dokter
                                ->name ?? '-' }}
                        </span>
                    </div>

                    {{-- Hari + Tanggal Digabung --}}
                    <div class="flex items-center gap-3">
                        <i class="fas fa-calendar-alt w-5"></i>
                        <span>
                            Jadwal :
                            {{ $tanggal }}
                        </span>
                    </div>

                    {{-- Poli Sesuai Yang Dipilih --}}
                    <div class="flex items-center gap-3">
                        <i class="fas fa-hospital w-5"></i>
                        <span>
                            Poli :
                            {{ $item->pasien
                                ->daftarPoli
                                ->jadwalPeriksa
                                ->dokter
                                ->poli
                                ->nama_poli ?? '-' }}
                        </span>
                    </div>

                </div>

            </div>

            {{-- KANAN --}}
            <div class="flex flex-col justify-between text-right">

                <div>

                    @if($item->status == 'belum_bayar')
                        <span class="bg-red-500 px-4 py-2 rounded-full text-sm font-semibold">
                            Belum Bayar
                        </span>

                    @elseif($item->status == 'menunggu_verifikasi')
                        <span class="bg-yellow-400 text-black px-4 py-2 rounded-full text-sm font-semibold">
                            Menunggu Verifikasi
                        </span>

                    @elseif($item->status == 'lunas')
                        <span class="bg-green-500 px-4 py-2 rounded-full text-sm font-semibold">
                            Lunas
                        </span>

                    @endif

                </div>

                <div class="mt-8">

                    <p class="text-indigo-100 text-sm">
                        Total Tagihan
                    </p>

                    <h1 class="text-5xl font-bold mt-2">
                        Rp {{ number_format($item->jumlah,0,',','.') }}
                    </h1>

                </div>

            </div>

        </div>

    </div>

    {{-- Upload Bukti --}}
    @if($item->status == 'belum_bayar')

    <div class="bg-white rounded-3xl shadow-xl border p-8">

        <h2 class="text-xl font-bold text-slate-800 mb-5">
            Upload Bukti Pembayaran
        </h2>

        <form method="POST"
              action="{{ route('pasien.pembayaran.upload',$item->id) }}"
              enctype="multipart/form-data"
              class="space-y-5">

            @csrf

            <label class="block border-2 border-dashed border-slate-300 rounded-2xl p-10 text-center cursor-pointer hover:border-indigo-500 transition">

                <input type="file"
                       name="bukti_bayar"
                       class="hidden"
                       onchange="document.getElementById('filename{{ $item->id }}').innerText=this.files[0].name">

                <div class="space-y-3">

                    <i class="fas fa-cloud-upload-alt text-5xl text-indigo-500"></i>

                    <p class="font-semibold text-slate-700 text-lg">
                        Klik untuk pilih file dari komputer
                    </p>

                    <p class="text-sm text-slate-400">
                        JPG / PNG maksimal 2MB
                    </p>

                    <p id="filename{{ $item->id }}"
                       class="text-indigo-600 font-semibold"></p>

                </div>

            </label>

            <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white h-12 rounded-xl font-semibold transition">
                Upload Sekarang
            </button>

        </form>

    </div>

    @endif

    @empty

    <div class="bg-white rounded-3xl shadow p-14 text-center">

        <div class="w-24 h-24 bg-slate-100 mx-auto rounded-full flex items-center justify-center mb-6">
            <i class="fas fa-wallet text-4xl text-slate-400"></i>
        </div>

        <h2 class="text-2xl font-bold text-slate-700">
            Belum Ada Tagihan
        </h2>

        <p class="text-slate-400 mt-2">
            Tagihan akan muncul setelah pemeriksaan selesai.
        </p>

    </div>

    @endforelse

</div>

</x-layouts.app>