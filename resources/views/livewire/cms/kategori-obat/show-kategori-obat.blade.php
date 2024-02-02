@section('title','Show Kategori Obat')
@section('after-script')
<script>
    setCurrent('cms/kategori-obat');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Show Kategori Obat #{{ $kategori_obat->id }}</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama Kategori Obat" wireModel='kategori_obat.kategori' placeholder="Nama Kategori Obat" addAttributes="disabled"/>
                @can('cms.kategori_obat.update')
                <a href="{{ route('cms.kategori-obat.edit',['kategori_obat'=>$kategori_obat->id]) }}" class="btn btn-warning mr-2" >Edit</a>
                @endcan
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>

