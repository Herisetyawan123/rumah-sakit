@section('title','Show Dokter')
@section('after-script')
<script>
    setCurrent('cms/dokter');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Show Dokter #{{ $dokter->id }}</h4>
            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama" wireModel='dokter.nama' placeholder="Nama" addAttributes="disabled"/>
                <x-text title="Spesialisasi" wireModel='dokter.spesialisasi' placeholder="Spesialisasi" addAttributes="disabled"/>
                <div class="form-group mb-12">
                    <label>Foto Dokter</label>
                    <div class="form-group">
                        @if (count($uploadedImage) > 0)
                            <img src="{{ $uploadedImage[0]->getUrl() }}"
                                style="border: 1px solid #333; max-width:300px; max-height:300px;" />
                        @else
                            <input class="form-control" value="Foto tidak tersedia" disabled>
                        @endif
                    </div>
                </div>
                <x-text type="number" title="Umur" wireModel='dokter.umur' placeholder="Umur" addAttributes="disabled"/>
                <x-text type="time" title="Jam Mulai Praktik" wireModel='dokter.jam_kerja_start' placeholder="Jam Mulai Praktik" addAttributes="disabled"/>
                <x-text type="time" title="Jam Akhir Praktik" wireModel='dokter.jam_kerja_end' placeholder="Jam Akhir Praktik" addAttributes="disabled"/>
                <x-text type="number" title="Nominal" wireModel='dokter.nominal' placeholder="Nominal" addAttributes="disabled"/>
                <x-text title="Nomor Telepon" wireModel='dokter.no_telepon' placeholder="Nomor Telepon" addAttributes="disabled"/>
                <x-text type="email" title="Email" wireModel='email' placeholder="Email" addAttributes="disabled"/>

                @can('cms.banks.update')

                <a href="{{ route('cms.dokter.edit',['dokter'=>$dokter->id]) }}" class="btn btn-warning mr-2" >Edit</a>
                @endcan
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
