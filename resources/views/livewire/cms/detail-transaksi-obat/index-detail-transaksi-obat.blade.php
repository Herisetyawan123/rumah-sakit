@extends('layouts.cms_layout')

@section('title','Transaksi Obat')
@section('after-script')
<script>
    setCurrent('cms/transaksi-obat');
</script>
@endsection
@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Detail Transaksi Obat</h3>
@endsection

@section('main-content')
    {{-- @can('cms.detail_transaksi_obat.create')
    <div>
        <a type="button" href="{{ route('cms.transaksi-obat.create') }}" class="btn btn-sm btn-info btn-icon-text mb-3"><i class="fa-solid fa-plus mr-2"></i>Tambah Data</a>
    </div>

    @endcan --}}

    <livewire:cms.detail-transaksi-obat.detail-transaksi-obat-index transaksiId="{{ $id }}" />
@endsection
