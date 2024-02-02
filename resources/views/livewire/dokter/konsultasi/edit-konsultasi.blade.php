@section('title','Edit Konsultasi')
@section('after-script')
<script>
    setCurrent('dokter/konsultasi');
</script>
@endsection
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Konsultasi #{{ $konsultasi->id }}</h4>

        @include('components.cms.alert')
        <form class="forms-sample" wire:submit.prevent="save">
            <x-select title="Status Konsultasi" wireModel='konsultasi.status_konsultasi' :options="$statusKonsultasiOptions" placeholder="Status Konsultasi" addAttributes="required"/>
            <x-select title="Status Pembayaran" wireModel='konsultasi.status_pembayaran' :options="$statusPembayaranOptions" placeholder="Status Pembayaran" addAttributes="disabled"/>
            <div class="form-group mb-12">
                <label>Bukti Pembayaran</label>
                <div class="form-group">
                    @if (count($image) > 0)
                        <img src="{{ $image[0]->getUrl() }}"
                            style="border: 1px solid #333; max-width:300px; max-height:300px;" />
                    @else
                        <input class="form-control" value="Foto tidak tersedia" disabled>
                    @endif
                </div>
            </div>
            <x-text title="Nomor Pesanan" wireModel='konsultasi.no_pesanan' placeholder="Nomor Pesanan" addAttributes="disabled"/>
            <x-select title="Pasien" wireModel='konsultasi.pasien_id' :options="$pasienOptions" placeholder="Pasien" addAttributes="disabled"/>
            <x-select title="Dokter" wireModel='konsultasi.dokter_id' :options="$dokterOptions" placeholder="Dokter" addAttributes="disabled"/>
            <x-select title="Bank" wireModel='konsultasi.bank_id' :options="$bankOptions" placeholder="Bank" addAttributes="disabled"/>
            <x-text type="number" title="Nomor Telepon" wireModel='konsultasi.no_telepon' placeholder="Nomor Telepon" addAttributes="disabled"/>
            <x-text type="date" title="Tanggal Pesanan" wireModel='konsultasi.tanggal_pesanan' placeholder="Tanggal Pesanan" addAttributes="disabled"/>
            <x-text type="number" title="Tarif" wireModel='konsultasi.tarif' placeholder="Tarif" addAttributes="disabled"/>
            {{-- <x-text type="file" title="Ubah Bukti Pembayaran" wireModel='imageUpload' placeholder="Bukti Pembayaran" addAttributes="required"/> --}}

            <button type="submit" class="btn btn-primary mr-2" >Submit</button>
            <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
        </form>
        </div>
    </div>
</div>
