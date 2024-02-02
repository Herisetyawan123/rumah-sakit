@section('title','Riwayat Tebus Obat')
@if (session()->has('alertMessage'))
    <div class="toast toast-end">
        <div class="alert alert-{{ session('alertType') }} bg-green-600 text-white">
          <div>
            <span> {{ session('alertMessage') }}</span>
          </div>
        </div>
      </div>
@endif


<div class="mt-10 mb-[5.1rem] flex flex-col justify-start items-center h-screen">
    <div class="title mb-12">
        <h1 class="text-3xl font-semibold text-blue-900">Riwayat Penebuasan Obat</h1>
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
                            <td class="text-center"><x-cms.status-pengambilan status='{{ $item->status_pengambilan }}' /></td>
                            <td><a href="#my-modal-2-{{ $item->id }}"  class="btn btn-info btn-sm rounded-full">Detail</a></td>
                        </tr>
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
                            }">
                                <div class="modal-box">

                                {{-- <label for="my-modal-2" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label> --}}
                                <div class="modal-action">
                                    <a href="#"  class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
                                </div>
                                <div x-ref="container">
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
                                    </div>
                                </div>
                                <div class="flex mt-4 justify-center">
                                    <span class="" x-on:click="printDiv()">
                                        <button class="btn btn-info"><i class="fa-solid fa-print mr-2"></i>Print</button>
                                    </span>
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




