@extends('layouts.cms_layout')

@section('title','Resep & Diagnosa')
@section('after-script')
<script>
    setCurrent('cms/resep-n-diagnosa');
</script>
@endsection
@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Resep & Diagnosa</h3>
@endsection

@section('main-content')

    @can('cms.resep-n-diagnosa.create')
    <div>
        <a type="button" href="{{ route('dokter.resep-n-diagnosa.create') }}" class="btn btn-sm btn-info btn-icon-text mb-3"><i class="fa-solid fa-plus mr-2"></i>Tambah Data</a>
    </div>
    @endcan


    <livewire:cms.resep-n-diagnosa.resep-n-diagnosa-index />
@endsection

@section('after-script')
@endsection
