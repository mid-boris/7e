@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="商家管理">
            圖像管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">{{$shop->name}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">商標</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#tradeMardCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th class="col-xs-1">#</th>
                        <th>影像</th>
                        <th class="col-xs-1">寬</th>
                        <th class="col-xs-1">高</th>
                        <th class="col-xs-1">大小</th>
                        <th class="col-xs-1">建立時間</th>
                        <th class="col-xs-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shop->trademark as $key => $item)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td><img src="/images/{{$item->saved_uri}}" class="img-trademark" alt="image"></td>
                            <td>{{$item->image_width}}</td>
                            <td>{{$item->image_height}}</td>
                            <td>{{$item->image_size}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <form method="get" action="/image/destroy">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-danger">刪除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">預覽圖</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#previewCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th class="col-xs-1">#</th>
                        <th>影像</th>
                        <th class="col-xs-1">寬</th>
                        <th class="col-xs-1">高</th>
                        <th class="col-xs-1">大小</th>
                        <th class="col-xs-1">建立時間</th>
                        <th class="col-xs-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shop->preview as $key => $item)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td><img src="/images/{{$item->saved_uri}}" class="img-trademark" alt="image"></td>
                            <td>{{$item->image_width}}</td>
                            <td>{{$item->image_height}}</td>
                            <td>{{$item->image_size}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <form method="get" action="/image/destroy">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-danger">刪除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="modal fade" id="tradeMardCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增商標</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/shop/tradeMark/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="imageupload panel panel-default" id="image-upload">
                                        <div class="panel-heading clearfix">
                                            <h3 class="panel-title pull-left">寬高限制: 256</h3>
                                        </div>
                                        <div class="file-tab panel-body">
                                            <label class="btn btn-default btn-file">
                                                <span>Browse</span>
                                                <!-- The file is stored here. -->
                                                <input type="file" name="image">
                                            </label>
                                            <button type="button" class="btn btn-default">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="shop_id" value="{{$shopId}}">
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

    <div class="modal fade" id="previewCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增預覽圖</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/shop/preview/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="imageupload panel panel-default" id="preview-image-upload">
                                        <div class="panel-heading clearfix">
                                            <h3 class="panel-title pull-left">寬高限制: 1024 x 500</h3>
                                        </div>
                                        <div class="file-tab panel-body">
                                            <label class="btn btn-default btn-file">
                                                <span>Browse</span>
                                                <!-- The file is stored here. -->
                                                <input type="file" name="image">
                                            </label>
                                            <button type="button" class="btn btn-default">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="shop_id" value="{{$shopId}}">
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
            // image upload
            $('#image-upload').imageupload({
                allowedFormats: [ 'jpg', 'jpeg' ],
                maxWidth: 256,
                maxHeight: 256,
            });
            // image upload
            $('#preview-image-upload').imageupload({
                allowedFormats: ['jpg', 'jpeg'],
                maxWidth: 512,
                maxHeight: 250,
            });

//            $('#forumEditModal').on('show.bs.modal', function (event) {
//                var button = $(event.relatedTarget);
//                var forum = JSON.parse(button.parent().parent().attr('forum'));
//                var modal = $(this);
//                modal.find('.modal-body input[name="id"]').val(forum.id);
//                modal.find('.modal-body input[name="name"]').val(forum.name);
//                $(':checkbox[name=sort]', modal).prop("checked", forum.sort == 9);
//                $(':checkbox[name=status]', modal).prop("checked", forum.status);
//                $(':checkbox[name=audit]', modal).prop("checked", forum.audit);
//            });
        });
    </script>
@endsection