@section('title','Edit Pasien')
@section('after-script')
<script>
    setCurrent('cms/pasien');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Kasir #{{ $pasien->id }}</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nomor Rekam Medis" wireModel='pasien.no_rm' placeholder="Nomor Rekam Medis" addAttributes="required"/>
                <x-text title="Pasien" wireModel='pasien.nama' placeholder="Pasien" addAttributes="required"/>
                <x-select title="Jenis Kelamin" wireModel='pasien.jenis_kelamin' :options="$genderOptions" addAttributes="required"/>
                <x-text title="NIK" wireModel='pasien.nik' placeholder="NIK" addAttributes="required"/>
                <x-text title="Nomor Telepon" wireModel='pasien.no_telepon' placeholder="Nomor Telepon" addAttributes="required"/>
                <x-text title="Alamat" wireModel='pasien.alamat' placeholder="Alamat" addAttributes="required"/>

                <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
