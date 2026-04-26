<x-layouts.app title="Riwayat Pendaftaran">

<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Riwayat Pendaftaran Poli
        </h1>
        <p class="text-gray-500">
            Histori seluruh pendaftaran poli Anda
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">Poli</th>
                    <th class="p-4 text-left">Dokter</th>
                    <th class="p-4 text-left">Tanggal</th>
                    <th class="p-4 text-left">Antrian</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($riwayat as $item)

                @php
                    $periksa = $item->periksas->first();
                @endphp

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4">{{ $loop->iteration }}</td>

                    <td class="p-4">
                        {{ $item->jadwalPeriksa->dokter->poli->nama_poli }}
                    </td>

                    <td class="p-4">
                        Dr. {{ $item->jadwalPeriksa->dokter->nama }}
                    </td>

                    <td class="p-4">
                        {{ $item->jadwalPeriksa->hari }}
                    </td>

                    <td class="p-4 font-bold text-indigo-600">
                        {{ $item->no_antrian }}
                    </td>

                    <td class="p-4">
                        @if($item->periksas->count() > 0)
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                Sudah Diperiksa
                            </span>
                        @else
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">
                                Menunggu
                            </span>
                        @endif
                    </td>

                    <td class="p-4 text-center">
                        @if($item->periksas->count() > 0)
                            <a href="{{ route('pasien.riwayat.detail', $item->id) }}"
                               class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                                Detail
                            </a>

                            
                        @else
                            -
                        @endif
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center p-6 text-gray-500">
                        Belum ada riwayat pendaftaran.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

</x-layouts.app>