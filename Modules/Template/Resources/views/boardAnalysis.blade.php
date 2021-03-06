@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="討論板相關">
            討論板相關
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">討論板相關</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">討論板人氣</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox">
                    <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-6">討論版名稱</th>
                        <th class="col-md-2">趨勢統計</th>
                        <th class="col-md-2">趨勢統計</th>
                        <th class="col-md-1">今日人氣</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($forumPopularity as $key => $item)
                        <tr forumPopularity='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->name}}</td>
                            <td><a href="/board_analysis_month?forum_id={{$item->id}}" class="btn btn-info">近一個月</a></td>
                            <td><a href="/board_analysis_three_month?forum_id={{$item->id}}" class="btn btn-info">近三個月</a></td>
                            <td>{{$item->popularity}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $forumPopularity->render() !!}
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