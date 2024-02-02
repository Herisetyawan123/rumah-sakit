@extends('layouts.cms_layout')

@section('title','Konsultasi')
@section('after-script')
<script>
    setCurrent('cms/riwayat-konsultasi');
</script>
@endsection
@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Riwayat Konsultasi</h3>
@endsection

@section('main-content')

    <livewire:cms.konsultasi.riwayat-konsultasi />
@endsection
