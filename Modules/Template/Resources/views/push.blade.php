@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="推播管理">
            推播管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">推播管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">推播</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#pushCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>標題</th>
                        <th>內文</th>
                        <th>發送者</th>
                        <th>最後修改時間</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($push as $key => $item)
                        <tr push='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->title}}</td>
                            <td>{{$item->content}}</td>
                            <td>{{$item->user_account}}</td>
                            <td>{{$item->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $push->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="pushCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">發送推播</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/push/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">標題</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Title" name="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">內文</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Content" name="content">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                <button type="submit" class="btn btn-primary pull-right">送出</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
        });
    </script>
@endsection