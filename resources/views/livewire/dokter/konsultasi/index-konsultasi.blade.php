@extends('layouts.layout_dokter')

@section('title','Konsultasi')
@section('after-script')
<script>
    setCurrent('dokter/konsultasi');
</script>
@endsection
@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Konsultasi Saat Ini</h3>
@endsection

@section('main-content')
    {{-- @can('dokter.resep_n_diagnosa.create')
    <div>
        <a type="button" href="{{ route('dokter.resep-n-diagnosa.create') }}" class="btn btn-sm btn-info btn-icon-text mb-3"><i class="fa-solid fa-plus mr-2"></i>Tambah Data</a>
    </div>
    @endcan --}}

    <livewire:dokter.konsultasi.konsultasi-index />
@endsection

@section('after-script')
@endsection
