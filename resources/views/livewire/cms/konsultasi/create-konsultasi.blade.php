@section('title','Create Konsultasi')
@section('after-script')
<script>
    setCurrent('cms/konsultasi');
</script>
@endsection
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Konsultasi Baru</h4>

        @include('components.cms.alert')
        <form class="forms-sample" wire:submit.prevent="save">
            <x-text title="Nomor Pesanan" wireModel='konsultasi.no_pesanan' placeholder="Nomor Pesanan" addAttributes="required"/>
            <x-select title="Pasien" wireModel='konsultasi.pasien_id' :options="$pasienOptions" placeholder="Pasien" addAttributes="required"/>
            <x-select title="Dokter" wireModel='konsultasi.dokter_id' :options="$dokterOptions" placeholder="Dokter" addAttributes="required"/>
            <x-select title="Bank" wireModel='konsultasi.bank_id' :options="$bankOptions" placeholder="Bank" addAttributes="required"/>
            <x-text type="number" title="Nomor Telepon" wireModel='konsultasi.no_telepon' placeholder="Nomor Telepon" addAttributes="required"/>
            <x-text type="date" title="Tanggal Pesanan" wireModel='konsultasi.tanggal_pesanan' placeholder="Tanggal Pesanan" addAttributes="required"/>
            <x-text type="number" title="Tarif" wireModel='konsultasi.tarif' placeholder="Tarif" addAttributes="required"/>
            <x-select title="Status Pembayaran" wireModel='konsultasi.status_pembayaran' :options="$statusPembayaranOptions" placeholder="Status Pembayaran" addAttributes="required"/>
            <x-select title="Status Konsultasi" wireModel='konsultasi.status_konsultasi' :options="$statusKonsultasiOptions" placeholder="Status Konsultasi" addAttributes="required"/>
            <x-text type="file" title="Bukti Pembayaran" wireModel='imageUpload' placeholder="Bukti Pembayaran" addAttributes="required"/>

            <button type="submit" class="btn btn-primary mr-2" >Submit</button>
            <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
        </form>
        </div>
    </div>
</div>
