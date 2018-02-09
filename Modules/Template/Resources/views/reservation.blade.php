@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="線上預訂">
            線上預訂管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">線上預訂</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">已預定列表</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox">
                    <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-1">帳號</th>
                        <th class="col-md-1">暱稱</th>
                        <th class="col-md-1">手機</th>
                        <th class="col-md-1">店家名稱</th>
                        <th class="col-md-1">預定時間</th>
                        <th class="col-md-1">人數</th>
                        <th class="col-md-1">申請時間</th>
                        <th class="col-md-1">已完成</th>
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reservation as $key => $item)
                        <tr reservation='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->account}}</td>
                            <td>{{$item->nick_name}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->shop->first()->name}}</td>
                            <td>{{date('Y-m-d H:i:s', $item->reservation_time)}}</td>
                            <td>{{$item->number_of_people}} 人</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                @if ($item->applied)
                                    V
                                @else
                                    <form method="get" action="/reservation/applied">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-primary">完成預定</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form method="get" action="/reservation/delete">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-danger">刪除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $reservation->render() !!}
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
        });
    </script>
@endsection