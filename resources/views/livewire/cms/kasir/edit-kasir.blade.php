@section('title','Edit Kasir')
@section('after-script')
<script>
    setCurrent('cms/admin');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Kasir #{{ $kasir->id }}</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama Pengguna" wireModel='kasir.nama' placeholder="Nama Pengguna" addAttributes="required"/>
                <x-text title="Alamat" wireModel='kasir.alamat' placeholder="Alamat" addAttributes="required"/>
                <x-text type="email" title="Email" wireModel='email' placeholder="Email" addAttributes="required"/>
                <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
