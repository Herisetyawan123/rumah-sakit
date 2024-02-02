@section('title','Show Pasien')
@section('after-script')
<script>
    setCurrent('cms/pasien');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Show Kasir #{{ $pasien->id }}</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nomor Rekam Medis" wireModel='pasien.no_rm' placeholder="Nomor Rekam Medis" addAttributes="disabled"/>
                <x-text title="Pasien" wireModel='pasien.nama' placeholder="Pasien" addAttributes="disabled"/>
                <x-select title="Jenis Kelamin" wireModel='pasien.jenis_kelamin' :options="$genderOptions" addAttributes="disabled"/>
                <x-text title="NIK" wireModel='pasien.nik' placeholder="NIK" addAttributes="disabled"/>
                <x-text title="Nomor Telepon" wireModel='pasien.no_telepon' placeholder="Nomor Telepon" addAttributes="disabled"/>
                <x-text title="Alamat" wireModel='pasien.alamat' placeholder="Alamat" addAttributes="disabled"/>

                @can('cms.pasien.update')

                <a href="{{ route('cms.pasien.edit',['pasien'=>$pasien->id]) }}" class="btn btn-warning mr-2" >Edit</a>
                @endcan
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
