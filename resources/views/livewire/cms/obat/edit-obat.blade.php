@section('title','Edit Obat')
@section('after-script')
<script>
    setCurrent('cms/obat');
</script>
@endsection
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Obat #{{ $obat->id }}</h4>

        @include('components.cms.alert')
        <form class="forms-sample" wire:submit.prevent="save">
            <x-text title="Nama Obat" wireModel='obat.nama' placeholder="Nama Obat" addAttributes="required"/>
            <x-select title="Kategori Obat" wireModel='obat.kategori_obat' :options="$kategori_obat" placeholder="Nama Obat" addAttributes="required"/>
            <div class="form-group mb-12">
                <label>Foto Obat Saat Ini</label>
                <div class="form-group">
                    @if (count($image) > 0)
                        <img src="{{ $image[0]->getUrl() }}"
                            style="border: 1px solid #333; max-width:300px; max-height:300px;" />
                    @else
                        <input class="form-control" value="Foto tidak tersedia" disabled>
                    @endif
                </div>
            </div>
            <x-text type="file" title="Update Foto Obat" wireModel='imageUpload' placeholder="Foto Obat" addAttributes=""/>
            <x-text type="number" title="Stok Obat" wireModel='obat.stok' placeholder="Stok Obat" addAttributes="required"/>
            <x-text type="number" title="Harga Obat" wireModel='obat.harga' placeholder="Harga Obat" addAttributes="required"/>
            <x-cms.tiny-mce labelName="Konten *" readonly="0" wire:model="obat.deskripsi" note="note:optional" placeholder="Type anything you want..."/>
                @error('obat.deskripsi')
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
