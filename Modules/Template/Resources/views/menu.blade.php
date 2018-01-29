@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="菜單管理">
            菜單管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">菜單管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$shop->name}}</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#menuCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>名稱</th>
                        <th>價格</th>
                        <th>素食</th>
                        <th>置頂</th>
                        <th>熱門</th>
                        <th>狀態</th>
                        <th></th>
                        <th>最後修改時間</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menu as $key => $item)
                        <tr menu='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->vegetarian == 1 ? '素' : ''}}</td>
                            <td>{{$item->height_light == 0 ? 'X' : 'V'}}</td>
                            <td>{{$item->hot == 0 ? 'X' : 'V'}}</td>
                            <td>{{$item->status == 0 ? 'X' : 'V'}}</td>
                            <th><button type="button" class="btn btn-default" data-toggle="modal" data-target="#menuEditModal">修改</button></th>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                <form method="get" action="/menu/delete">
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
                {!! $menu->appends($parameter)->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="menuCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增菜單</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/menu/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">價格</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Price" name="price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="vegetarian" type="checkbox" value="1">
                                            素食
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="height_light" type="checkbox" value="1">
                                            置頂
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="hot" type="checkbox" value="1">
                                            熱門
                                        </label>
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
                                <input type="hidden" name="shop_id" value="{{$shop->id}}">
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

    <div class="modal fade" id="menuEditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">編輯菜單</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/menu/update">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">價格</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Price" name="price">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="vegetarian" type="checkbox" value="1" checked>
                                            素食
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="height_light" type="checkbox" value="1">
                                            置頂
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="hot" type="checkbox" value="1">
                                            熱門
                                        </label>
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
                                <input type="hidden" value="" name="id">
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
            $('#menuEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var menu = JSON.parse(button.parent().parent().attr('menu'));
                var modal = $(this);
                modal.find('.modal-body input[name="id"]').val(menu.id);
                modal.find('.modal-body input[name="name"]').val(menu.name);
                modal.find('.modal-body input[name="price"]').val(menu.price);
                $('input[name=vegetarian]:checkbox', modal).prop("checked", menu.vegetarian);
                $('input[name=height_light]:checkbox', modal).prop("checked", menu.height_light);
                $('input[name=hot]:checkbox', modal).prop("checked", menu.hot);
                $('input[name=status]:checkbox', modal).prop("checked", menu.status);
            });
        });
    </script>
@endsection