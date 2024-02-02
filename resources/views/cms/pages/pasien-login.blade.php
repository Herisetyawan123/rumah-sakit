<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SI Penebusan Obat</title>

    <!-- Tailwind -->
    {{-- <link rel="stylesheet" href="./css/tailwind.css">
    <link rel="stylesheet" href="./css/style.css"> --}}
    @vite('resources/css/app.css')

    <!-- Font -->
    <script src="https://kit.fontawesome.com/d79b975262.js" crossorigin="anonymous" defer></script>
    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="flex h-full items-center" style="height: 100vh;">
        <div class="container flex flex-col items-center justify-center h-full bg px-6" style="background-color: hsl(29, 100%, 68%);background-image: url({{ asset('cms/images/BG.png') }});background-repeat: no-repeat;background-size: cover;background-position: center">
            <!-- <img class="h-full object-fill" src="puskesmas-gedongan-bakal-dipindah-ke-sawunggaling_m_231088.jpg" alt=""> -->
            <img class="h-1/2 w-fit mb-20" src="{{ asset('cms/images/Medical prescription-amico.svg') }}" alt="">
            <div class="font-bold text-4xl text-center items-center text-white">
                SISTEM INFORMASI PENEBUSAN OBAT
            </div>
        </div>
        <div class="container  px-24">
            <form class="w-full flex flex-col gap-y-7  items-center" method="POST" action="{{ route('login-pasien') }}">
                @csrf
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text uppercase font-semibold">Nomor Rekam Medis</span>
                    </label>
                    <input placeholder="Nomor Rekam Medis" name="no_rm" class="input input-bordered w-full" required autofocus autocomplete="no_rm" />
                    <x-input-error :messages="$errors->get('no_rm')" class="mt-2" />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text uppercase font-semibold">NIK</span>
                    </label>
                    <input placeholder="NIK" class="input input-bordered w-full" name="nik"
                    required autocomplete="nik"/>
                    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                    {{-- <label class="label">
                        <span class="label-text-alt text-base">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300  text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </span>
                        <span class="label-text-alt text-base"><a href="{{ route('password.request') }}">Lupa password?</a></span>
                    </label> --}}
                </div>
                <button type="submit" class="btn btn-primary w-1/2">LOGIN</button>
            </form>
        </div>
    </div>

</body>

</html>
