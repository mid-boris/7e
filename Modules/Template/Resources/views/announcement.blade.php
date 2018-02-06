@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="公告管理">
            公告管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">公告管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-1">
                        <h3 class="box-title">公告</h3>
                    </div>
                    <div class="col-md-3">
                        <form class="form-inline" method="get" action="announcement">
                            <select class="form-control type-filter" name="type">
                                <option value="">全部</option>
                                @foreach($type as $code => $viewer)
                                    <option value="{{$code}}" {{$request->input('type') == $code ? 'selected' : ''}}>{{$viewer}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="form-controller btn btn-info">篩選</button>
                        </form>
                    </div>
                    <div class="col-md-1 pull-right">
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#announcementCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>標題</th>
                        <th>置頂</th>
                        <th>狀態</th>
                        <th>開始時間</th>
                        <th>結束時間</th>
                        <th></th>
                        <th>最後修改時間</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($announcement as $key => $item)
                        <tr announcement='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->content[0]->title ?? ''}}</td>
                            <td>{{$item->high_light == 0 ? 'X' : 'V'}}</td>
                            <td>{{$item->status == 0 ? 'X' : 'V'}}</td>
                            <td>{{is_null($item->start_time) ? '' : date('Y-m-d', $item->start_time)}}</td>
                            <td>{{is_null($item->end_time) ? '' : date('Y-m-d', $item->end_time - 24 * 60 * 60)}}</td>
                            <th>
                                <button type="button" class="btn btn-default announcementEditModal" data-toggle="modal" data-target="#announcementEditModal">修改</button>
                            </th>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                <form method="get" action="/announcement/delete">
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
                {!! $announcement->appends($parameter)->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="announcementCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增公告</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal editor-form" method="post" action="/announcement/create" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">語系</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="language">
                                            @foreach($languages as $code => $language)
                                                <option value="{{$code}}">{{$language}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">標題</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Title" name="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">內文</label>
                                    <textarea name="content" class="hidden"></textarea>
                                    <div class="col-sm-10">
                                        <textarea class="wysihtml5Editor" placeholder="Enter Content ..." style="width: 100%"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label class="checkbox-inline">
                                            <input name="high_light" type="checkbox" value="9">
                                            置頂
                                        </label>
                                        <label class="checkbox-inline">
                                            <input name="status" type="checkbox" value="1" checked>
                                            啟用
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">類型</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="type">
                                        @foreach($type as $code => $viewer)
                                            <option value="{{$code}}">{{$viewer}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">圖片</label>
                                <div class="col-sm-10">
                                    <div class="imageupload panel panel-default image-upload">
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
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">開始日期</label>
                                <div class="col-sm-4">
                                    <input data-provide="datepicker" name="start_time">
                                    <small class="text-muted">
                                        (選填)
                                    </small>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 control-label">結束日期</label>
                                <div class="col-sm-4">
                                    <input data-provide="datepicker" name="end_time">
                                    <small class="text-muted">
                                        (選填)
                                    </small>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                <input type="submit" class="btn btn-primary pull-right" value="送出">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade announcementEditModal" id="announcementEditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">編輯公告</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal editor-form" method="post" action="/announcement/update" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">語系</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="language" id="languageChanged">
                                            @foreach($languages as $code => $language)
                                                <option value="{{$code}}">{{$language}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="id">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">標題</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Title" name="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">內文</label>
                                    <textarea name="content" class="hidden"></textarea>
                                    <div class="col-sm-10 editor">
                                        <textarea class="wysihtml5Editor" placeholder="Enter Content ..." style="width: 100%"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label class="checkbox-inline">
                                            <input name="high_light" type="checkbox" value="9">
                                            置頂
                                        </label>
                                        <label class="checkbox-inline">
                                            <input name="status" type="checkbox" value="1" checked>
                                            啟用
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">類型</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="type">
                                        @foreach($type as $code => $viewer)
                                            <option value="{{$code}}">{{$viewer}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group imageArea">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <img src="" style="width: 100%">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">圖片</label>
                                <div class="col-sm-10">
                                    <div class="imageupload panel panel-default image-upload">
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
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">開始日期</label>
                                <div class="col-sm-4">
                                    <input data-provide="datepicker" name="start_time">
                                    <small class="text-muted">
                                        (選填)
                                    </small>
                                </div>
                                <label for="inputEmail3" class="col-sm-2 control-label">結束日期</label>
                                <div class="col-sm-4">
                                    <input data-provide="datepicker" name="end_time">
                                    <small class="text-muted">
                                        (選填)
                                    </small>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                <input type="submit" class="btn btn-primary pull-right" value="送出">
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
        var editorOption = {
            "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": true, //Italics, bold, etc. Default true
            "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": false, //Button which allows you to edit the generated HTML. Default false
            "link": true, //Button to insert a link. Default true
            "image": false, //Button to insert an image. Default true,
            "color": true //Button to change color of font
        };

        $(document).ready(function() {
            // 文字編輯器
            $('.wysihtml5Editor').wysihtml5(editorOption);

            // 圖片
            $('.image-upload').imageupload({
                allowedFormats: [ 'jpg', 'jpeg' ],
                maxWidth: 512,
                maxHeight: 256,
            });

            // 日期編輯器
            $('.datepicker').datepicker();

            // 新增與編輯送出
            $('form.editor-form').submit(editorSubmit);

            $('.announcementEditModal').on('show.bs.modal', function (event) {
                if (event.target.id == 'announcementEditModal') {
                    var button = $(event.relatedTarget);
                    var json = button.parent().parent().attr('announcement');
                    var announcement = JSON.parse(json);
                    var modal = $(this);
                    modal.find('.modal-body select[name="language"]').attr('announcement', json);
                    modal.find('.modal-body select[name="language"]').val(announcement.content[0].language);
                    modal.find('.modal-body input[name="title"]').val(announcement.content[0].title);
                    modal.find('.modal-body input[name="id"]').val(announcement.id);

//                    modal.find('.modal-body .editor').html('' +
//                        '<textarea class="wysihtml5Editor" placeholder="Enter Content ..." style="width: 100%"></textarea>');
//                    modal.find('.wysihtml5Editor').val(announcement.content[0].content);
//                    modal.find('.wysihtml5Editor').wysihtml5(editorOption);
                    var box = modal.find('.modal-body');
                    setEditor(box, announcement.content[0].content);

                    $(':checkbox[name=high_light]', modal).prop("checked", announcement.high_light);
                    $(':checkbox[name=status]', modal).prop("checked", announcement.status);
                    modal.find('.modal-body select[name="type"]').val(announcement.type);

                    if (announcement.start_time) {
                        var dateFormat = 'mm/dd/yy';
                        var startTime = $.datepicker.formatDate(dateFormat, new Date(announcement.start_time * 1000));
                        modal.find('.modal-body input[name="start_time"]').val(startTime);
                    }
                    if (announcement.end_time) {
                        var dateFormat = 'mm/dd/yy';
                        var endTime = $.datepicker.formatDate(dateFormat, new Date((announcement.end_time - 24 * 60 * 60) * 1000));
                        modal.find('.modal-body input[name="end_time"]').val(endTime);
                    }

                    // 塞圖片
                    if (announcement.images.length == 0) {
                        modal.find('.modal-body .imageArea').hide();
                    } else {
                        var imageUrl = 'images/announcement/' + announcement.images[0].saved_uri;
                        modal.find('.modal-body .imageArea img').attr('src', imageUrl);
                        modal.find('.modal-body .imageArea').show();
                    }
                }
            });

            // 編輯頁 切 換語系時
            $('select#languageChanged').change(function () {
                var json = $(this).attr('announcement');
                announcement = JSON.parse(json);
                var selectedValue = $(this).select().val();
                var box = $(this).parent().parent().parent();
                var isSelectd = false;
                $.each(announcement.content, function (idx, v) {
                    if (v.language == selectedValue) {
                        $('input[name=title]', box).val(v.title);
                        setEditor(box, v.content);
                        isSelectd = true;
                    }
                });
                if (!isSelectd) {
                    $('input[name=title]', box).val('');
                    setEditor(box, '');
                }
            });

            // 公告 filter

        });

        function setEditor(body, content) {
            body.find('.editor').html('' +
                '<textarea class="wysihtml5Editor" placeholder="Enter Content ..." style="width: 100%"></textarea>');
            body.find('.wysihtml5Editor').val(content);
            body.find('.wysihtml5Editor').wysihtml5(editorOption);
        }

        function editorSubmit(event) {
            var val = $('.wysihtml5Editor', $(this)).val();
            $('textarea[name=content]', $(this)).val(val);
        }
    </script>
@endsection