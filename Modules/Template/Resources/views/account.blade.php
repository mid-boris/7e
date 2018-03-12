@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="帳號管理">
            帳號管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">帳號管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">帳號</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#accountCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>帳號</th>
                        <th>暱稱</th>
                        <th>角色</th>
                        <th>狀態</th>
                        <th></th>
                        <th>最後修改時間</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user as $key => $item)
                        <tr user='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->account}}</td>
                            <td>{{$item->nick_name}}</td>
                            <td>{{$item->role->count() ? $item->role[0]->name : 'Non'}}</td>
                            <td>{{$item->status == 0 ? 'X' : 'V'}}</td>
                            <th>
                                @if ($item->id > 1)
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#accountEditModal">修改</button>
                                @endif
                            </th>
                            <td>{{$item->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="modal fade" id="accountCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增帳號</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/account/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">帳號</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Account" name="account">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">密碼</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" placeholder="Password" name="password" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">暱稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Nick name" name="nick_name">
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
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">角色</label>
                                    <div class="col-sm-10 checkbox">
                                        <select class="form-control" name="role">
                                            <option value="0">Non</option>
                                            @foreach($role as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
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

    <div class="modal fade" id="accountEditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">編輯帳號</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/account/update">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">帳號</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Account" name="account">
                                        <input type="hidden" name="id" value="0">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">密碼</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">暱稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Nick name" name="nick_name">
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
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">角色</label>
                                    <div class="col-sm-10 checkbox">
                                        <select class="form-control" name="role">
                                            <option value="0">Non</option>
                                            @foreach($role as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">E mail</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="E mail" name="email" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手機</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Phone" name="phone" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">性別</label>
                                    <div class="col-sm-10 checkbox">
                                        <select class="form-control" name="gender">
                                            <option value="0">男</option>
                                            <option value="1">女</option>
                                        </select>
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
            $('#accountEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var user = JSON.parse(button.parent().parent().attr('user'));
                var modal = $(this)
                modal.find('.modal-body input[name="id"]').val(user.id);
                modal.find('.modal-body input[name="account"]').val(user.account);
                modal.find('.modal-body input[name="password"]').val(user.password);
                modal.find('.modal-body input[name="nick_name"]').val(user.nick_name);
                $(':checkbox', modal).prop("checked", user.status);
                if (user.role.length > 0) {
                    $('select[name="role"]', modal).val(user.role[0].id);
                } else {
                    $('select[name="role"]', modal).val(0);
                }
                modal.find('.modal-body input[name="mail"]').val(user.mail);
                modal.find('.modal-body input[name="phone"]').val(user.phone);
                modal.find('.modal-body select[name="gender"]').val(user.gender);
            });
        });
    </script>
@endsection