@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="投票專區">
            文章
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">文章</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">文章</h3>
                @if(!is_null($parentId) && $article->audit == 0)
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#articleCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 回復</button>
                @endif
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>發文者</th>
                        <th>標題</th>
                        <th style="width: 70%">內文</th>
                        <th style="width: 80px">發文時間</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">-</th>
                            <td>{{$article->user_account}}({{$article->user_nick_name}})</td>
                            <td>{{$article->title}}</td>
                            <td>
                                <textarea id="contentId" class="form-control" rows="5" name="content" readonly>{{$article->context}}</textarea>
                                @if($article->voteOption->count() > 0)
                                <form action="/vote/add" method="post">
                                    <table class="table table-bordered vote-table">
                                        <thead>
                                            <th style="width: 10px">#</th>
                                            <th style="width: 20%">名稱</th>
                                            <th></th>
                                            <th style="width: 50px">票數</th>
                                        </thead>
                                        <tbody>
                                        @foreach($article->voteOption as $key => $option)
                                            <tr vote='@json($option)'>
                                                <td>{{$key}}.</td>
                                                <td>
                                                    <div class="form-check">
                                                        @if($article->voteItem->count() == 0)
                                                            <input class="form-check-input" type="checkbox" value="{{$option->id}}" name="vote_ids[]">
                                                            {{$option->option_name}}
                                                        @endif
                                                        @foreach($article->voteItem as $item)
                                                            @if($item->vote_id == $option->id)
                                                                    <input class="form-check-input" type="checkbox" value="{{$option->id}}" name="vote_ids[]" checked disabled>
                                                            @endif
                                                            @endforeach
                                                            {{$option->option_name}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar progress-bar-danger" style="width: 0%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-red">0</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @if($article->voteItem->count() == 0)
                                    <input type="hidden" name="article_id" value="{{$parentId}}">
                                    <button type="submit" class="btn btn-primary pull-left">送出</button>
                                    @endif
                                </form>
                                @endif
                            </td>
                            <td>
                                <h6>{{date('Y-m-d', strtotime($article->updated_at->toDateTimeString()))}}</h6>
                                <h6>{{date('H:i:s', strtotime($article->updated_at->toDateTimeString()))}}</h6>
                            </td>
                        </tr>
                        @foreach($reports as $key => $item)
                            <tr @if($item->audit == 1) bgcolor="#f5f5f5" @endif>
                                <th scope="row">{{$key}}</th>
                                <td>{{$item->user_account}}({{$item->user_nick_name}})</td>
                                <td>{{$item->title}}</td>
                                <td><textarea id="contentId" class="form-control" rows="5" name="content" readonly>{{$item->context}}</textarea></td>
                                <td>
                                    <h6>{{date('Y-m-d', strtotime($item->updated_at->toDateTimeString()))}}</h6>
                                    <h6>{{date('H:i:s', strtotime($item->updated_at->toDateTimeString()))}}</h6>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $reports->appends($parameter)->render() !!}
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
                                        <input type="text" class="form-control" placeholder="Name" name="title" id="titleId" value="{{$article->title}}" readonly>
                                        <input type="hidden" name="parent_id" value="{{$parentId}}">
                                        <input type="hidden" name="forum_id" value="{{$forumId}}">
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
            voteInit();

            function voteInit() {
                var voteCollection = $('table.vote-table tbody tr');
                // 計算票數總和
                var voteTotal = 0;
                voteCollection.each(function () {
                    var data = $(this).attr('vote');
                    data = JSON.parse(data);
                    voteTotal += data.vote_count;
                });
                // 計算百分比
                if (voteTotal > 0) {
                    voteCollection.each(function () {
                        var data = $(this).attr('vote');
                        data = JSON.parse(data);
                        var voteCount = data.vote_count;
                        var percentage = voteCount / voteTotal;
                        $('td span', $(this)).html(voteCount);
                        $('div.progress-bar', $(this)).width(percentage * 100 + '%');
                    });
                }
            }
        });
    </script>
@endsection