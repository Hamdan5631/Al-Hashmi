<html
    lang="en"
    class="light-style layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>Pet Bidding Admin</title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/new-logo.png')}}"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"/>

{{--    <link rel="stylesheet" href=" {{asset('assets/vendor/fonts/boxicons.css')}}"/>--}}

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}"
          class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css ')}}"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.css') }}">

    <!-- Helpers -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/ladda/ladda.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/alertify/alertify.css') }}">
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>

    <script src="{{asset('assets/js/config.js')}}"></script>
    <script async defer src="https://buttons.github.io/buttons.js "></script>
    <style>
        .select2-container .select2-search--inline .select2-search__field {
            margin-left: 10px !important;
        }
        .select2 select2-container select2-container--default{
            width: 100%!important;
        }
        @media (min-width: 1200px)
        .layout-page {
            padding-left: 16.25rem!important;
        }

        @media (min-width: 1200px) {
            .layout-page {
                padding-left: 16.25rem!important;
            }
        }

        .layout-menu{
            position: fixed!important;
            height: 100%;
        }

    </style>

</head>

