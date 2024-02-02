@extends('layouts.cms_layout')

@section('title','Transaksi Obat')
@section('after-script')
<script>
    setCurrent('cms/riwayat-transaksi-obat');
</script>
@endsection
@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Riwayat Transaksi Obat</h3>
@endsection

@section('main-content')

    <livewire:cms.riwayat-transaksi-obat.riwayat-transaksi-obat-index />
@endsection
