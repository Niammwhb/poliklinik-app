<x-layouts.app title="Verifikasi Pembayaran">

<div class="p-6 space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Verifikasi Pembayaran
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola pembayaran pasien yang menunggu konfirmasi admin.
            </p>
        </div>

        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-5 py-3 rounded-2xl shadow-lg">
            <p class="text-xs uppercase tracking-wider opacity-80">
                Total Pending
            </p>
            <p class="text-2xl font-bold">
                {{ $data->count() }}
            </p>
        </div>

    </div>


    {{-- Card Table --}}
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

        {{-- Top Bar --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
            <h2 class="font-semibold text-slate-700 text-lg">
                Daftar Pembayaran
            </h2>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-sm">
                    <tr>
                        <th class="px-6 py-4 text-left">Pasien</th>
                        <th class="px-6 py-4 text-left">Tagihan</th>
                        <th class="px-6 py-4 text-left">Jumlah</th>
                        <th class="px-6 py-4 text-center">Bukti</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($data as $item)

                    <tr class="hover:bg-slate-50 transition duration-200">

                        {{-- Pasien --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center">
                                    {{ strtoupper(substr($item->pasien->name ?? 'P',0,1)) }}
                                </div>

                                <div>
                                    <p class="font-semibold text-slate-800">
                                        {{ $item->pasien->name ?? '-' }}
                                    </p>
                                    <p class="text-xs text-slate-400">
                                        ID #{{ $item->id }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        {{-- Tagihan --}}
                        <td class="px-6 py-4 font-medium text-slate-700">
                            {{ $item->nama_tagihan }}
                        </td>

                        {{-- Jumlah --}}
                        <td class="px-6 py-4">
                            <span class="font-bold text-emerald-600">
                                Rp {{ number_format($item->jumlah,0,',','.') }}
                            </span>
                        </td>

                        {{-- Bukti --}}
                        <td class="px-6 py-4 text-center">

                            @if($item->bukti_bayar)
                                <a href="{{ asset('storage/'.$item->bukti_bayar) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-100 text-blue-700 hover:bg-blue-200 font-semibold text-sm transition">
                                    <i class="fas fa-image"></i>
                                    Lihat
                                </a>
                            @else
                                <span class="text-slate-400 text-sm">
                                    Belum Upload
                                </span>
                            @endif

                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 text-center">

                            <form action="{{ route('admin.pembayaran.verifikasi',$item->id) }}"
                                  method="POST">
                                @csrf

                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-md transition">
                                    <i class="fas fa-check-circle"></i>
                                    Konfirmasi
                                </button>
                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="py-16 text-center">

                            <div class="flex flex-col items-center justify-center text-slate-400">

                                <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                                    <i class="fas fa-wallet text-3xl"></i>
                                </div>

                                <p class="text-lg font-semibold text-slate-500">
                                    Tidak Ada Pembayaran Pending
                                </p>

                                <p class="text-sm mt-1">
                                    Semua pembayaran sudah diverifikasi.
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

</x-layouts.app>