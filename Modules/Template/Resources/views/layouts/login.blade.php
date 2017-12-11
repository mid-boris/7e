<!DOCTYPE html>
<html>
<head>
    @include('adminlte::include.head')
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>7e</b>
        Manager
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="/entrust/login" method="post">
            <div class="form-group has-feedback">
                <input name="user" type="text" class="form-control" placeholder="Account" autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->

    </div>
</div>
@include('adminlte::include.script')
@include('template::include.globalScript')
@yield('script')
</body>
</html>
