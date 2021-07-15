<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @hasSection('title')
        <title>{{  env('APP_NAME') }} | @yield('title')</title>
        <link rel="icon" href="{!! asset('img/favicon.png') !!}"/>
    @else
        <title>{{  env('APP_NAME') }}</title>
        <link rel="icon" href="{!! asset('img/favicon.png') !!}"/>
    @endif
<!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.style')
</head>
<body class="hold-transition layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{url('/dashboard/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo"
             height="60" width="60">
    </div>

    <!-- Content Wrapper. Contains page content -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <main class="py-lg-4">
                <!-- Small boxes (Stat box) -->
                @yield('content')
            </main>
            <!-- /.row (main row) -->
        </div>
    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
</body>
</html>
@include('partials.script')
