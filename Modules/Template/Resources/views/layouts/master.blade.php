<!DOCTYPE html>
<html>
<head>
    @include('adminlte::include.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        @include('template::include.header')
    </header>
    <aside class="main-sidebar">
        @include('template::include.side')
    </aside>
    <div class="content-wrapper">
        @yield('content')
    </div>
    <footer class="main-footer">
        @include('adminlte::include.footer')
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
        @include('adminlte::include.sidebar')
    </aside>
    <div class="control-sidebar-bg"></div>
</div>
@include('adminlte::include.script')
@include('template::include.helper')
@include('template::include.globalScript')
@include('template::include.layoutScript')
@yield('script')
</body>
</html>
