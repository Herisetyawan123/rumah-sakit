@section('title','Create Obat')
@section('after-script')
<script>
    setCurrent('cms/obat');
</script>
@endsection
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Obat Baru</h4>

        @include('components.cms.alert')
        <form class="forms-sample" wire:submit.prevent="save">
            <x-text title="Nama Obat" wireModel='obat.nama' placeholder="Nama Obat" addAttributes="required"/>
            <x-select title="Kategori Obat" wireModel='obat.kategori_obat' :options="$kategori_obat" placeholder="Nama Obat" addAttributes="required"/>
            <x-text type="file" title="Foto Obat" wireModel='imageUpload' placeholder="Foto Obat" addAttributes="required"/>
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
