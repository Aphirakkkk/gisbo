<!-- Scripts -->
<!-- Core -->
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
<!-- Optional JS -->
<script src="{{ asset('assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
<!-- JS -->
<script src="{{ asset('assets/backend/js/argon.js?v=1.2.1') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.vfs_fonts.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('assets/datepicker/jquery-ui.js') }}"></script>

<script>
    $(document).ready(function() {
        if ($('#DataTable').length) {
            $('#DataTable').DataTable({
                responsive: true
            });
        }
        if ($('.select2').length) {
            $('.select2').select2();
        }

        // Handle submenu expand / collapse
        $(document).on('click', '.navbar-vertical .navbar-nav a[data-toggle="collapse"]', function(e) {
            e.preventDefault();
            var targetId = $(this).attr('href');
            if (targetId && targetId.startsWith('#')) {
                var $target = $(targetId);
                if ($target.length) {
                    $target.toggleClass('show');
                    var isExpanded = $target.hasClass('show');
                    $(this).attr('aria-expanded', isExpanded ? 'true' : 'false');
                }
            }
        });
    });
</script>
<!-- summernote -->
<script type="text/javascript">
    $(document).ready(function() {
            $('.CreatedDetailTh').summernote({

                height: 200,
                fontNames: [
                'Anakotmai-Bold', 'Anakotmai-Light', 'Anakotmai-Medium',
                'Anuphan-Bold', 'Anuphan-ExtraLight','Anuphan-Medium',
                'Athiti-Bold','Athiti-ExtraLight','Athiti-Light','Athiti-Medium','Athiti-Regular','Athiti-SemiBold',
                'BalsamiqSans-Bold','BalsamiqSans-BoldItalic','BalsamiqSans-Italic','BalsamiqSans-Regular',
                'IstokWeb-Bold','IstokWeb-BoldItalic','IstokWeb-Italic','IstokWeb-Regular',
                'Kanit-Black','Kanit-BlackItalic','Kanit-Bold','Kanit-BoldItalic','Kanit-ExtraBold','Kanit-ExtraBoldItalic','Kanit-ExtraLight',
                'Kanit-ExtraLightItalic','Kanit-Italic','Kanit-Light','Kanit-LightItalic','Kanit-Medium','Kanit-MediumItalic','Kanit-Regular',
                'Kanit-SemiBold','Kanit-SemiBoldItalic','Kanit-Thin','Kanit-ThinItalic',
                'Mitr-Bold','Mitr-ExtraLight','Mitr-Light','Mitr-Medium','Mitr-Regular','Mitr-SemiBold',
                'Prompt-Black','Prompt-BlackItalic','Prompt-Bold','Prompt-BoldItalic','Prompt-ExtraBold','Prompt-ExtraBoldItalic','Prompt-ExtraLight',
                'Prompt-ExtraLightItalic','Prompt-Italic','Prompt-Light','Prompt-LightItalic','Prompt-Medium','Prompt-MediumItalic','Prompt-Regular',
                'Prompt-SemiBold','Prompt-SemiBoldItalic','Prompt-Thin','Prompt-ThinItalic',
                'PSL-Omyim','PSL-OmyimBold','PSL-OmyimBoldItalic','PSL-OmyimItalic',
                'RacingSansOne-Regular',
                'RobotoCondensed-Bold','RobotoCondensed-BoldItalic','RobotoCondensed-Italic','RobotoCondensed-Light','RobotoCondensed-LightItalic','RobotoCondensed-Regular',
                'Rubik-Black','Rubik-BlackItalic','Rubik-Bold','Rubik-BoldItalic','Rubik-ExtraBold','Rubik-ExtraBoldItalic','Rubik-Italic',
                'Rubik-Italic-VariableFont_wght','Rubik-Light','Rubik-LightItalic','Rubik-Medium','Rubik-MediumItalic','Rubik-Regular',
                'Rubik-SemiBold','Rubik-SemiBoldItalic','Rubik-VariableFont_wght','Shrikhand-Regular','Sriracha-Regular','VarelaRound-Regular'
                ],
                // fontsize: ['fontsize'],
                // styleTags: [
                // 'p',
                //     {
                //         title: 'Blockquote',
                //         tag: 'blockquote',
                //         className: 'blockquote',
                //         value: 'blockquote'
                //     },
                // 'pre', 'h2'
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
            });

        });

</script>
@include('sweetalert::alert')
@yield('javascript')
