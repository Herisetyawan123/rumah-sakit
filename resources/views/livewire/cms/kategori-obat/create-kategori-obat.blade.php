@section('title','Create Kategori Obat')
@section('after-script')
<script>
    setCurrent('cms/kategori-obat');
</script>
@endsection
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Kategori Obat Baru</h4>

        @include('components.cms.alert')
        <form class="forms-sample" wire:submit.prevent="save">
            <x-text title="Nama Kategori Obat" wireModel='kategori_obat.kategori' placeholder="Nama Kategori Obat" addAttributes="required"/>
            <button type="submit" class="btn btn-primary mr-2" >Submit</button>
            <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
        </form>
        </div>
    </div>
</div>
