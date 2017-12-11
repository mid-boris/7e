<script>
    var apiDomain = '{{ config('base.domain') }}' + '{{config('base.uri_prefix')}}';
    var domain = '{{ config('base.domain') }}';
    $.ajaxSetup({
        error: function (request, status, error) {
            var webStatusCode = request.status;
            var webErrorMsg = error;
            var headerCode = request.getResponseHeader('code');

            var code = headerCode == 0 ? webStatusCode : headerCode;
            var msg = headerCode == 0 ? webErrorMsg : request.responseJSON.message;

            var msgJson = isJson(msg);
            if (msgJson === false) {
                eorMsg = msg;
            } else {
                eorMsg = '\n';
                $.each(msgJson, function (i, item) {
                    eorMsg += i + ': ' + item + '\n';
                });
            }
            alert(status + '(' + code + '): ' + eorMsg);
        },
//        complete: function(resp) {
//            if (resp.status == 200) {
//                var headerCode = resp.getResponseHeader('code');
//                if (headerCode != null) {
//                    if (headerCode == 0) {
//                        data_res_success = true;
//                    } else {
//                        data_res_success = false;
//                    }
//                } else {
//                    data_res_success = false;
//                }
//            } else {
//                // web status code 錯誤處理流程
//                data_res_success = false;
//            }
//            console.log('complete');
//        }
    });
</script>
