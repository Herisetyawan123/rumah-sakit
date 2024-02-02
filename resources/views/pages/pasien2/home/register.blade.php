@extends('layouts.layout_user')
@section('title','Beranda')
@section('content')
@auth('pasien')
<div class="mt-5 flex flex-col items-center h-screen" style="background-image: url('{{asset('/home/img/logo rsia.png')}}');background-size: contain;background-repeat: no-repeat;background-position: center;">
    <!-- <div class="title mb-12">
        <h1 class="text-3xl font-semibold text-blue-900 text-center">Selamat Datang di layanan daring <br> RSIA Muhammadiyah Kota Probolinggo</h1>
    </div> -->
    <div class="grid grid-cols-3 gap-10 w-full px-44 mt-32">
        <a href="#my-modal-obat" class="block bg-white py-20 shadow-2xl hover:scale-110 duration-500 transition-all" style="cursor: pointer;">
            <div class="px-5">
                <div>
                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M25.007 31.6761C28.69 31.6761 31.6756 28.6905 31.6756 25.0075C31.6756 21.3245 28.69 18.3389 25.007 18.3389C21.324 18.3389 18.3384 21.3245 18.3384 25.0075C18.3384 28.6905 21.324 31.6761 25.007 31.6761Z" fill="#3B45A1" />
                        <path d="M18.7556 4.16797L14.942 8.33586H8.33586C6.04352 8.33586 4.16797 10.2114 4.16797 12.5038V37.5111C4.16797 39.8035 6.04352 41.679 8.33586 41.679H41.679C43.9714 41.679 45.8469 39.8035 45.8469 37.5111V12.5038C45.8469 10.2114 43.9714 8.33586 41.679 8.33586H35.0729L31.2593 4.16797H18.7556ZM25.0074 35.4272C19.2557 35.4272 14.5877 30.7591 14.5877 25.0074C14.5877 19.2557 19.2557 14.5877 25.0074 14.5877C30.7591 14.5877 35.4272 19.2557 35.4272 25.0074C35.4272 30.7591 30.7591 35.4272 25.0074 35.4272Z" fill="#3B45A1" />
                    </svg>
                </div>
                <h1 class=" text-[#3B45A1] font-semibold text-xl">
                    Tebus Obat
                </h1>
            </div>
            <div class="border w-full my-5"></div>
            <div class="px-5">
                <p class="text-[15px] font-[400]">Foto resep Anda untuk dapatkan Obat</p>
            </div>
        </a>
        <a href="/pasien/transaksi" class="block bg-white py-20 shadow-2xl hover:scale-110 duration-500 transition-all" style="cursor: pointer;">
            <div class="px-5">
                <div>

                    <svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M33.0438 27.625C34.6375 27.625 36.04 26.7537 36.7625 25.4363L44.37 11.645C45.1562 10.2425 44.1362 8.5 42.5213 8.5H11.0712L9.07375 4.25H2.125V8.5H6.375L14.025 24.6287L11.1562 29.8137C9.605 32.6612 11.645 36.125 14.875 36.125H40.375V31.875H14.875L17.2125 27.625H33.0438ZM13.09 12.75H38.9087L33.0438 23.375H18.1262L13.09 12.75ZM14.875 38.25C12.5375 38.25 10.6463 40.1625 10.6463 42.5C10.6463 44.8375 12.5375 46.75 14.875 46.75C17.2125 46.75 19.125 44.8375 19.125 42.5C19.125 40.1625 17.2125 38.25 14.875 38.25ZM36.125 38.25C33.7875 38.25 31.8962 40.1625 31.8962 42.5C31.8962 44.8375 33.7875 46.75 36.125 46.75C38.4625 46.75 40.375 44.8375 40.375 42.5C40.375 40.1625 38.4625 38.25 36.125 38.25Z" fill="#3B45A1" />
                    </svg>

                </div>
                <h1 class=" text-[#3B45A1] font-semibold text-xl">
                    Transaksi
                </h1>
            </div>
            <div class="border w-full my-5"></div>
            <div class="px-5">
                <p class="text-[15px] font-[400]">Status Transaksi</p>
            </div>
        </a>
        <a href="#" class="block bg-white py-20 shadow-2xl hover:scale-110 duration-500 transition-all" style="cursor: pointer;">
            <div class="px-5">
                <div>

                    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M41.6665 8.33325H8.33317C6.0415 8.33325 4.18734 10.2083 4.18734 12.4999L4.1665 37.4999C4.1665 39.7916 6.0415 41.6666 8.33317 41.6666H41.6665C43.9582 41.6666 45.8332 39.7916 45.8332 37.4999V12.4999C45.8332 10.2083 43.9582 8.33325 41.6665 8.33325ZM40.8332 17.1874L26.104 26.3958C25.4373 26.8124 24.5623 26.8124 23.8957 26.3958L9.1665 17.1874C8.64567 16.8541 8.33317 16.2916 8.33317 15.6874C8.33317 14.2916 9.854 13.4583 11.0415 14.1874L24.9998 22.9166L38.9582 14.1874C40.1457 13.4583 41.6665 14.2916 41.6665 15.6874C41.6665 16.2916 41.354 16.8541 40.8332 17.1874Z" fill="#3B45A1" />
                    </svg>

                </div>
                <h1 class=" text-[#3B45A1] font-semibold text-xl">
                    Chat Dokter & Apoteker
                </h1>
            </div>
            <div class="border w-full my-5"></div>
            <div class="px-5">
                <p class="text-[15px] font-[400]">Konsultasi keluhan & obat dengan tim kami</p>
            </div>
        </a>
    </div>

    <!-- 
    <div class="card-service flex gap-10">
        <a href="{{ route('pasien.konsultasi.index') }}">
            <div class="card w-96 bg-base-100 shadow-xl">
                <figure class="px-5 pt-5">
                    <img src="{{ asset("home/img/e-konsul.jpg") }}" alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-start text-center">
                    <h2 class="card-title">E-Konsultasi</h2>
                </div>
            </div>
        </a>

        <a href="{{ route('pasien.pesan-obat.index') }}">
            <div class="card w-96 bg-base-100 shadow-xl">
                <figure class="px-5 pt-5">
                    <img src="{{ asset("home/img/e-obat.jpg") }}" alt="Shoes" class="rounded-xl" />
                </figure>
                <div class="card-body items-start text-center">
                    <h2 class="card-title">E-Obat</h2>
                </div>
            </div>
        </a>
    </div> -->
</div>
@else
<div class="min-h-screen mb-10" style="background-image: url(/home/img/background.png); background-position: 0 -20px;">
    <div class="flex justify-between w-full px-20 gap-5">
        <div class="w-[40%] mt-20 hidden sm:block">
            <h1 class="text-2xl text-blue-900 font-semibold">
                SELAMAT DATANG <br>
                DI SISTEM PENEBUSAN OBAT <br>
                RSIA MUHAMMADIYAH KOTA PROBOLINGGO
            </h1>
        </div>
        <div class="w-full sm:w-[60%] flex justify-end mt-20">
            <div class="bg-white p-5 shadow w-full">
                <div class="card-header text-center">
                    <h1 class="text-[25px]">
                        Login
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('register.pasien') }}" method="POST" class="flex flex-col justify-center h-full">
                        @csrf
                  
                        <div class="flex flex-col mb-5">
                            <label for="Nama">
                                Nama
                            </label>
                            <input type="text" name="name" class="border-none shadow-md mt-3">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="Email">
                                Email
                            </label>
                            <input type="text" name="email" class="border-none shadow-md mt-3">
                        </div>
                        <div class="flex flex-col mb-5">
                            <label for="password">
                                password
                            </label>
                            <input type="password" name="password" class="border-none shadow-md mt-3">
                        </div>
                        <div class="flex flex-col sm:flex-row mb-5 gap-1 w-full flex-wrap">
                            <div class="flex flex-col flex-1">
                                <label for="Nomor telephone">
                                    Nomor telephone
                                </label>
                                <input type="text" name="no_telepon" class="border-none shadow-md mt-3 w-full">
                            </div>
                            <div class="flex flex-col flex-1">
                                <label for="Nik">
                                    Nik
                                </label>
                                <input type="text" name="nik" class="border-none shadow-md mt-3 w-full">
                            </div>
                        </div>

                        <div class="flex flex-col mb-5">
                            <label for="Alamat">
                                Alamat
                            </label>
                            <textarea class="border-none shadow-md mt-3" name="alamat"></textarea>
                        </div>

                        <div class="flex mb-5 gap-5 w-full flex-col sm:flex-row ">
                            <div class="flex flex-col flex-1">
                                <label for="tanggal lahir">
                                    tanggal lahir
                                </label>
                                <input type="date" name="tanggal_lahir" class="border-none shadow-md mt-3 w-full">
                            </div>
                            <div class="flex flex-col flex-1">
                                <label for="Nik">
                                    Jenis kelamin
                                </label>
                                <div class="flex h-full items-start sm:items-center gap-5 flex-col sm:flex-row">
                                    <label class="flex justify-center items-center gap-2">
                                        <input type="radio" name="jenis_kelamin" value="L" class="border-none shadow-md">
                                        <p>
                                            Laki Laki
                                        </p>
                                    </label>

                                    <label class="flex justify-center items-center gap-2">
                                        <input type="radio" name="jenis_kelamin" value="P" class="border-none shadow-md">
                                        <p>
                                            Perempuan
                                        </p>
                                    </label>

                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Daftar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection