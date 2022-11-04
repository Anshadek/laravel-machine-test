@include('layouts.function')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, noble ui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web, nobleuihtml">

    <title>{{ setTitle($page_name ?? '') }}</title>

    <!-- Styles -->
    @include('layouts.styles')
    @yield('styles')
</head>

<body>
    <div class="main-wrapper">
        {{-- sidebar --}}
        @include('layouts.sidebar')
        {{-- End sidebar --}}

        <div class="page-wrapper">
            {{-- header --}}
            @include('layouts.header')
            {{-- End header --}}

            <div class="page-content">
                {{-- content --}}
                @yield('content')
                {{-- End content --}}
            </div>
            {{-- footer --}}
            @include('layouts.footer')
            {{-- End footer --}}
        </div>
    </div>

    <!-- Scripts -->
    @include('layouts.scripts')
    @yield('scripts')

</body>

</html>
