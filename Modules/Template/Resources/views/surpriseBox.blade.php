@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="驚喜管理">
            驚喜箱管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">驚喜箱管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">驚喜箱</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#surpriseCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>名稱</th>
                        <th>開始日期</th>
                        <th>結束日期</th>
                        <th>狀態</th>
                        <th></th>
                        <th></th>
                        <th>最後修改時間</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($surprise as $key => $item)
                        <tr surprise='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->start_time ? date('Y-m-d', $item->start_time) : ''}}</td>
                            <td>{{$item->end_time ? date('Y-m-d', $item->end_time - 24 * 60 * 60) : ''}}</td>
                            <td>{{$item->status == 0 ? 'X' : 'V'}}</td>
                            <td><a href="surpriseItem?id={{$item->id}}" class="btn btn-info">內容管理</a></td>
                            <th>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#surpriseEditModal">修改</button>
                            </th>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                <form method="get" action="/surpriseBox/delete">
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
                {!! $surprise->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="surpriseCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增驚喜箱</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/surpriseBox/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">開始日期</label>
                                    <div class="col-sm-4">
                                        <input data-provide="datepicker" name="start_time" placeholder="Start date">
                                        <small class="text-muted">
                                            (選填)
                                        </small>
                                    </div>
                                    <label  class="col-sm-2 control-label">結束日期</label>
                                    <div class="col-sm-4">
                                        <input data-provide="datepicker" name="end_time" placeholder="End date">
                                        <small class="text-muted">
                                            (選填)
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="status" type="checkbox" value="1" checked>
                                            啟用
                                        </label>
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

    <div class="modal fade" id="surpriseEditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">編輯驚喜箱</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/surpriseBox/update">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                        <input type="hidden" name="id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">開始日期</label>
                                    <div class="col-sm-4">
                                        <input data-provide="datepicker" name="start_time" placeholder="Start date">
                                        <small class="text-muted">
                                            (選填)
                                        </small>
                                    </div>
                                    <label  class="col-sm-2 control-label">結束日期</label>
                                    <div class="col-sm-4">
                                        <input data-provide="datepicker" name="end_time" placeholder="End date">
                                        <small class="text-muted">
                                            (選填)
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="status" type="checkbox" value="1" checked>
                                            啟用
                                        </label>
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
            $('#surpriseEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var surprise = JSON.parse(button.parent().parent().attr('surprise'));
                var modal = $(this)

                modal.find('.modal-body input[name="id"]').val(surprise.id);
                modal.find('.modal-body input[name="name"]').val(surprise.name);
                $(':checkbox', modal).prop("checked", surprise.status);

                if (surprise.start_time) {
                    var dateFormat = 'mm/dd/yy';
                    var startTime = $.datepicker.formatDate(dateFormat, new Date(surprise.start_time * 1000));
                    modal.find('.modal-body input[name="start_time"]').val(startTime);
                } else {
                    modal.find('.modal-body input[name="start_time"]').val('');
                }
                if (surprise.end_time) {
                    var dateFormat = 'mm/dd/yy';
                    var endTime = $.datepicker.formatDate(dateFormat, new Date((surprise.end_time - 24 * 60 * 60) * 1000));
                    modal.find('.modal-body input[name="end_time"]').val(endTime);
                } else {
                    modal.find('.modal-body input[name="end_time"]').val('');
                }
            });
        });
    </script>
@endsection