<!DOCTYPE html>
<html>
<head>
    @include('admin.partials.head')

</head>


<!-- Begin page -->
<body class="fixed-left {{ session('style')=='style_dark.css'?'dark_layout':'white_layout'}}">

<!-- Begin page -->
<div id='app'>


    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">
            @include('admin.partials.navbar')
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
    @include('admin.partials.sidebar')
    <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

    @yield('content')

    <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- END wrapper -->
</div>

@include('admin.partials.scripts')

</body>
</html>