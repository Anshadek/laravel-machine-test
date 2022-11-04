<!-- core:js -->
<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- Alert Dialog -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Plugin js for this page -->
<script src="{{ asset('assets/js/chartjs-light.js') }}"></script>
<script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{ asset('assets/js/dashboard-light.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
<!-- End custom js for this page -->

<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>

<script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

<!-- End plugin js for this page -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>
    @if (Session::has('success_message'))
        toastr.options =
        {
        "closeButton" : true,
        }
        toastr.success("{{ session('success_message') }}");
    @endif

    @if (Session::has('warning_message'))
        toastr.options =
        {
        "closeButton" : true,
        }
        toastr.warning("{{ session('warning_message') }}");
    @endif

    @if (Session::has('info_message'))
        toastr.options =
        {
        "closeButton" : true,
        }
        toastr.info("{{ session('info_message') }}");
    @endif

    @if (Session::has('error_message'))
        toastr.options =
        {
        "closeButton" : true,
        }
        toastr.error("{{ session('error_message') }}");
    @endif
</script>
