<div class="flex gap-2">
    @if (Auth::guard('cms')->user()->can($permissions.'view'))
        <a href="{{ route('cms.konsultasi.show-riwayat',['konsultasi'=>$id]) }}"  class="flex p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded items-center">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
        </a>
    @endif
    @include('components.cms.cetak-konsultasi', ['value' => $id,'no_pesanan'=>$no_pesanan,
    'pasien'=>$pasien,
    'dokter'=>$dokter,
    'tanggal_pesanan'=>$tanggal_pesanan,
    'bank'=>$bank,
    'no_rekening'=>$no_rekening])
</div>
