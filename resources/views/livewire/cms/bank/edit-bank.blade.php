@section('title','Edit Bank')
@section('after-script')
<script>
    setCurrent('cms/bank');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Bank #{{ $bank->id }}</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama Bank" wireModel='bank.nama_bank' placeholder="Nama Bank" addAttributes="required"/>
                <x-text title="Nomor Rekening" wireModel='bank.no_rekening' placeholder="Nomor Rekening" addAttributes="required"/>

                <div class="form-group mb-12">
                    <label>Logo Bank Saat Ini</label>
                    <div class="form-group">
                        @if (count($image) > 0)
                            <img src="{{ $image[0]->getUrl() }}"
                                style="border: 1px solid #333; max-width:300px; max-height:300px;" />
                        @else
                            <input class="form-control" value="Foto tidak tersedia" disabled>
                        @endif
                    </div>
                </div>
                <x-text type='file' title="Ubah Logo Bank" wireModel='uploadImage' placeholder="Nomor Rekening" addAttributes="required accept=image/jpeg,image/jpg,image/png,image/webp"/>

                <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
