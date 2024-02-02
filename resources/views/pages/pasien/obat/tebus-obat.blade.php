@section('title','Tebus Obat')


<div class="mt-10 mb-[5.1rem] flex flex-col justify-start items-center h-screen">
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
    <div class="title mb-12">
        <h1 class="text-3xl font-semibold text-blue-900">Daftar Perlu Ditebus</h1>
    </div>


    <div class="tebus flex justify-center">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Total Harga</th>
                        <th>Status Pembayaran</th>
                        <th>Jenis Pengambilan</th>
                        <th>Status Pengambilan</th>
                        <th>Lihat Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($listTransaksi as $item)
                        <tr class="bg-base-200 border-b-2">
                            <td>{{ $item->kode_transaksi }}</td>
                            <td class="text-center">{{ $this->getTanggal($item->tanggal_pemesanan) }}</td>
                            <td>@currency($this->getTotal($item->id))</td>
                            <td class="text-center"><x-cms.status-pembayaran status='{{ $item->status_pembayaran }}' /></td>
                            <td class="text-center"><x-cms.jenis-pengambilan status='{{ $item->jenis_pengambilan }}' /></td>
                            <td class="text-center"><x-cms.status-pengambilan status='{{ $item->status_pengambilan }}' /></td>
                            <td><a href="#my-modal-2-{{ $item->id }}"  class="btn btn-info btn-sm rounded-full">Lihat Detail</a></td>
                        </tr>
                            <!-- Put this part before </body> tag -->
                            <div class="modal" id="my-modal-2-{{ $item->id }}" >
                                <div class="modal-box">

                                {{-- <label for="my-modal-2" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label> --}}
                                <div class="modal-action">
                                    <a href="#"  class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
                                </div>
                                <div class="flex justify-center text-xl font-bold">
                                    Detail Transaksi
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
                                            Tanggal Pemesanan
                                        </div>
                                        <div>
                                            {{ $this->getTanggal($item->tanggal_pemesanan) }}
                                        </div>
                                    </div>
                                <div class="flex justify-between mt-4 font-bold">
                                    <div>
                                        Detail Pesanan:
                                    </div>
                                </div>
                                @foreach ($item->detailTransaksi as $detail)
                                    <div class="flex justify-between mt-2">
                                        <div>
                                            {{ $detail->obat->nama }}
                                        </div>
                                        <div>
                                            {{ $detail->jumlah }}x @ @currency($detail->harga_saat_ini)
                                        </div>
                                    </div>
                                @endforeach

                                <div class="border-t-2 mt-2">
                                    <div class="flex justify-between mt-2">
                                        <div class="font-bold">
                                            Total
                                        </div>
                                        <div>
                                            @currency($this->getTotal($item->id))
                                        </div>
                                    </div>
                                    @if ($item->status_pembayaran != 'lunas')
                                    <div class="mt-6 justify-center">
                                        <x-select title="Pilih Bank" id="bank" wireModel='selectBank' :options="$bankOptions" wire:change='setBank()' inputClass="select select-bordered w-full" placeholder="Nama Obat" addAttributes="required"/>
                                        <div class="flex justify-between mt-2">
                                            <div>
                                                Jenis Bank
                                            </div>
                                            <div>
                                                {{ $bank->nama_bank }}
                                            </div>
                                        </div>
                                        <div class="flex justify-between mt-2">
                                            <div>
                                                No Rekening
                                            </div>
                                            <div>
                                                {{ $bank->no_rekening }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 justify-center">
                                        <x-select title="Pilih Jenis Pengambilan" id="pengambilan" wireModel='jenisPengambilan' :options="$jenisPengambilanOptions" wire:change='setBank()' inputClass="select select-bordered w-full" placeholder="Nama Obat" addAttributes="required"/>
                                    </div>
                                    <div class="mt-8 border-t-2 font-bold pt-2">
                                        <x-text type="file" title="Bukti Pembayaran" wireModel='imageUpload' inputClass="file-input file-input-bordered file-input-primary w-full font-normal" placeholder="Foto Obat" addAttributes="required"/>
                                    </div>
                                    <div class="flex justify-center mt-4">
                                        <button class="btn btn-info" wire:click='bayar({{ $item->id }})' {{ $imageUpload?'':'disabled' }}>Bayar</button>
                                    </div>
                                    @endif


                                </div>

                                </div>
                            </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
            $('#bank').on('change',function(){
                // var data = $('#bank').val();
                @this.setBank();
            })
        })
</script>




