@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="討論版管理">
            討論版管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">討論版管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">討論版</h3>
                @if(in_array($parentId ,[1, 2]))
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#forumCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
                @endif
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>名稱</th>
                        <th>需審核</th>
                        <th>狀態</th>
                        <th>排序</th>
                        <th></th>
                        <th>最後修改時間</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($forum as $key => $item)
                        <tr forum='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td><a href="/forum?parent_id={{$item->id}}&name={{$item->name}}">{{$item->name}}</a></td>
                            <td>{{$item->audit == 0 ? 'X' : 'V'}}</td>
                            <td>{{$item->status == 0 ? 'X' : 'V'}}</td>
                            <td>{{$item->sort}}</td>
                            <th>
                                @if($item->id > 2)
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#forumEditModal">修改</button>
                                @endif
                            </th>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                @if($item->id > 2)
                                    <form method="get" action="/forum/delete">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-danger">刪除</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $forum->appends($parameter)->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="forumCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增討論版</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/forum/create">
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
                                        <input type="text" class="form-control" placeholder="{{$name}}" readonly value="">
                                        <input type="hidden" name="parent_id" value="{{$parentId}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">排序</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Sort" name="sort">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="status" type="checkbox" value="1" checked>
                                            啟用
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="audit" type="checkbox" value="1">
                                            需審核
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

    <div class="modal fade" id="forumEditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">編輯討論版</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/forum/update">
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
                                        <input type="hidden" name="parent_id" value="{{$parentId}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">排序</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Sort" name="sort">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="status" type="checkbox" value="1" checked>
                                            啟用
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="audit" type="checkbox" value="1">
                                            需審核
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
            $('#forumEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var forum = JSON.parse(button.parent().parent().attr('forum'));
                var modal = $(this);
                modal.find('.modal-body input[name="id"]').val(forum.id);
                modal.find('.modal-body input[name="name"]').val(forum.name);
                $(':checkbox[name=status]', modal).prop("checked", forum.status);
                $(':checkbox[name=audit]', modal).prop("checked", forum.audit);
                modal.find('.modal-body input[name="sort"]').val(forum.sort);
            });
        });
    </script>
@endsection