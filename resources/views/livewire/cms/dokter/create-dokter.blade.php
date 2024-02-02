@section('title','Create Dokter')
@section('after-script')
<script>
    setCurrent('cms/dokter');
</script>
@endsection
<div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Dokter Baru</h4>

            @include('components.cms.alert')
            <form class="forms-sample" wire:submit.prevent="save">
                <x-text title="Nama" wireModel='dokter.nama' placeholder="Nama" addAttributes="required"/>
                <x-text title="Spesialisasi" wireModel='dokter.spesialisasi' placeholder="Spesialisasi" addAttributes="required"/>
                <x-text type="file" title="Foto Dokter" wireModel='image' placeholder="Foto Dokter" addAttributes="required"/>
                <x-text type="number" title="Umur" wireModel='dokter.umur' placeholder="Umur" addAttributes="required"/>
                <x-text type="time" title="Jam Mulai Praktik" wireModel='dokter.jam_kerja_start' placeholder="Jam Mulai Praktik" addAttributes="required"/>
                <x-text type="time" title="Jam Akhir Praktik" wireModel='dokter.jam_kerja_end' placeholder="Jam Akhir Praktik" addAttributes="required"/>
                <x-text type="number" title="Nominal" wireModel='dokter.nominal' placeholder="Nominal" addAttributes="required"/>
                <x-text title="Nomor Telepon" wireModel='dokter.no_telepon' placeholder="Nomor Telepon" addAttributes="required"/>
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
