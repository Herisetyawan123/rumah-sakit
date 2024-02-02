@section('title','Create Resep & Diagnosa')
@section('after-script')
<script>
    setCurrent('dokter/resep-n-diagnosa');
</script>
@endsection
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Resep & Diagnosa Baru</h4>

        @include('components.cms.alert')
        <form class="forms-sample" wire:submit.prevent="save">
            <input type="hidden" name="pasien_id" value="1">
            <!-- <x-text title="Kode Transaksi" wireModel='resep_n_diagnosa.kode_transaksi' placeholder="Kode Transaksi" addAttributes="required" /> -->
            <x-cms.select-two title="Pasien" wireModel='resep_n_diagnosa.pasien_id' :options="$pasienOptions" addAttributes="required" />
            {{-- <x-select title="Jenis Kelamin" wireModel='resep_n_diagnosa.dokter_id' :options="$genderOptions" addAttributes="required"/> --}}
            <x-text type="number" title="Tarif" wireModel='resep_n_diagnosa.tarif' placeholder="Tarif" addAttributes="required" />
            <x-text title="Resep" wireModel='resep_n_diagnosa.resep' placeholder="Resep" addAttributes="required" />
            <x-text title="Diagnosa" wireModel='resep_n_diagnosa.diagnosa' placeholder="Diagnosa" addAttributes="required" />

            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
        </form>
    </div>
</div>