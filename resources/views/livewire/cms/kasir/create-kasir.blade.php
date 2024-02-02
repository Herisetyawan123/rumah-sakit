@section('title','Create Kasir')
@section('after-script')
<script>
    setCurrent('cms/admin');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Kasir Baru</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama Pengguna" wireModel='kasir.nama' placeholder="Nama Pengguna" addAttributes="required"/>
                <x-text title="Alamat" wireModel='kasir.alamat' placeholder="Alamat" addAttributes="required"/>
                <x-text type="email" title="Email" wireModel='email' placeholder="Email" addAttributes="required"/>
                <div class="flex gap-5">
                    <x-text type="{{ $isVisible?'text':'password' }}" formClass="flex-grow" inputClass="w-full" title="Password" wireModel='password' placeholder="Password" addAttributes="required"/>
                    <x-text type="{{ $isVisible?'text':'password' }}" formClass="flex-grow" inputClass="w-full" title="Confirm Password" wireModel='confirmPassword' placeholder="Comfirm Password" addAttributes="required"/>
                </div>
                <div style="margin-top: -1rem!important">
                    <x-checkbox title="Show Password" wireModel='isVisible'/>
                </div>
                @if ($password != $confirmPassword)
                    <div class="text-sm text-error mb-8" style="margin-top: -1rem!important">
                        Password is not match
                    </div>
                @endif
                <button type="submit" class="btn btn-primary mr-2" >Submit</button>
                <button type="button" class="btn btn-outline-danger" wire:click='backToIndex'>Cancel</button>
            </form>
            </div>
        </div>
</div>
