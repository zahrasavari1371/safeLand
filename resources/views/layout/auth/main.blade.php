<!DOCTYPE html>
<html lang="en" dir="rtl" class="light">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.jpg')}}">
    <title>@yield('title')</title>

    <!-- Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/toastr.min.css')}}">
</head>

<body>
<!-- App Start-->
<div id="root">
    <!-- App Layout-->
    <div class="app-layout-blank flex flex-auto flex-col h-[100vh]">
        <main class="h-full">
            @yield('content')
        </main>

    </div>
</div>

<!-- Core Vendors JS -->
<script src="{{asset('assets/js/vendors.min.js')}}"></script>

<!-- Other Vendors JS -->

<!-- Page js -->

<!-- Core JS -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/forms.js')}}"></script>

@yield('scripts')
</body>

</html>
