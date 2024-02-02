@extends('layouts.layout_dokter')

@section('title','Resep & Diagnosa')

@section('heading-content')
<h3 class="mb-6 text-2xl">Daftar Resep & Diagnosa</h3>
@endsection

@section('main-content')
    @can('dokter.resep_n_diagnosa.create')
    <div>
        <a type="button" href="{{ route('dokter.resep-n-diagnosa.create') }}" class="btn btn-sm btn-info btn-icon-text mb-3"><i class="fa-solid fa-plus mr-2"></i>Tambah Data</a>
    </div> 
    @endcan

    <livewire:dokter.resep-n-diagnosa.resep-n-diagnosa-index />
@endsection

@section('after-script')
@endsection
