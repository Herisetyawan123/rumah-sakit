@section('title','Show Kasir')
@section('after-script')
<script>
    setCurrent('cms/admin');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Show Kasir #{{ $kasir->id }}</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama Pengguna" wireModel='kasir.nama' placeholder="Nama Pengguna" addAttributes="disabled"/>
                <x-text title="Alamat" wireModel='kasir.alamat' placeholder="Alamat" addAttributes="disabled"/>
                <x-text type="email" title="Email" wireModel='email' placeholder="Email" addAttributes="disabled"/>
                @can('cms.kasir.update')
                <a href="{{ route('cms.kasir.edit',['kasir'=>$kasir->id]) }}" class="btn btn-warning mr-2" >Edit</a>
                @endcan
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>

