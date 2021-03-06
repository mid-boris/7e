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
                        <tr data='@json($item)' @if($item->audit == 1) bgcolor="#f5f5f5" @endif>
                            <th scope="row">{{$key}}</th>
                            @if(isset($item->name))
                                <td><a href="/vote?parent_id={{$item->id}}&vote=1">{{$item->name}}</a></td>
                            @else
                                <td>
                                    @if($item->audit == 0)
                                        <a href="/article?parent_id={{$item->id}}&forum_id={{$item->forum_id}}">{{$item->title}}</a>
                                    @else
                                        <span>{{$item->title}}</span>
                                    @endif
                                </td>
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
                        <div class="box-body">
                            <form class="form-horizontal" method="post" action="/article/create" id="voteForm">
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
                                <div class="form-group">
                                    <label for="contentId" class="col-sm-2 control-label">投票項目</label>
                                    <div class="col-sm-10" id="voteOptionCollection">
                                        <input type="text" class="form-control" placeholder="一人最多選幾項" name="vote_max_count">
                                    </div>
                                </div>
                            </form>
                            <div class="form-group">
                                <label for="contentId" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <form id="voteOptionForm">
                                        <input type="text" class="form-control" placeholder="Add vote option" id="voteOption">
                                        <button class="form-control" id="voteOptionBtn"type="submit">新增項目</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                            <button class="btn btn-primary pull-right" id="voteFormSubmit">送出</button>
                            <input type="text" class="form-control hidden voteOptionSample" name="vote_option[]" readonly>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('button#voteFormSubmit').click(function () {
                $('form#voteForm').submit();
            });

            $('form#voteOptionForm').submit(function () {
                addVoteOption();
                return false;
            });

            function addVoteOption() {
                var option = $('input#voteOption').val();
                if (option == '') {
                    return;
                }
                $('input#voteOption').val('');
                var clone = $('.voteOptionSample').clone();
                clone.val(option);
                clone.removeClass('voteOptionSample').removeClass('hidden').appendTo('#voteOptionCollection');
            }
        });
    </script>
@endsection