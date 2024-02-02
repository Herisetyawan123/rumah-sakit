@extends('layouts.cms_layout')

@section('title','Kasir')

@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Data Kasir</h3>
@endsection

@section('main-content')
    @can('cms.kasir.create')
    <div>
        <a type="button" href="{{ route('cms.kasir.create') }}" class="btn btn-sm btn-info btn-icon-text mb-3"><i class="fa-solid fa-plus mr-2"></i>Tambah Data</a>
    </div>

    @endcan

    <livewire:cms.kasir.kasir-index />
@endsection

@section('after-script')
@endsection
