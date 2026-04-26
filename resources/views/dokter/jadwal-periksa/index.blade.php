<x-layouts.app title="Jadwal Periksa">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-6">

        {{-- Title --}}
        <div>
            <h2 class="text-3xl font-bold text-slate-800">
                Jadwal Periksa
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Kelola jadwal praktik dan panggilan antrian pasien.
            </p>
        </div>

        {{-- Action Button --}}
        <div class="flex flex-wrap items-center gap-3">

            {{-- Export Excel --}}
            <a href="{{ url('/export/jadwal') }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-white border border-slate-200
                hover:border-green-500 hover:bg-green-50 text-green-600 rounded-xl
                text-sm font-semibold shadow-sm transition">

                <i class="fas fa-file-excel text-sm"></i>
                Export Excel
            </a>

            {{-- Tambah Jadwal --}}
            <a href="{{ route('jadwal-periksa.create') }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-primary hover:bg-primary/90
                text-white rounded-xl text-sm font-semibold shadow-md transition">

                <i class="fas fa-plus text-sm"></i>
                Tambah Jadwal
            </a>

        </div>

    </div>

    {{-- Alert --}}
    @if (session('message'))
        <div class="mb-5 px-5 py-4 rounded-2xl bg-green-50 border border-green-200 text-green-700 shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fas fa-circle-check"></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    {{-- Card --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full">

                {{-- Table Head --}}
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-center">ID</th>
                        <th class="px-6 py-4 text-left">Hari</th>
                        <th class="px-6 py-4 text-left">Jam Mulai</th>
                        <th class="px-6 py-4 text-left">Jam Selesai</th>
                        <th class="px-6 py-4 text-center">No Sekarang</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="text-sm text-slate-700">

                    @forelse ($jadwalPeriksas as $jadwalPeriksa)
                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                        {{-- ID --}}
                        <td class="px-6 py-4 text-slate-500 text-center font-medium">
                            {{ $jadwalPeriksa->id }}
                        </td>

                        {{-- Hari --}}
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            {{ $jadwalPeriksa->hari }}
                        </td>

                        {{-- Jam Mulai --}}
                        <td class="px-6 py-4 text-slate-600">
                            {{ \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H:i') }}
                        </td>

                        {{-- Jam Selesai --}}
                        <td class="px-6 py-4 text-slate-600">
                            {{ \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H:i') }}
                        </td>

                        {{-- Nomor Sekarang --}}
                        <td class="px-6 py-4 text-center">
                            <span class="text-slate-800 font-bold text-lg">
                                {{ $jadwalPeriksa->nomor_sekarang ?? 0 }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2 flex-wrap">

                                {{-- Panggil --}}
                                <a href="{{ route('jadwal-periksa.next', $jadwalPeriksa->id) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 
                                    bg-primary hover:bg-primary/90
                                    text-white text-xs font-semibold rounded-lg transition">

                                    <i class="fas fa-bullhorn text-xs"></i>
                                    Panggil
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('jadwal-periksa.edit', $jadwalPeriksa->id) }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 
                                    bg-amber-500 hover:bg-amber-600
                                    text-white text-xs font-semibold rounded-lg transition">

                                    <i class="fas fa-pen-to-square text-xs"></i>
                                    Edit
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('jadwal-periksa.destroy', $jadwalPeriksa->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                        class="inline-flex items-center gap-2 px-4 py-2 
                                        bg-red-500 hover:bg-red-600
                                        text-white text-xs font-semibold rounded-lg transition">

                                        <i class="fas fa-trash text-xs"></i>
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-16 text-slate-400">
                            <div class="flex flex-col items-center gap-3">
                                <i class="fas fa-calendar-xmark text-4xl"></i>
                                <span class="text-sm">Belum ada jadwal periksa</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

    <script>
        setTimeout(() => {
            const alertBox = document.querySelector('.bg-green-50');
            if (alertBox) {
                alertBox.remove();
            }
        }, 2500);
    </script>

</x-layouts.app>