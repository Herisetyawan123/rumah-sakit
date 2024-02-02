@section('title','Riwayat Konsultasi')
<div class="mt-10 mb-[5.1rem] flex flex-col justify-start items-center h-screen">
    <div x-data="{ show: true }" x-show="show" x-ref="alert" x-init="setTimeout(() => $refs.alert.remove(), 3000)">
                @if (session()->has('alertMessage'))
                <div class="toast toast-end" >
                    <div class="alert alert-{{ session('alertType') }} bg-green-600 text-white">
                        <div>
                            <span> {{ session('alertMessage') }}</span>
                        </div>
                    </div>
                </div>
                @endif
    </div>
    <div class="title mb-12">
        <h1 class="text-3xl font-semibold text-blue-900">Riwayat Konsultasi</h1>
    </div>

    <div class="tebus flex justify-center">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Dokter</th>
                    <th>Tanggal Konsultasi</th>
                    <th>Tarif Konsultasi</th>
                    <th>Bank</th>
                    <th>Status Pembayaran</th>
                    <th>Status Konsultasi</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <!-- row 1 -->
                @foreach ($listRiwayatKonsul as $item)
                    <tr class="bg-base-200">
                        <td>{{ $item->no_pesanan }}</td>
                        <td>Dr. {{ $item->dokter->nama }}</td>
                        <td> {{ $this->getTanggal($item->tanggal_pesanan) }}</td>
                        <td>@currency($item->tarif)</td>
                        <td>{{ $item->bank->nama_bank }} | {{ $item->bank->no_rekening }}</td>
                        <td><x-cms.status-pembayaran status='{{ $item->status_pembayaran }}' /></td>
                        <td><x-cms.status-konsultasi status='{{ $item->status_konsultasi }}' /></td>
                        <td>
                            @if ($item->status_pembayaran != 'lunas')
                                <a href="#my-modal-2-{{ $item->id }}" class="btn btn-info">Bayar</a>
                            @else
                                <a href="#my-modal-2-{{ $item->id }}" class="btn btn-info">Detail</a>
                            @endif
                        </td>
                        <!-- Put this part before </body> tag -->
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
                        }" >

                        <div class="modal-box" >
                                <div class="modal-action">
                                    <a href="#"  class="btn btn-sm btn-circle btn-error btn-outline absolute right-2 top-2">✕</a>
                                </div >
                                    <div x-ref="container">
                                        <h3 class="font-bold text-lg">Riwayat Konsultasi</h3>
                                    <div class="flex justify-between mt-6">
                                        <div>
                                            Kode Transaksi
                                        </div>
                                        <div>
                                            {{ $item->no_pesanan }}
                                        </div>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <div>
                                            Tanggal Pemesanan
                                        </div>
                                        <div>
                                            {{ $this->getTanggal($item->tanggal_pesanan) }}
                                        </div>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <div>
                                            Tarif
                                        </div>
                                        <div>
                                            @currency($item->tarif)
                                        </div>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <div>
                                            Metode Pembayaran
                                        </div>
                                        <div>
                                            {{ $item->bank->nama_bank }} | {{ $item->bank->no_rekening }}
                                        </div>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        <div>
                                            Status Pembayaran
                                        </div>
                                        <div>
                                            <x-cms.status-pembayaran status='{{ $item->status_pembayaran }}' />
                                        </div>
                                    </div>
                                    @if ($item->status_pembayaran != 'lunas' && $item->status_pembayaran != 'menunggu konfirmasi')
                                        <div class="mt-4">
                                            <x-text type="file" labelClass="font-bold" title="Bukti Pembayaran" wireModel='imageUpload' inputClass="file-input file-input-bordered file-input-primary w-full font-normal" placeholder="Foto Obat" addAttributes="required"/>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex justify-center">
                                    @if ($item->status_pembayaran != 'lunas' && $item->status_pembayaran != 'menunggu konfirmasi')
                                        <button class="btn btn-primary" {{ $imageUpload?'':'disabled' }} wire:click="bayar({{ $item->id }})">Bayar</button>
                                    @elseif ($item->status_pembayaran == 'lunas')
                                        <button class="btn btn-info mr-4" x-on:click="printDiv()"><i class="fa-solid fa-print mr-2"></i>Print</button>
                                        <a class="btn btn-success" target="_blank" href="https://wa.me/{{ $item->dokter->no_telepon }}">Chat Sekarang</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
