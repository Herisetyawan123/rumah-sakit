@section('title','Show Transaksi Obat')
@section('after-script')
<script>
    setCurrent('cms/transaksi-obat');
</script>
@endsection
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Show Transaksi Obat #{{ $transaksi_obat->id }}</h4>

        @include('components.cms.alert')
        <form class="forms-sample" wire:submit.prevent="save">
            <x-text title="Kode Transaksi" wireModel='transaksi_obat.kode_transaksi' placeholder="Kode Transaksi" addAttributes="disabled"/>
            <x-text type="date" title="Tanggal Pemesanan" wireModel='transaksi_obat.tanggal_pemesanan' placeholder="Tanggal Pemesanan" addAttributes="disabled"/>
            <x-cms.select-two title="Pasien" wireModel='transaksi_obat.pasien_id' :options="$pasienOptions" placeholder="Pasien" addAttributes="disabled"/>
            <x-select title="Status Pembayaran" wireModel='transaksi_obat.status_pembayaran' :options="$statusPembayaranOptions" placeholder="Status Pembayaran" addAttributes="disabled"/>
            <x-select title="Status Pengambilan" wireModel='transaksi_obat.status_pengambilan' :options="$statusPengambilanOptions" placeholder="Status Pembayaran" addAttributes="disabled"/>
            <div class="form-group mb-12">
                <label>Resep Obat</label>
                <div class="form-group">
                
                    <img src="{{ asset($transaksi_obat->image) }}"
                    style="border: 1px solid #333; max-width:300px; max-height:300px;" />
        
                </div>
            </div>

            @if($transaksi_obat->metode_pembayaran != 'cod')
                <div class="form-group mb-12">
                    <label>Bukti Pembayaran</label>
                    <div class="form-group">
                        @if (count($images) > 0)
                        <img src="{{ $images[0]->getUrl() }}"
                        style="border: 1px solid #333; max-width:300px; max-height:300px;" />
                        @else
                        <input class="form-control" value="Foto tidak tersedia" disabled>
                        @endif
                    </div>
                </div>
            @endif

            <button type="submit" class="btn btn-primary mr-2" >Submit</button>
            <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
        </form>
        </div>
    </div>
</div>
