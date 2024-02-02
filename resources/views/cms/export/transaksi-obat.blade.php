<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SI Penebusan Obat - @yield('title')</title>
    @vite('resources/css/app.css')

    {{-- Tailwind --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    {{-- fontawsome --}}
    <script src="https://kit.fontawesome.com/d79b975262.js" crossorigin="anonymous"></script>

    <style>
        .nav-item .collapse{
            visibility: visible;
        }
    </style>

    @livewireStyles
    {{-- Alpine JS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-init="window.print();">
    <style>
        [x-cloak] { display: none !important; }
    </style>
<div>
    <center class="my-12 font-bold text-xl">
        Daftar Transaksi Obat
    </center>
</div>
<table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3">
                ID
            </th>
            <th scope="col" class="px-6 py-3">
                Kode Transaksi
            </th>
            <th scope="col" class="px-6 py-3">
                Tanggal Pemesanan
            </th>
            <th scope="col" class="px-6 py-3">
                Pasien
            </th>
            <th scope="col" class="px-6 py-3">
                Status Pembayatan
            </th>
            <th scope="col" class="px-6 py-3">
                Status Pengambilan
            </th>
            <th scope="col" class="px-6 py-3">
                Total Biaya
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksiObat as $item)
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4">
                    {{ $item->id }}
                </th>
                <td class="px-6 py-4">
                    {{ $item->kode_transaksi }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->tanggal_pemesanan }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->pasien->nama }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->status_pembayaran }}
                </td>
                <td class="px-6 py-4">
                    {{ $item->status_pengambilan }}
                </td>
                <td class="px-6 py-4">
                    {{ 'Rp. '.number_format($item->harga_saat_ini,0,',','.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


    @livewireScripts
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('after-script')
    @yield('component-script')
</body>

</html>

