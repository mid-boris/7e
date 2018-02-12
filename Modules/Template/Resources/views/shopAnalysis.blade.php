@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="商家相關">
            商家相關
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">商家相關</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">商家人氣</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox">
                    <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-5">商家名稱</th>
                        <th class="col-md-2">趨勢統計</th>
                        <th class="col-md-2">趨勢統計</th>
                        <th class="col-md-1">今日人氣</th>
                        <th class="col-md-1">總收藏數</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shopPopularity as $key => $item)
                        <tr shopPopularity='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->name}}</td>
                            <td><a href="/shop_analysis_month?shop_id={{$item->id}}" class="btn btn-info">近一個月</a></td>
                            <td><a href="/shop_analysis_three_month?shop_id={{$item->id}}" class="btn btn-info">近三個月</a></td>
                            <td>{{$item->popularity}}</td>
                            <td>{{$item->favorite_count}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $shopPopularity->render() !!}
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