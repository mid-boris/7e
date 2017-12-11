<!DOCTYPE html>
<html>
    <head>
        @include('adminlte::include.head')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            @include('adminlte::include.header')
        </header>
        <aside class="main-sidebar">
            @include('adminlte::include.side')
        </aside>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <section class="content">
                @yield('content')
            </section>
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
    </body>
</html>
