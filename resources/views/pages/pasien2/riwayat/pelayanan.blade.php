@extends('layouts.layout_user')
@section('title','Beranda')
@section('content')
@section('title','Riwayat Konsultasi')
<div class="mt-10 flex flex-col justify-start px-10 h-screen mb-[5rem]">

    <div class="mb-5">
        <div class="title mb-12">
            <h1 class="text-2xl font-semibold text-blue-900">Pelayanan</h1>
        </div>
        <div class="grid grid-cols-4 mt-3 gap-5">
            @foreach($konsultasi as $item)
            <a href="/pasien/chat/{{ $item->id }}"  class="bg-white shadow-md py-3">
                <div class="flex p-2 justify-between header border border-b-black">
                    @if($item->status != 'selesai')
                    <div class="text-yellow-600 font-bold">
                        {{ $item->status }}
                    </div>
                    @else
                    <div class="text-green-600 font-bold">
                        {{ $item->status }}
                    </div>
                    @endif

                    <div class="font-bold">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}
                    </div>
                </div>

                <div class="p-2">
                    <div>
                        <h3 class="font-bold">{{ $item->pasien->nama }}</h3>

                        <h4 class="mt-5 text-sm font-light">Konsultasi dengan</h4>
                        <p class="font-bold">Tim Apoteker</p>
                    </div>
                </div>
            </a>
            @endforeach


        </div>
    </div>

</div @endsection