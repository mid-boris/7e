@extends('layouts.app')

@section('content')
    <div id="app">
        @{{ message }}
    </div>

    <script>
        var app = new Vue({
            el: '#app',
            mounted: function () {
                console.log('123')
            },
            data: {
                'message': 456,
            },
        });
    </script>
@endsection