<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')

    {{-- fontawsome --}}
    <script src="https://kit.fontawesome.com/d79b975262.js" crossorigin="anonymous"></script>


    @livewireStyles

    <script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('style')
</head>

<body class="font-poppins">
    {{-- Navbar --}}
    @include('components.home.navbar')

    {{-- Main --}}
    @yield('content')

    <div class="toast right-6 bottom-7 rounded-full border-2 bg-white">
        <a href="https://wa.me/081259736329" target="_blank"><i class="fa-solid fa-comment text-3xl text-slate-400 "></i></a>
    </div>
    {{-- Footer --}}
    @include('components.home.footer')



    @livewireScripts

    <script>
        function scrollBottom() {
            var scrollingContainer = $(".box-container");
            // console.log(scrollingContainer[0].scrollHeight)
            scrollingContainer.scrollTop(scrollingContainer.height());
        }
        window.addEventListener('DOMContentLoaded', ()=>{
            scrollBottom()
        })
    </script>
</body>

</html>