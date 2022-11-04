<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet">
<!-- End fonts -->

<!-- core:css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
<!-- endinject -->

<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<!-- End plugin css for this page -->

<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">

<!-- inject:css -->
<link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
<!-- endinject -->


<link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
<!-- Layout styles -->
@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.min.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
@endif

<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">



<!-- End layout styles -->

<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
