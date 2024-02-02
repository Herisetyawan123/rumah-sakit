    @section('title','Pesan Obat')
    <div class="mt-10 mb-[5.1rem] flex flex-col justify-center px-10">
        <div x-data="{ show: true }" x-show="show" x-ref="alert" x-init="setTimeout(() => $refs.alert.remove(), 3000)">
            @if (session()->has('alertMessage'))
            <div class="toast toast-start" >
                <div class="alert alert-{{ session('alertType') }} bg-green-600 text-white">
                    <div>
                        <span> {{ session('alertMessage') }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="title mb-12 mx-10 flex justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-blue-900">Pemesanan Obat</h1>
            </div>
            <div>
                <div class="dropdown dropdown-end">
                    <label tabindex="0"  class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>Keranjang</label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow rounded-box w-96 bg-slate-700 opacity-5 gap-y-3">

                        @if (count($cart)>0)
                            @foreach ($cart as $key=>$item)
                                <li>
                                    <div class="flex sm:max-h-24 shadow-xl rounded-xl bg-white p-4 justify-between">
                                        <div class="flex-grow">
                                            <div class="font-bold">
                                                {{ $item['nama'] }}
                                                </div>
                                                <div class="whitespace-nowrap">
                                                    @currency($item['harga'])
                                                </div>
                                        </div>

                                        <div class="grid justify-items-stretch">
                                            <div class="text-xl justify-self-end flex justify-end items-center ">
                                                <button class="btn btn-xs btn-square rounded-md" wire:click="lessAmount('{{ $item['id'] }}')">
                                                    <i class="fa-solid fa-minus text-white"></i>
                                                </button>
                                                <input type="number" class="text-center w-2/5 border-none" value="{{ $item['amount'] }}" wire:model='cart.{{ $key }}.amount'>

                                                <button class="btn btn-xs btn-square rounded-md"  wire:click="addAmount('{{ $item['id'] }}')">
                                                    <i class="fa-solid fa-plus text-white"></i>
                                                </button>
                                            </div>
                                            <div class="mt-2 flex justify-end">
                                                = @currency($item['harga']*$item['amount'])
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <div class="flex justify-center my-8">
                                <button class="btn btn-secondary rounded-full" wire:click='pesan' >Pesan</button>
                            </div>
                        @else
                            <li>
                                <div class="p-4 text-white">
                                    Belum ada obat ditambahkan
                                </div>
                            </li>
                        @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <input type="text" id="search" wire:model="search" wire:change='getListObat()' class="input input-bordered w-full max-w-xl mb-10" placeholder="Cari Obat...">
        </div>

        <div class="medicine flex justify-center">
            <div class="card-medicine flex gap-5 flex-wrap justify-center">
                @foreach ($listObat as $item)
                <div class="card w-96 bg-base-100 shadow-xl">
                    <figure><img class="h-24" src="{{ $item->images[0]['url']??asset('home/img/e-obat.jpg') }}" alt="Shoes" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $item->nama }}</h2>
                        <p>{{ 'Rp. '.number_format($item->harga,0,',','.') }}</p>
                        {{-- <div class="overflow-auto">{!! $item->deskripsi !!}</div> --}}
                        <div class="card-actions justify-center">
                            <button class="btn btn-primary rounded-full" wire:click='add({{ $item->id }})'><i class="fa-solid fa-plus mr-2"></i>Tambah</button>
                        </div>
                    </div>
                </div>
                @endforeach


                {{-- <div class="card w-96 bg-base-100 shadow-xl">
                    <figure><img src="/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">Shoes!</h2>
                        <p>If a dog chews shoes whose shoes does he choose?</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>

                <div class="card w-96 bg-base-100 shadow-xl">
                    <figure><img src="/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">Shoes!</h2>
                        <p>If a dog chews shoes whose shoes does he choose?</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>

                <div class="card w-96 bg-base-100 shadow-xl">
                    <figure><img src="/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">Shoes!</h2>
                        <p>If a dog chews shoes whose shoes does he choose?</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>

                <div class="card w-96 bg-base-100 shadow-xl">
                    <figure><img src="/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">Shoes!</h2>
                        <p>If a dog chews shoes whose shoes does he choose?</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div>

                <div class="card w-96 bg-base-100 shadow-xl">
                    <figure><img src="/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">Shoes!</h2>
                        <p>If a dog chews shoes whose shoes does he choose?</p>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Buy Now</button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

