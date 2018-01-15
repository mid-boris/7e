@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="客服信件">
            客服信件
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">客服信件</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">客服信件</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#messageCreateModal">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增
                </button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>留言帳號</th>
                        <th>目標帳號</th>
                        <th class="col-md-8">內容</th>
                        <th></th>
                        <th>詢問時間</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($message as $key => $item)
                        <tr message='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->user_account}}({{$item->user_nick_name}})</td>
                            <td>{{$item->target_account}}({{$item->target_nick_name}})</td>
                            <td>
                                {{$item->content}}
                            </td>
                            <td><button type="button" class="btn btn-primary report">回覆</button></td>
                            <td>{{$item->updated_at}}</td>
                        </tr>
                        <tr class="hidden reportForm">
                            <th></th>
                            <td></td>
                            <td>
                                <form class="form-horizontal" method="post" action="/message/create">
                                    <input type="text" name="content" class="form-control">
                                    <input type="hidden" name="target" value="{{$item->target_account}}">
                                    <input type="submit" class="btn btn-info" value="送出">
                                </form>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $message->appends($parameter)->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="messageCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增回覆</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal createMessageForm" method="post" action="/message/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">目標帳號</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Account" name="target">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">內容</label>
                                    <div class="col-sm-10">
                                        <input name="content" class="form-control" type="text" placeholder="Content">
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
            $('button.report').click(function () {
                var tr = $(this).parent().parent();
                var message = JSON.parse(tr.attr('message'));
                tr.next().toggleClass('hidden');
            });
            
            $('form.createMessageForm').submit(function () {
                var target = $(this).find('input[name=target]').val();
                if (target == '') {
                    alert('目標帳號尚未設定');
                    return false;
                }
            });
        });
    </script>
@endsection