@extends('layouts.cms_layout')

@section('title','Konsultasi')
@section('after-script')
<script>
    setCurrent('cms/konsultasi');
</script>
@endsection
@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Pembayaran Konsultasi</h3>
@endsection

@section('main-content')
    @can('cms.konsultasi.create')
    <div>
        <a type="button" href="{{ route('cms.konsultasi.create') }}" class="btn btn-sm btn-info btn-icon-text mb-3"><i class="fa-solid fa-plus mr-2"></i>Tambah Data</a>
    </div>

    @endcan

    <livewire:cms.konsultasi.konsultasi-index />
@endsection
