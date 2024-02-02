@extends('layouts.layout_user')
@section('title','Beranda')
@section('content')
@auth('pasien')
<div class="mt-10 mb-[5.1rem] flex flex-col justify-center items-center h-screen">
    <div class="title mb-12">
        <h1 class="text-3xl font-semibold text-blue-900 text-center">Selamat Datang di layanan daring <br> RSIA Muhammadiyah Kota Probolinggo</h1>
    </div>

    <div class="card-service flex gap-10">
        <a href="{{ route('pasien.konsultasi.index') }}">
            <div class="card w-96 bg-base-100 shadow-xl">
                <figure class="px-5 pt-5">
                    <img src="{{ asset("home/img/e-konsul.jpg") }}" alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-start text-center">
                    <h2 class="card-title">E-Konsultasi</h2>
                </div>
            </div>
        </a>

        <a href="{{ route('pasien.pesan-obat.index') }}">
            <div class="card w-96 bg-base-100 shadow-xl">
                <figure class="px-5 pt-5">
                    <img src="{{ asset("home/img/e-obat.jpg") }}" alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-start text-center">
                    <h2 class="card-title">E-Obat</h2>
                </div>
            </div>
        </a>
    </div>
</div>
@else
<div class="hero min-h-screen" style="background-image: url(/home/img/hero.png);">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="max-w-5xl">
            <div class="flex gap-10">
                <div class="flex flex-col gap-3 w-full text-left my-auto">
                    <h1 class="text-5xl font-bold">Selamat Datang di RSIA </h1>
                    <h1 class="text-5xl font-bold">Muhammadiyah Kota Probolinggo</h1>
                </div>

                <div class="logo">
                    <img src="{{ asset("home/img/logo rsia.png") }}" alt="" width="400px">
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection
