@section('title','Edit Transaksi Obat')
@section('after-script')
<script>
    setCurrent('cms/transaksi-obat');
</script>
@endsection
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Transaksi Obat #{{ $transaksi_obat->id }}</h4>

        @include('components.cms.alert')
        <form class="forms-sample" wire:submit.prevent="save">
            <x-text title="Kode Transaksi" wireModel='transaksi_obat.kode_transaksi' placeholder="Kode Transaksi" addAttributes="disabled"/>
            <x-text title="Harga Obat" wireModel='transaksi_obat.harga_saat_ini' placeholder="Harga Obat"/>
            <!-- {{ $transaksi_obat["status_proses"] }} -->
            <x-select title="Status Diproses" wireModel='transaksi_obat.status_proses' :options="$jenisProses" placeholder="Status Proses" addAttributes="required"/>
            <x-select title="Status Pembayaran" wireModel='transaksi_obat.status_pembayaran' :options="$statusPembayaranOptions" placeholder="Status Pembayaran" addAttributes="required"/>
            <x-select title="Jenis Pengambilan" wireModel='transaksi_obat.jenis_pengambilan' :options="$jenisPengambilan" placeholder="Status Pembayaran" addAttributes="required" addAttributes="disabled"/>
            <x-select title="Status Pengambilan" wireModel='transaksi_obat.status_pengambilan' :options="$statusPengambilanOptions" placeholder="Status Pembayaran" addAttributes="required"/>
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
            <x-cms.select-two title="Pasien" wireModel='transaksi_obat.pasien_id' :options="$pasienOptions" placeholder="Pasien" addAttributes="disabled"/>

            {{-- <div class="mb-4">
                <div>
                    <label for="">Obat Pesanan</label>
                    @foreach ($pesananObat as $key => $item)
                    <div class="card bg-primary text-white my-2">
                        <div class="card-body">
                            <x-cms.select-two title="Obat" wireModel='pesananObat.{{ $key }}.obat_id' :options="$obatOptions" placeholder="Obat" addAttributes="disabled"/>
                            <x-text type="number" title="Jumlah" wireModel='pesananObat.{{ $key }}.amount' placeholder="Jumlah" addAttributes="disabled"/>
                        </div>
                    </div>
                    @endforeach

                </div>
                <button wire:click="addObat()" type="button" class="btn btn-primary btn-sm mt-4">Add Obat</button>
            </div> --}}
            {{-- <x-text type="file" title="Bukti Pembayaran" wireModel='imageUpload' placeholder="Bukti Pembayaran" addAttributes="required"/> --}}

            <button type="submit" class="btn btn-primary mr-2" >Submit</button>
            <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
        </form>
        </div>
    </div>
</div>
