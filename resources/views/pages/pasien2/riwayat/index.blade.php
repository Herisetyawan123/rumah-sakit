@extends('layouts.layout_user')
@section('content')
@section('title','Riwayat')
<div class="mt-10 flex flex-col justify-start px-10 h-screen mb-[5rem]">

    <div class="mb-12">
        <div class="title mb-12">
            <h1 class="text-2xl font-semibold text-blue-900">Konsultasi Saya</h1>
        </div>
        <div class="grid grid-cols-4 mt-2 gap-5">
            @foreach($konsultasi as $item)
            <a href="/pasien/chat/{{ $item->id }}" class="bg-white shadow-md py-3">
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
            @if(count($konsultasi) == 0)
                <p class="text-2xl font-bold">Data tidak ada</p>
            @endif

        </div>
    </div>

    <div>
        <div class="title mb-12">
            <h1 class="text-2xl font-semibold text-blue-900">Tebus Obat</h1>
        </div>
        <div class="grid grid-cols-4 mt-3 gap-5">
            @foreach($riwayat as $item)
            <a href="#my-modal-2-{{ $item->id }}" class="bg-white shadow-md py-3">
                <div class="flex p-2 justify-between header border border-b-black">
                    @if($item->status_pengambilan != 'diterima')
                    <div class="text-green-600 font-bold">
                        {{ $item->status_pengambilan }}
                    </div>
                    @else
                    <div class="text-green-600 font-bold">
                        {{ $item->status_pengambilan }}
                    </div>
                    @endif

                    <div class="font-bold">
                        {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}
                    </div>
                </div>

                <div class="p-2">
                    <h3 class="font-bold">{{ $item->pasien->nama }}</h3>

                    <div class="flex justify-between">
                        
                        <div>
                            <h4 class="mt-5 text-sm font-light">Status Pembayaran</h4>
                            @if($item->status_pembayaran == 'lunas')
                            <div class="text-green-600 font-bold">
                                {{ $item->status_pembayaran }}
                            </div>
                            @elseif($item->status_pembayaran == 'pending')
                            <div class="text-yellow-600 font-bold">
                                {{ $item->status_pembayaran }}
                            </div>
                            @elseif($item->status_pembayaran == 'menunggu konfirmasi')
                            <div class="text-blue-600 font-bold">
                                {{ $item->status_pembayaran }}
                            </div>
    
                            @elseif($item->status_pembayaran == 'ditolak')
                            <div class="text-red-600 font-bold">
                                {{ $item->status_pembayaran }}
                            </div>
                            @endif
                        </div>

                        <div>
                            <h4 class="mt-5 text-sm font-light">Metode Pembayaran</h4>
                            @if($item->metode_pembayaran == 'cod')
                            <div class="text-green-600 font-bold">
                                {{ $item->metode_pembayaran }}
                            </div>
                            @elseif($item->metode_pembayaran == 'transfer')
                            <div class="text-blue-600 font-bold">
                                {{ $item->metode_pembayaran }}
                            </div>
                            @else
                            <div class="text-blue-600 font-bold">
                                {{ $item->metode_pembayaran }}
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </a>

            <div class="modal" id="my-modal-2-{{ $item->id }}" x-init x-data="{
                                printDiv() {
                                    var printContents = this.$refs.container.innerHTML;
                                    var originalContents = document.body.innerHTML;
                                    window.onbeforeprint = function(){
                                        document.body.innerHTML = printContents;

                                    }
                                    window.print();
                                    console.log('jalan kok');
                                    location.reload();
                                    window.onafterprint = function(){
                                        document.body.innerHTML = originalContents;
                                     }
                                }
                            }">
                <form action="/pasien/tebus/obat-edit" method="post" class="modal-box">
                    @csrf
                    {{-- <label for="my-modal-2" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label> --}}
                    
                    <div class="modal-action">
                        <a href="#" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
                    </div>
                    <div x-ref="container">
                        <div class="flex justify-center text-xl font-bold">
                            Transaksi Obat
                        </div>
                     
                        <div class="flex justify-between mt-6">
                            <div>
                                Kode Transaksi
                            </div>
                            <div>
                                {{ $item->kode_transaksi }}
                            </div>
                        </div>

                        <div class="flex justify-between mt-2">
                            <div>
                                Nama Pasien
                            </div>
                            <div>
                                {{ $item->pasien->nama }}
                            </div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <div>
                                Tanggal Pemesanan
                            </div>
                            <div>
                                {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}
                            </div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <div>
                                Status Obat
                            </div>
                            <div class="{{ $item->status_proses == 'diproses' ? 'text-yellow-600' : 'text-green-600' }}">
                                {{ $item->status_proses }}
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="flex justify-center text-xl font-bold">
                            Detail Transaksi Obat
                        </div>
                        
                        <div class="flex justify-between mt-6">
                            <div>
                                jenis pengambilan
                            </div>
                            <div>
                                
                                <select name="jenis_pengambilan">
                                    <option value="diambil" {{ $item->jenis_pengambilan == 'diambil' ? 'selected' : '' }}>diambil</option>
                                    <option value="diantar" {{ $item->jenis_pengambilan == 'diantar' ? 'selected' : '' }}>Diantar</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-between mt-2">
                            <div>
                                Metode Pembayaran
                            </div>
                            <div>
                                <select name="metode_pembayaran">
                                    <option value="cod" {{ $item->metode_pembayaran == 'cod' ? 'selected' : '' }}>cod</option>
                                    <option value="transfer" {{ $item->metode_pembayaran == 'transfer' ? 'selected' : '' }}>transfer</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-between mt-2">
                            <div>
                                Tinggi
                            </div>
                            <div>
                                <input type="number" name="tinggi" value="{{ $item->detailtransaksi[0]->tinggi }}" >
                            </div>
                        </div>

                        <div class="flex justify-between mt-2">
                            <div>
                                Berat
                            </div>
                            <div>
                                <input type="number" name="berat" value="{{ $item->detailtransaksi[0]->berat }}" >
                            </div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <div>
                                Riwayat alergi
                            </div>
                            <div>
                            <div>
                                <input type="text" name="riwayat_alergi" value="{{ $item->detailtransaksi[0]->riwayat_alergi }}" >
                            </div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <div>
                               Alamat Tujuan
                            </div>
                            <div>
                            <div>
                                <input type="text" name="alamat" value="{{ $item->detailtransaksi[0]->alamat }}" >
                            </div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <div>
                               Detail Lokasi
                            </div>
                            <div>
                            <div>
                                <input type="text" name="detail_lokasi" value="{{ $item->detailtransaksi[0]->detail_lokasi }}" >
                            </div>
                            </div>
                        </div>
  

                        <div class="border-t-2 mt-2">
                            <div class="flex justify-between mt-2">
                                <div class="font-bold">
                                    Total
                                </div>
                                <div>
                                    {{ "Rp ". number_format($item->harga_saat_ini, 0) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-4 gap-2 justify-center">
                        <span class="" x-on:click="printDiv()">
                            <button class="btn btn-info"><i class="fa-solid fa-print mr-2"></i>Print</button>
                        </span>

                        <span>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pencil mr-2"></i>Edit</button>
                        </span>
                    </div>

                </form>
            </div>
            @endforeach

            @if(count($riwayat) == 0)
                <p class="text-2xl font-bold">Data tidak ada</p>
            @endif
        </div>
    </div>
</div @endsection