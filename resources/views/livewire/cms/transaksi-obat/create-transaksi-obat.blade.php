@section('title','Create Transaksi Obat')
@section('after-script')
<script>
    setCurrent('cms/transaksi-obat');
</script>
@endsection
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Transaksi Obat Baru</h4>

        @include('components.cms.alert')
        <form class="forms-sample" wire:submit.prevent="save">
            {{-- <x-text title="Kode Transaksi" wireModel='transaksi_obat.kode_transaksi' placeholder="Kode Transaksi" addAttributes="required"/> --}}
            <x-cms.select-two title="Pasien" wireModel='transaksi_obat.pasien_id' :options="$pasienOptions" placeholder="Pasien" addAttributes="required"/>
            <x-text type="date" title="Tanggal Pemesanan" wireModel='transaksi_obat.tanggal_pemesanan' placeholder="Tanggal Pemesanan" addAttributes="required"/>
            <x-select title="Status Pembayaran" wireModel='transaksi_obat.status_pembayaran' :options="$statusPembayaranOptions" placeholder="Status Pembayaran" addAttributes="required"/>
            <x-select title="Status Pengambilan" wireModel='transaksi_obat.status_pengambilan' :options="$statusPengambilanOptions" placeholder="Status Pembayaran" addAttributes="required"/>

            <div class="mb-4">
                <div>
                    <label for="">Obat Pesanan</label>
                    @foreach ($pesananObat as $key => $item)
                    <div class="card bg-primary text-white my-2">
                        <div class="card-body">
                            <x-cms.select-two title="Obat" wireModel='pesananObat.{{ $key }}.obat_id' :options="$obatOptions" placeholder="Obat" addAttributes="required"/>
                            <x-text type="number" title="Jumlah" wireModel='pesananObat.{{ $key }}.amount' placeholder="Jumlah" addAttributes="required"/>
                        </div>
                    </div>
                    @endforeach

                </div>
                <button wire:click="addObat()" type="button" class="btn btn-primary btn-sm mt-4">Add Obat</button>
            </div>
            <x-text type="file" title="Bukti Pembayaran" wireModel='imageUpload' placeholder="Bukti Pembayaran" addAttributes=""/>

            <button type="submit" class="btn btn-primary mr-2" >Submit</button>
            <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
        </form>
        </div>
    </div>
</div>
