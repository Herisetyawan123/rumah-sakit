@extends('layouts.cms_layout')

@section('title','Obat')
@section('after-script')
<script>
    setCurrent('cms/obat');
</script>
@endsection
@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Obat</h3>
@endsection

@section('main-content')
    @can('cms.kategori_obat.create')
    <div>
        <a type="button" href="{{ route('cms.obat.create') }}" class="btn btn-sm btn-info btn-icon-text mb-3"><i class="fa-solid fa-plus mr-2"></i>Tambah Data</a>
    </div>

    @endcan

    <livewire:cms.obat.obat-index />
@endsection
