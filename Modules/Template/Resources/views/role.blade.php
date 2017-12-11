@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="角色管理">
            角色管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">角色管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">角色</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#roleCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>名稱</th>
                        <th></th>
                        <th>最後修改時間</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($role as $key => $item)
                        <tr role='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->name}}</td>
                            <th><button type="button" class="btn btn-default" data-toggle="modal" data-target="#roleEditModal">修改</button></th>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                <form method="get" action="/role/delete">
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
                {!! $role->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="roleCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增角色</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/role/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
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

    <div class="modal fade" id="roleEditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">編輯角色</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/role/update">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                        <input type="hidden" name="id">
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
            $('#roleEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var role = JSON.parse(button.parent().parent().attr('role'));
                var modal = $(this);
                modal.find('.modal-body input[name="id"]').val(role.id);
                modal.find('.modal-body input[name="name"]').val(role.name);
            });
        });
    </script>
@endsection