<div class="navbar text-[#3B45A1] bg-white py-5 px-3">
    <div class="navbar-start">
        <a href="{{ route('pasien.home.index') }}" class="btn btn-ghost normal-case text-xl gap-5">
            <img class="w-10" src="{{ asset('home/img/logo rsia.png') }}" alt="">
            <h3 class="text-start text-sm sm:text-md">
                SISTEM PENEBUSAN OBAT
                <br>
                RSIA MUHAMMADIYAH
            </h3>
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a class="text-[25px]" href="{{ route('pasien.home.index') }}">Beranda</a></li>
            @auth('pasien')

            <!-- <li>
                <details class="dropdown">
                    <summary class="m-1">Obat</summary>
                    <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52 text-black">
                        <li><a href="{{ route("pasien.pesan-obat.index") }}" class="w-full">Pesan Obat</a></li>
                        <li><a href="{{ route("pasien.tebus-obat.index") }}" class="w-full">Tebus Obat</a></li>
                        <li><a href="{{ route("pasien.riwayat-obat.index") }}" class="w-full">Riwayat Tebus</a></li>
                    </ul>
                </details>
            </li>
            <li>
                <details class="dropdown">
                    <summary class="m-1">Konsultasi</summary>
                    <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52 text-black">
                        <li><a href="{{ route("pasien.konsultasi.index") }}" class="w-full">List Konsultasi</a></li>
                        <li><a href="{{ route("pasien.riwayat-konsultasi.index") }}" class="w-full">Riwayat Konsultasi</a></li>
                    </ul>
                </details>
            </li> -->
            <li>
                <a href="/pasien/pelayanan">
                    Pelayanan
                </a>
            </li>
            <li>
                <a href="/pasien/riwayat">
                    Riwayat
                </a>
            </li>
            @endauth
        </ul>
    </div>
    <div class="navbar-end">
        @auth('pasien')
        <x-notif />
        @endauth
        {{-- <a class="btn btn-info btn-sm rounded-3xl">Masuk</a> --}}
        <!-- The button to open modal -->
        @if ((Auth::guard('pasien')->user()))
        <div class="dropdown dropdown-end text-black">
            <label tabindex="0" class="m-1">
                <div class="avatar">
                    <div class="w-10 rounded-full ring ring-white ring-offset-base-100 ring-offset-2">
                        <img src="{{ asset('home/img/user.png') }}" />
                    </div>
                </div>
            </label>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">

                <li>
                    <form action="{{route('logout-pasien')}}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @else


        <!-- <label for="login-modal" class="btn btn-info btn-sm rounded-3xl">Masuk</label> -->
        @endif
    </div>
</div>


<!-- Put this part before </body> tag -->
<input type="checkbox" id="login-modal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box bg-opacity-50 bg-slate-600 ">
        <label for="login-modal" class="btn btn-sm btn-circle btn-error btn-outline absolute right-2 top-2">✕</label>
        <h3 class="font-bold text-center text-xl text-white">LOGIN</h3>
        <form class="w-full flex flex-col gap-y-7 py-4  items-center" method="POST" action="{{ route('login-pasien') }}">
            @csrf
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text text-white uppercase font-semibold">Nomor Rekam Medis</span>
                </label>
                <input placeholder="Nomor Rekam Medis" name="no_rm" class="input input-bordered w-full" required autofocus autocomplete="no_rm" />
                <x-input-error :messages="$errors->get('no_rm')" class="mt-2" />
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text text-white uppercase font-semibold">NIK</span>
                </label>
                <input placeholder="NIK" class="input input-bordered w-full" name="nik" required autocomplete="nik" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>
            <button type="submit" class="btn btn-primary w-1/2">LOGIN</button>
        </form>
    </div>
</div>