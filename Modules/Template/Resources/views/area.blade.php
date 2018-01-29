@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="地區管理">
            地區管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">地區管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$name ?? '地區'}}</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#areaCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>名稱</th>
                        <th>狀態</th>
                        <th></th>
                        <th>最後修改時間</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($area as $key => $item)
                        <tr area='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td><a href="/area?id={{$item->id}}&name={{$item->name}}">{{$item->name}}</a></td>
                            <td>{{$item->status == 0 ? 'X' : 'V'}}</td>
                            <th><button type="button" class="btn btn-default" data-toggle="modal" data-target="#areaEditModal">修改</button></th>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                <form method="get" action="/area/delete">
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
                {!! $area->appends($parameter)->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="areaCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增地區</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/area/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">上層名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="parent_name" placeholder="{{$name}}" readonly value="{{$name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="status" type="checkbox" id="statusChk" value="1" checked>
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

    <div class="modal fade" id="areaEditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">編輯地區</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/area/update">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                        <input type="hidden" name="id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">上層名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="{{$name}}" readonly value="">
                                        <input type="hidden" name="parent_id" value="{{$id}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="status" type="checkbox" id="statusChk" value="1" checked>
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
            $('#areaEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var area = JSON.parse(button.parent().parent().attr('area'));
                var modal = $(this);
                modal.find('.modal-body input[name="id"]').val(area.id);
                modal.find('.modal-body input[name="name"]').val(area.name);
                $(':checkbox', modal).prop("checked", area.status);
            });
        });
    </script>
@endsection