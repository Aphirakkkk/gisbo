<!-- Argon Scripts -->
<!-- Core -->
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
<!-- JS -->
<script src="{{ asset('assets/backend/js/argon.js?v=1.2.0') }}"></script>

<script>
    $('#DataTable').DataTable( {
        "pageLength": 10,
        responsive: true
    } );
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        });
</script>
<!-- summernote -->
<script type="text/javascript">
    $(document).ready(function() {
            $('.CreatedDetailTh').summernote({
                focus: true,
                placeholder: 'กรอกรายละเอียด',
                tabsize: 2,
                height: 200
            });

        });
</script>
@include('sweetalert::alert')
@yield('javascript')
