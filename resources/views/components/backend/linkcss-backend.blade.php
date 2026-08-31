<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GIS GROUP :: backend Admin {{ $titlePage ?? '' }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/frontend/img/logo.png') }}" type="image/png">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    {{-- Thailand --}}
    <link rel="stylesheet" href="{{ asset('assets/jquery.Thailand.js/dist/jquery.Thailand.min.css') }}">
    <!--  CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/argon.css?v=1.2.0') }}" type="text/css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/datepicker/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/font.css') }}">
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
    @yield('css')
    <style>
        .carddetail {
            margin-top: 5rem;
        }

        li.paginate_button.page-item.active {
            margin-left: 0px;
            padding: 0em;
        }

        li#example_previous {
            margin-left: 0px;
            padding: 0em;
        }

        li#example_next {
            margin-left: 0px;
            padding: 0em;
        }


        .table thead th {
            font-size: 0.8rem;
            padding-top: .75rem;
            padding-bottom: .75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-bottom: 1px solid #e9ecef;
        }

        .imgBanner {
            width: 20%;
            height: auto;
        }

        .card-title {
            margin-bottom: 0rem;
        }

        .TilteInput {
            font-size: 90%;
        }

        .TilteInputBackend {
            margin: auto;
            font-size: 90%;
            margin-bottom: 5px;
        }

        .TilteInputend {
            margin: auto;
            text-align: end;
            font-size: 90%;
        }

        h4.flex-column {
            padding-inline-start: 40px;
        }

        .marginSupport {
            margin-bottom: 1rem;
            margin-top: 1rem;
        }

        .showDetail {
            color: black;
        }

        div#myTabContent {
            margin-top: 2%;
        }

        .blah {
            margin-bottom: 2%;
        }



        div.dataTables_wrapper div.dataTables_length select {
            width: 50px;
            display: inline-block;
        }

        .cardboby {
            margin-top: 5rem;
        }

        .invalid-feedback {
            font-size: 80%;
            display: none;
            width: 100%;
            margin-top: .25rem;
            color: #f50b0b;
        }

        .was-validated .form-control:invalid,
        .form-control.is-invalid,
        .was-validated .custom-select:invalid,
        .custom-select.is-invalid {
            border-color: #f50b0b;
        }

        .form-control {
            font-size: 85%;
        }

        span.select2-selection.select2-selection--single {
            font-size: 90%;
        }

        .navbar-maintop {
            background: #f8f9fe;
            padding: 5px 30px;
        }

        .bg-white {
            background-color: #f8f9fe !important;
        }

        .sidenav-header {
            height: auto;
            background: #33618a;
        }

        .bg-teal {
            background-color: #114775d9 !important;
        }

        span.nav-link-text:hover {
            color: #F0D042;
        }

        .note-dropdown-menu.dropdown-menu.note-check.dropdown-fontname.show {
            overflow: scroll;
            height: 200px;
        }

        @font-face {
            font-family: WorkSans-Medium;
            src: url(/assets/font/WorkSans-Medium.ttf) format("truetype");
        }

        @font-face {
            font-family: Anakotmai-Bold;
            src: url(/FontWeb/Anakotmai-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: Anakotmai-Light;
            src: url(/FontWeb/Anakotmai-Light.ttf) format("truetype");
        }

        @font-face {
            font-family: Anakotmai-Medium;
            src: url(/FontWeb/Anakotmai-Medium.ttf) format("truetype");
        }

        @font-face {
            font-family: Anuphan-Bold;
            src: url(/FontWeb/Anuphan-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: Anuphan-ExtraLight;
            src: url(/FontWeb/Anuphan-ExtraLight.ttf) format("truetype");
        }

        @font-face {
            font-family: Anuphan-Medium;
            src: url(/FontWeb/Anuphan-Medium.ttf) format("truetype");
        }

        @font-face {
            font-family: Athiti-Bold;
            src: url(/FontWeb/Athiti-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: Athiti-ExtraLight;
            src: url(/FontWeb/Athiti-ExtraLight.ttf) format("truetype");
        }

        @font-face {
            font-family: Athiti-Light;
            src: url(/FontWeb/Athiti-Light.ttf) format("truetype");
        }

        @font-face {
            font-family: Athiti-Medium;
            src: url(/FontWeb/Athiti-Medium.ttf) format("truetype");
        }

        @font-face {
            font-family: Athiti-Regular;
            src: url(/FontWeb/Athiti-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: Athiti-SemiBold;
            src: url(/FontWeb/Athiti-SemiBold.ttf) format("truetype");
        }

        @font-face {
            font-family: BalsamiqSans-Bold;
            src: url(/FontWeb/BalsamiqSans-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: BalsamiqSans-BoldItalic;
            src: url(/FontWeb/BalsamiqSans-BoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: BalsamiqSans-Italic;
            src: url(/FontWeb/BalsamiqSans-Italic.ttf) format("truetype");
        }

        @font-face {
            font-family: BalsamiqSans-Regular;
            src: url(/FontWeb/BalsamiqSans-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: IstokWeb-Bold;
            src: url(/FontWeb/IstokWeb-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: IstokWeb-BoldItalic;
            src: url(/FontWeb/IstokWeb-BoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: IstokWeb-Italic;
            src: url(/FontWeb/IstokWeb-Italic.ttf) format("truetype");
        }

        @font-face {
            font-family: IstokWeb-Regular;
            src: url(/FontWeb/IstokWeb-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-Black;
            src: url(/FontWeb/Kanit-Black.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-BlackItalic;
            src: url(/FontWeb/Kanit-BlackItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-Bold;
            src: url(/FontWeb/Kanit-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-BoldItalic;
            src: url(/FontWeb/Kanit-BoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-ExtraBold;
            src: url(/FontWeb/Kanit-ExtraBold.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-ExtraBoldItalic;
            src: url(/FontWeb/Kanit-ExtraBoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-ExtraLight;
            src: url(/FontWeb/Kanit-ExtraLight.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-ExtraLightItalic;
            src: url(/FontWeb/Kanit-ExtraLightItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-Italic;
            src: url(/FontWeb/Kanit-Italic.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-Light;
            src: url(/FontWeb/Kanit-Light.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-LightItalic;
            src: url(/FontWeb/Kanit-LightItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-Medium;
            src: url(/FontWeb/Kanit-Medium.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-MediumItalic;
            src: url(/FontWeb/Kanit-MediumItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-Regular;
            src: url(/FontWeb/Kanit-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-SemiBold;
            src: url(/FontWeb/Kanit-SemiBold.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-SemiBoldItalic;
            src: url(/FontWeb/Kanit-SemiBoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-Thin;
            src: url(/FontWeb/Kanit-Thin.ttf) format("truetype");
        }

        @font-face {
            font-family: Kanit-ThinItalic;
            src: url(/FontWeb/Kanit-ThinItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Mitr-Bold;
            src: url(/FontWeb/Mitr-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: Mitr-ExtraLight;
            src: url(/FontWeb/Mitr-ExtraLight.ttf) format("truetype");
        }

        @font-face {
            font-family: Mitr-Light;
            src: url(/FontWeb/Mitr-Light.ttf) format("truetype");
        }

        @font-face {
            font-family: Mitr-Medium;
            src: url(/FontWeb/Mitr-Medium.ttf) format("truetype");
        }

        @font-face {
            font-family: Mitr-Regular;
            src: url(/FontWeb/Mitr-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: Mitr-SemiBold;
            src: url(/FontWeb/Mitr-SemiBold.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-Black;
            src: url(/FontWeb/Prompt-Black.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-BlackItalic;
            src: url(/FontWeb/Prompt-BlackItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-Bold;
            src: url(/FontWeb/Prompt-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-BoldItalic;
            src: url(/FontWeb/Prompt-BoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-ExtraBold;
            src: url(/FontWeb/Prompt-ExtraBold.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-ExtraBoldItalic;
            src: url(/FontWeb/Prompt-ExtraBoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-ExtraLight;
            src: url(/FontWeb/Prompt-ExtraLight.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-ExtraLightItalic;
            src: url(/FontWeb/Prompt-ExtraLightItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-Italic;
            src: url(/FontWeb/Prompt-Italic.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-Light;
            src: url(/FontWeb/Prompt-Light.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-LightItalic;
            src: url(/FontWeb/Prompt-LightItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-Medium;
            src: url(/FontWeb/Prompt-Medium.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-MediumItalic;
            src: url(/FontWeb/Prompt-MediumItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-Regular;
            src: url(/FontWeb/Prompt-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-SemiBold;
            src: url(/FontWeb/Prompt-SemiBold.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-SemiBoldItalic;
            src: url(/FontWeb/Prompt-SemiBoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-Thin;
            src: url(/FontWeb/Prompt-Thin.ttf) format("truetype");
        }

        @font-face {
            font-family: Prompt-ThinItalic;
            src: url(/FontWeb/Prompt-ThinItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: PSL-Omyim;
            src: url(/FontWeb/PSL-Omyim.ttf) format("truetype");
        }

        @font-face {
            font-family: PSL-OmyimBold;
            src: url(/FontWeb/PSL-OmyimBold.ttf) format("truetype");
        }

        @font-face {
            font-family: PSL-OmyimBoldItalic;
            src: url(/FontWeb/PSL-OmyimBoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: PSL-OmyimItalic;
            src: url(/FontWeb/PSL-OmyimItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: RacingSansOne-Regular;
            src: url(/FontWeb/RacingSansOne-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: RobotoCondensed-Bold;
            src: url(/FontWeb/RobotoCondensed-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: RobotoCondensed-Light;
            src: url(/FontWeb/RobotoCondensed-Light.ttf) format("truetype");
        }

        @font-face {
            font-family: RobotoCondensed-BoldItalic;
            src: url(/FontWeb/RobotoCondensed-BoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: RobotoCondensed-Italic;
            src: url(/FontWeb/RobotoCondensed-Italic.ttf) format("truetype");
        }

        @font-face {
            font-family: RobotoCondensed-LightItalic;
            src: url(/FontWeb/RobotoCondensed-LightItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: RobotoCondensed-Regular;
            src: url(/FontWeb/RobotoCondensed-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-Black;
            src: url(/FontWeb/Rubik-Black.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-BlackItalic;
            src: url(/FontWeb/Rubik-BlackItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-Bold;
            src: url(/FontWeb/Rubik-Bold.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-BoldItalic;
            src: url(/FontWeb/Rubik-BoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-ExtraBold;
            src: url(/FontWeb/Rubik-ExtraBold.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-ExtraBoldItalic;
            src: url(/FontWeb/Rubik-ExtraBoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-Italic;
            src: url(/FontWeb/Rubik-Italic.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-Italic-VariableFont_wght;
            src: url(/FontWeb/Rubik-Italic-VariableFont_wght.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-Light;
            src: url(/FontWeb/Rubik-Light.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-LightItalic;
            src: url(/FontWeb/Rubik-LightItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-Medium;
            src: url(/FontWeb/Rubik-Medium.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-MediumItalic;
            src: url(/FontWeb/Rubik-MediumItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-Regular;
            src: url(/FontWeb/Rubik-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-SemiBold;
            src: url(/FontWeb/Rubik-SemiBold.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-SemiBoldItalic;
            src: url(/FontWeb/Rubik-SemiBoldItalic.ttf) format("truetype");
        }

        @font-face {
            font-family: Rubik-VariableFont_wght;
            src: url(/FontWeb/Rubik-VariableFont_wght.ttf) format("truetype");
        }

        @font-face {
            font-family: Shrikhand-Regular;
            src: url(/FontWeb/Shrikhand-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: Sriracha-Regular;
            src: url(/FontWeb/Sriracha-Regular.ttf) format("truetype");
        }

        @font-face {
            font-family: VarelaRound-Regular;
            src: url(/FontWeb/VarelaRound-Regular.ttf) format("truetype");
        }

    </style>

</head>
