@section('title','Edit Resep & Diagnosa')
@section('after-script')
<script>
    setCurrent('cms/resep-n-diagnosa');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Show Resep & Diagnosa #{{ $resep_n_diagnosa->id }}</h4>
 
            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Kode Transaksi" wireModel='resep_n_diagnosa.kode_transaksi' placeholder="Kode Transaksi" addAttributes="disabled"/>
                <x-select title="Pasien" wireModel='resep_n_diagnosa.pasien_id' :options="$pasienOptions" addAttributes="disabled"/>
                <x-select title="Dokter" wireModel='resep_n_diagnosa.dokter_id' :options="$dokterOptions" addAttributes="disabled"/>
                <x-cms.tiny-mce labelName="Resep" readonly="1" wire:model="resep_n_diagnosa.resep" note="note:optional" placeholder="Type anything you want..."/>
                @error('resep_n_diagnosa.resep')
                    <div class="font-size-sm mt-2 text-danger">
                        <span class="text-danger error">{{ $message }}</span>
                    </div>
                @enderror
                <x-cms.tiny-mce labelName="Diagnosa" readonly="1" wire:model="resep_n_diagnosa.diagnosa" note="note:optional" placeholder="Type anything you want..."/>
                @error('resep_n_diagnosa.diagnosa')
                    <div class="font-size-sm mt-2 text-danger">
                        <span class="text-danger error">{{ $message }}</span>
                    </div>
                @enderror

                <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
