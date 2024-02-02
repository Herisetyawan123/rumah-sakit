@section('title','Create Bank')
@section('after-script')
<script>
    setCurrent('cms/bank');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Bank Baru</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama Bank" wireModel='bank.nama_bank' placeholder="Nama Bank" addAttributes="required"/>
                <x-text title="Nomor Rekening" wireModel='bank.no_rekening' placeholder="Nomor Rekening" addAttributes="required"/>

                <x-text type='file' title="Logo Bank" wireModel='uploadImage' placeholder="Nomor Rekening" addAttributes="required accept=image/jpeg,image/jpg,image/png,image/webp"/>

                <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
