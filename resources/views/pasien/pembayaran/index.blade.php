<x-layouts.app title="Pembayaran">

<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Pembayaran</h1>

    <div class="bg-white rounded-xl shadow p-4">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Tagihan</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Upload Bukti</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->nama_tagihan }}</td>
                    <td>Rp {{ number_format($item->jumlah) }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        @if($item->status == 'belum_bayar')
                        <form action="{{ route('pasien.pembayaran.upload',$item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="bukti_bayar" required class="file-input file-input-bordered file-input-sm">
                            <button class="btn btn-primary btn-sm mt-2">
                                Upload
                            </button>
                        </form>
                        @else
                            Sudah Upload
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</x-layouts.app>