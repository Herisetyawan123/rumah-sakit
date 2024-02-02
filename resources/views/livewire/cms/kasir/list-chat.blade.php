@extends('layouts.cms_layout')

@section('title','Obat')
@section('after-script')
<script>
    setCurrent('cms/dashboard/pesan');
</script>
@endsection
@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar List Konsultasi</h3>
@endsection

@section('main-content')

    <livewire:cms.kasir.chat.list-chat />
@endsection
