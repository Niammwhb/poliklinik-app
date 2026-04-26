<x-layouts.app title="Detail Pemeriksaan">

@php
    $periksa = $data->periksas->first();
@endphp

<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Detail Pemeriksaan
        </h1>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow space-y-4">

        <div>
            <label class="text-sm text-gray-500">Poli</label>
            <p class="font-semibold">
                {{ $data->jadwalPeriksa->dokter->poli->nama_poli }}
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">Dokter</label>
            <p class="font-semibold">
                Dr. {{ $data->jadwalPeriksa->dokter->nama }}
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">Catatan Dokter</label>
            <p class="bg-gray-100 p-4 rounded-xl">
                {{ $periksa->catatan ?? '-' }}
            </p>
        </div>

        <div>
            <label class="text-sm text-gray-500">Daftar Obat</label>

            <ul class="space-y-2 mt-2">
                @forelse($periksa->detailPeriksas as $detail)
                    <li class="bg-indigo-50 p-3 rounded-xl">
                        {{ $detail->obat->nama_obat }}
                    </li>
                @empty
                    <li class="bg-gray-100 p-3 rounded-xl text-gray-500">
                        Tidak ada obat
                    </li>
                @endforelse
            </ul>
        </div>

        <div>
            <label class="text-sm text-gray-500">Total Biaya</label>
            <p class="text-2xl font-bold text-green-600">
                Rp {{ number_format($periksa->biaya_periksa ?? 0, 0, ',', '.') }}
            </p>
        </div>

    </div>

</div>

</x-layouts.app>