@section('title','Create Dokter')
@section('after-script')
<script>
    setCurrent('cms/dokter');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Dokter Baru</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama" wireModel='dokter.nama' placeholder="Nama" addAttributes="required"/>
                <x-text title="Spesialisasi" wireModel='dokter.spesialisasi' placeholder="Spesialisasi" addAttributes="required"/>
                <div class="form-group mb-12">
                    <label>Foto Dokter Saat Ini</label>
                    <div class="form-group">
                        @if (count($uploadedImage) > 0)
                            <img src="{{ $uploadedImage[0]->getUrl() }}"
                                style="border: 1px solid #333; max-width:300px; max-height:300px;" />
                        @else
                            <input class="form-control" value="Foto tidak tersedia" disabled>
                        @endif
                    </div>
                </div>
                <x-text type="file" title="Update Foto Dokter" wireModel='image' placeholder="Foto Dokter" addAttributes=""/>
                <x-text type="number" title="Umur" wireModel='dokter.umur' placeholder="Umur" addAttributes="required"/>
                <x-text type="time" title="Jam Mulai Praktik" wireModel='dokter.jam_kerja_start' placeholder="Jam Mulai Praktik" addAttributes="required"/>
                <x-text type="time" title="Jam Akhir Praktik" wireModel='dokter.jam_kerja_end' placeholder="Jam Akhir Praktik" addAttributes="required"/>
                <x-text type="number" title="Nominal" wireModel='dokter.nominal' placeholder="Nominal" addAttributes="required"/>
                <x-text title="Nomor Telepon" wireModel='dokter.no_telepon' placeholder="Nomor Telepon" addAttributes="required"/>
                <x-text type="email" title="Email" wireModel='email' placeholder="Email" addAttributes="required"/>

                <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
