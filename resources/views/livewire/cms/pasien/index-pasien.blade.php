@extends('layouts.cms_layout')

@section('title','Pasien')

@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Data Pasien</h3>
@endsection

@section('main-content')
    @can('cms.pasien.create')
    <div>
        <a type="button" href="{{ route('cms.pasien.create') }}" class="btn btn-sm btn-info btn-icon-text mb-3"><i class="fa-solid fa-plus mr-2"></i>Tambah Data</a>
    </div>
    @endcan

    <livewire:cms.pasien.pasien-index />
@endsection

@section('after-script')
@endsection
