@section('title','Show Bank')
@section('after-script')
<script>
    setCurrent('cms/bank');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Show Bank #{{ $bank->id }}</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama Bank" wireModel='bank.nama_bank' placeholder="Nama Bank" addAttributes="disabled"/>
                <x-text title="Nomor Rekening" wireModel='bank.no_rekening' placeholder="Nomor Rekening" addAttributes="disabled"/>

                <div class="form-group mb-12">
                    <label>Logo Bank</label>
                    <div class="form-group">
                        @if (count($image) > 0)
                            <img src="{{ $image[0]->getUrl() }}"
                                style="border: 1px solid #333; max-width:300px; max-height:300px;" />
                        @else
                            <input class="form-control" value="Foto tidak tersedia" disabled>
                        @endif
                    </div>
                </div>

                @can('cms.banks.update')

                <a href="{{ route('cms.bank.edit',['bank'=>$bank->id]) }}" class="btn btn-warning mr-2" >Edit</a>
                @endcan
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
