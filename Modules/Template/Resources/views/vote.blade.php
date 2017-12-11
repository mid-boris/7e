@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="投票專區">
            投票專區
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">投票專區</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    @if(is_null($name))
                        投票專區
                    @else
                        {{$name}}
                    @endif
                </h3>
                @if(!is_null($parentId))
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#articleCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
                @endif
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        @if(isset($data->first()->name))
                            <th>名稱</th>
                        @else
                            <th>標題</th>
                        @endif
                        @isset($data->first()->user_account)
                            <th>發文者</th>
                        @endisset
                        <th>需審核</th>
                        <th>最後回覆時間</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $item)
                        <tr data='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            @if(isset($item->name))
                                <td><a href="/vote?parent_id={{$item->id}}">{{$item->name}}</a></td>
                            @else
                                <td><a href="/article?parent_id={{$item->id}}&forum_id={{$item->forum_id}}">{{$item->title}}</a></td>
                            @endif
                            @isset($item->user_account)
                                <th>{{$item->user_account}}</th>
                            @endisset
                            <td>{{$item->audit == 0 ? 'X' : 'V'}}</td>
                            <td>{{$item->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $data->appends($parameter)->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="articleCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增文章</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/article/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="titleId" class="col-sm-2 control-label">標題</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="title" id="titleId">
                                        <input type="hidden" name="forum_id" value="{{$parentId}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="contentId" class="col-sm-2 control-label">內文</label>
                                    <div class="col-sm-10">
                                        <textarea id="contentId" class="form-control" rows="20" name="content"></textarea>
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