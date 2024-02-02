@extends('layouts.layout_dokter')

@section('title','Dashboard')

@section('main-content')
    <div class="flex justify-between mb-12">
        <div>
            <div class="font-bold text-2xl mb-2">
                Dashboard Dokter
            </div>
            <div>
                Selamat di aplikasi Sistem Informasi Penebusan Obat
            </div>
        </div>
        <div>
            <a class="btn btn-primary rounded-none" style="border-radius: 0px!important">List Konsultasi Online</a>
        </div>
    </div>

    <div class="flex">
        <div class="flex-grow pl-6 pr-16">
            <div class="font-bold text-lg">Konsultasi Terbaru</div>
            <div class="divider" style="margin-left: -24px"></div>
            @if ($konsultasi)
                <div class="flex items-center mb-3">
                    <div class="w-24">
                        Kode Transaksi
                    </div>
                    <div class="ml-8">
                        : {{$konsultasi->no_pesanan}}
                    </div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="w-24">
                        Nama Pasien
                    </div>
                    <div class="ml-8">
                        : {{ $konsultasi->pasien->nama }}
                    </div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="w-24">
                        Tanggal Pesanan
                    </div>
                    <div class="ml-8">
                        : {{ $konsultasi->tanggal_pesanan }}
                    </div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="w-24">
                        Status Pembayaran
                    </div>
                    <div class="ml-8">
                        : @if ($konsultasi->status_pembayaran == 'lunas')
                        <div class="badge badge-success ">Lunas</div>
                    @elseif ($konsultasi->status_pembayaran == 'pending')
                        <div class="badge badge-warning ">Pending</div>
                    @elseif ($konsultasi->status_pembayaran == 'ditolak')
                        <div class="badge badge-error ">Ditolak</div>
                    @endif
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <div>
                        <a href="https://wa.me/{{ $konsultasi->no_telepon }}" target="_blank" class="btn btn-primary btn-sm text-xs rounded-none" style="border-radius: 0px!important">Chat Sekarang</a>
                    </div>
                </div>
            @else
                <div class="">
                    Belum ada konsultasi
                </div>
            @endif

        </div>
        <div class="w-1/3 pl-4">
            <div class="font-bold text-lg">Profil Dokter</div>
            <div class="divider" style="margin-left: -24px"></div>
            <div class="avatar p-8" style="margin-top: -32px">
                <div class="w-full rounded-full justify-center border">
                  <img src="{{ Auth::guard('dokter')->user()->getMedia('FOTO_DOKTER')[0]->getUrl()?? asset('cms/images/faces/face28.jpg') }}" />
                </div>
            </div>
            <x-text title="Nama"  placeholder="Nama" value="{{ Auth::guard('dokter')->user()->nama }}" addAttributes="disabled"/>
            <x-text title="Spesialisasi"  placeholder="Spesialisasi" value="{{ Auth::guard('dokter')->user()->spesialisasi }}" addAttributes="disabled"/>
            <x-text type="number" title="Umur"  placeholder="Umur" value="{{ Auth::guard('dokter')->user()->umur }}" addAttributes="disabled"/>
            <x-text type="time" title="Jam Mulai Praktik"  placeholder="Jam Mulai Praktik" value="{{ Auth::guard('dokter')->user()->jam_kerja_start }}" addAttributes="disabled"/>
            <x-text type="time" title="Jam Akhir Praktik"  placeholder="Jam Akhir Praktik" value="{{ Auth::guard('dokter')->user()->jam_kerja_end }}" addAttributes="disabled"/>
            <x-text type="number" title="Nominal"  placeholder="Nominal" value="{{ Auth::guard('dokter')->user()->nominal }}" addAttributes="disabled"/>
            <x-text title="Nomor Telepon"  placeholder="Nomor Telepon" value="{{ Auth::guard('dokter')->user()->no_telepon }}" addAttributes="disabled"/>
            <x-text type="email" title="Email" placeholder="Email" value="{{ Auth::guard('dokter')->user()->email }}" addAttributes="disabled"/>

        </div>

    </div>

@endsection


{{-- ini adalah konten --}}
