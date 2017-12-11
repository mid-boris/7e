@include('adminlte::include.script')
@include('template::include.globalScript')

<script>
    $(function () {
        $.get(
            apiDomain + '/1.0/entrust/isLogin',
            function (res) {
                if (res.data) {
                    url = domain + '/home';
                } else {
                    url = domain + '/login';
                }
                window.location.href = url;
            },
        );
    });
</script>