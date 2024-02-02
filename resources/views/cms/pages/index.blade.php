@extends('layouts.cms_layout')

@section('title','Index')

@section('main-content')
<div class="flex justify-stretch gap-6 h-full">
    <div class="flex flex-col items-center justify-center w-full h-1/3 bg-amber-500 text-white rounded-md p-4">
        <div class="text-xl text-center">
            Jumlah Pasien
        </div>
        <div class="text-4xl font-bold mt-3">
            {{ $pasien }}
        </div>
    </div>
    <div class="flex flex-col items-center justify-center w-full h-1/3 bg-teal-500 text-white rounded-md p-4">
        <div class="text-xl text-center">
            Jumlah Akun
        </div>
        <div class="text-4xl font-bold mt-3">
            {{ $akun }}
        </div>
    </div>
    <div class="flex flex-col items-center justify-center w-full h-1/3 bg-sky-600 text-white rounded-md p-4">
        <div class="text-xl text-center">
            Jumlah Transaksi Berhasil
        </div>
        <div class="text-4xl font-bold mt-3">
            {{ $jumlahTransaksi }}
        </div>
    </div>
    <div class="flex flex-col items-center justify-center w-full h-1/3 bg-indigo-700 text-white rounded-md p-4">
        <div class="text-xl text-center">
            Total Pendapatan
        </div>
        <div class="text-4xl font-bold mt-3">
            @currency($totalPemasukan)
        </div>
    </div>
</div>
@endsection


{{-- ini adalah konten --}}
