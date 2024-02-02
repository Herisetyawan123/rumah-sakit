@section('title','Konsultasi')
<div class="mt-10 mb-[5.1rem] flex flex-col justify-center items-center">
    <div class="title mb-12">
        <h1 class="text-3xl font-semibold text-blue-900">List Konsultasi Dokter</h1>
    </div>

    <input type="text" wire:model="search" wire:change="getListDokter" class="input input-bordered w-full max-w-xl mb-10" placeholder="Cari Dokter...">

    <div class="medicine flex justify-center gap-4">
        @foreach ($listDokter as $item)
            <div class="card-medicine flex gap-5 flex-wrap justify-center">
                <div class="card w-96 bg-base-100 shadow-xl">
                    <figure class="w-1/2 self-center">
                        <div class="avatar">
                            <div class="rounded-full">
                                <img src="{{ $item->images[0]['url']??asset('home/img/e-konsul.jpg')  }}" alt="Shoes" />
                            </div>
                        </div>
                    </figure>
                    <h2 class="self-center font-bold text-xl">Dr. {{ $item->nama }}</h2>
                    <p class="self-center text-gray-400">{{ $item->spesialisasi }}</p>
                    <div class="justify-between card-body flex-rows" style="flex-direction: row!important;">
                        <div>
                            <div class="text-gray-400">Mulai dari</div>
                            <div class="font-bold text-amber-500 text-xl">@currency($item->nominal)</div>
                        </div>
                        <div>
                            <a href="#my-modal-2-{{ $item->id }}" class="btn btn-primary">Konsultasi</a>
                        </div>
                    </div>
                </div>
                <!-- Put this part before </body> tag -->
                <div class="modal" id="my-modal-2-{{ $item->id }}">
                <div class="modal-box">
                    <div class="flex justify-between items-center ">
                        <div class="font-bold border-b-4">
                            Konsultasi Dokter
                        </div>
                        <div>

                            <a href="#"  class="btn btn-sm btn-circle btn-error btn-outline absolute right-2 top-3.5">✕</a>
                        </div>
                    </div>
                    <div class="mt-8 flex items-center">
                        <div class="w-1/3 mr-4">
                            <div class="avatar">
                                <div class="rounded-full">
                                    <img src="{{ $item->images[0]['url']??asset('home/img/e-konsul.jpg')  }}" alt="Shoes" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="font-bold text-sky-700 text-xl">
                                <i class="fa-solid fa-user-doctor mr-2"></i> Dr. {{ $item->nama }}
                            </div>
                            <div class="mt-2">
                                {{ $item->spesialisasi }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <div class="font-bold">
                            Jadwal Kerja
                        </div>
                        <div class="text-center p-3 border-4 mt-2">
                            {{ $item->jam_kerja_start }} - {{ $item->jam_kerja_end }}
                        </div>
                    </div>
                    <div class="mt-8">
                        <div class="font-bold">
                            Harga Mulai Dari
                        </div>
                        <div class="mt-2 font-bold text-amber-500 text-xl">
                            @currency($item->nominal)
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-text type="date" title="Pilih Tanggal" labelClass="font-bold mb-4" wireModel='tanggalKonsultasi' inputClass="input w-full border-sky-800" placeholder="Foto Obat" addAttributes="required"/>
                    </div>
                    <div class="mt-4">
                        <x-text type="number" title="Nomor Telepon" labelClass="font-bold mb-4" wireModel='noTelp' inputClass="input w-full border-sky-800" placeholder="Nomor Telepon" addAttributes="required"/>
                    </div>
                    <div class="mt-4">
                        <x-select title="Bank" labelClass="font-bold mb-4" wireModel='bank' :options="$bankOptions" inputClass="input w-full border-sky-800" placeholder="Nomor Telepon" addAttributes="required"/>
                    </div>
                    <div class="modal-action justify-center">
                        <a href="#" class="btn btn-info" wire:click="booking({{ $item->id }})">Booking Konsultasi</a>
                    </div>
                </div>
                </div>

            </div>
        @endforeach

    </div>
</div>
