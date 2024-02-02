<div x-init x-data="{ open: {{ isset($open) && $open ? 'true' : 'false' }}, working: false,
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
 }" x-cloak wire:key="delete-{{ $value }}">
    <span x-on:click="open = true">
        <button type="button" class="p-2 text-sky-600 hover:bg-sky-600 hover:text-white rounded">
            <i class="fa-solid fa-print"></i> Print
        </button>
    </span>

    <div x-show="open"
        class="fixed z-50 bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div x-show="open" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative bg-gray-100 rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6">
            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                {{-- <button @click="open = false" type="button"
                    class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button> --}}
            </div>
            <div class="w-full"  x-ref="container". style="display: hidden">
                {{-- ['value' => $id,'no_pesanan'=>$no_pesanan,
    'pasien'=>$pasien,
    'dokter'=>$dokter,
    'tanggal_pesanan'=>$tanggal_pesanan,
    'bank'=>$bank,
    'no_rekening'=>$no_rekening] --}}
                <div class="p-6">
                    <div class="flex justify-between items-center pb-9 border-b-2">
                        <div class="font-bold text-xl">
                            Nota Pembayaran
                        </div>
                        <div>
                            {{ $no_pesanan }}
                        </div>
                    </div>
                    {{-- <div class="divider"></div> --}}
                    <div class="p-4 border-b-2">
                        <div class="font-semibold mb-6">Ringkasan Pemesanan</div>
                        <div class="flex justify-between items-center mb-3">
                            <div class="font-bold">
                                Nama Pasien
                            </div>
                            <div>
                                {{ $pasien }}
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <div class="font-bold">
                                Nama Dokter
                            </div>
                            <div>
                                {{ $dokter }}
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <div class="">
                                Tanggal Pemesanan
                            </div>
                            <div>
                                {{ $tanggal_pesanan }}
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-3 pt-9 border-t-2">
                            <div class="">
                                Total Biaya
                            </div>
                            <div>
                                @currency($tarif)
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-3 pt-9 border-t-2">
                            <div class="">
                                Metode Pembayaran:
                            </div>
                            <div>
                                {{ $bank }} | {{ $no_rekening }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="flex justify-center gap-2">

                <span class="" x-on:click="printDiv()">
                    <button class="btn btn-info"><i class="fa-solid fa-print mr-2"></i>Print</button>
                </span>
                <button @click="open = false" type="button"
                        class="btn btn-danger">cancel
                </button>
            </div>
        </div>
    </div>
</div>
