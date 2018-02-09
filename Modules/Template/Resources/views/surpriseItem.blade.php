@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="驚喜管理">
            驚喜箱內容管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">驚喜箱內容管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$surprise->name}}</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#surpriseCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox">
                    <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-2">名稱</th>
                        <th class="col-md-5">描述</th>
                        <th class="col-md-1">有效日</th>
                        <th class="col-md-1"></th>
                        <th class="col-md-1">最後修改時間</th>
                        <th class="col-md-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($surpriseItem as $key => $item)
                        <tr surprise='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->name}}</td>
                            <td class="text-truncate">{{$item->description}}</td>
                            <td>{{is_null($item->expiration) ? '無期限' : $item->expiration . ' days'}}</td>
                            <td>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#surpriseEditModal">修改</button>
                            </td>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                <form method="get" action="/surpriseItem/delete">
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
                {!! $surpriseItem->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="surpriseCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增驚喜箱內容</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/surpriseItem/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                        <input type="hidden" name="surprise_box_id" value="{{$surpriseBoxId}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">描述</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Description" name="description">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">有效天數</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" placeholder="Expiration Days" name="expiration">
                                    </div>
                                    <small class="text-muted col-sm-2 control-label">
                                        (選填)
                                    </small>
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
                    <h5 class="modal-title">編輯驚喜箱內容</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/surpriseItem/update">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                        <input type="hidden" name="id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">描述</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Description" name="description">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">有效天數</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" placeholder="Expiration Days" name="expiration">
                                    </div>
                                    <small class="text-muted col-sm-2 control-label">
                                        (選填)
                                    </small>
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
                modal.find('.modal-body input[name="description"]').val(surprise.description);
                modal.find('.modal-body input[name="expiration"]').val(surprise.expiration);
            });
        });
    </script>
@endsection