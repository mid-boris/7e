<!DOCTYPE html>
<html>
<head>
    @include('adminlte::include.head')
</head>
<body class="hold-transition login-page">
<div class="login-box">
</div>
@include('adminlte::include.script')
@include('template::include.globalScript')
@yield('script')

<script src="/vendor/adminLTE/bower_components/socket.io/socket.io.slim.js"></script>
<script>
    $(document).ready(function() {
        var socket = io('http://192.168.137.100:3000');
//        var socket = io('http://7e.net:3100/');
        socket.on('connect', function(){});
        socket.on('event', function(data){});
        socket.on('disconnect', function(){});
    });
</script>
</body>
</html>
