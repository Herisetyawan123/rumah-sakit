@extends('layouts.cms_layout')

@section('title','Bank')

@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Data Bank</h3>
@endsection

@section('main-content')
    @can('cms.banks.create')
    <div>
        <a type="button" href="{{ route('cms.bank.create') }}" class="btn btn-sm btn-info btn-icon-text mb-3"><i class="fa-solid fa-plus mr-2"></i>Tambah Data</a>
    </div>

    @endcan

    <livewire:cms.bank.bank-index />
@endsection

@section('after-script')
@endsection
