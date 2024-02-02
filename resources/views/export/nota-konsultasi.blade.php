<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    @vite('resources/css/app.css')


    <!-- Font -->
    <script src="https://kit.fontawesome.com/d79b975262.js" crossorigin="anonymous" defer></script>
    {{-- Alpine JS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body{
            font-family: "Arial"
        }
    </style>
</head>

<body x-init="()" x-data="{
    printDiv() {
        var printContents = this.$refs.container.innerHTML;
        var originalContents = document.body.innerHTML;
        window.onbeforeprint = function(){
            document.body.innerHTML = printContents;

        }
        window.print();
        window.onafterprint = function(){
            document.body.innerHTML = originalContents;
         }
    }
}"
x-cloak
>
    <div class="" x-ref="container" style="display: hidden">
        <div class="p-6">
            <div class="flex justify-between items-center pb-9 border-b-2">
                <div class="font-bold text-xl">
                    Nota Pembayaran
                </div>
                <div>
                    Kt313131312
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
                        Zaidan
                    </div>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <div class="font-bold">
                        Nama Dokter
                    </div>
                    <div>
                        Jihan
                    </div>
                </div>
                <div class="flex justify-between items-center mb-3">
                    <div class="">
                        Tanggal Pemesanan
                    </div>
                    <div>
                        04 Januari 2024
                    </div>
                </div>
                <div class="flex justify-between items-center mb-3 pt-9 border-t-2">
                    <div class="">
                        Total Biaya
                    </div>
                    <div>
                        Rp 80.000
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- <button x-on:click='printDiv()' >print</button> --}}

</body>

</html>
