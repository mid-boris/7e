@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="商家管理">
            商家管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">商家管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">商家</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#shopCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>名稱</th>
                        <th>電話</th>
                        <th>手機</th>
                        <th>營業時間</th>
                        <th>地區</th>
                        <th>特約</th>
                        <th>狀態</th>
                        <th></th>
                        <th>最後修改時間</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shop as $key => $item)
                        <tr shop='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->telphone}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->business_hours}}</td>
                            <td>
                                @if(!is_null($item->area))
                                    {{$item->area->name}}
                                @endif
                            </td>
                            <td>{{$item->special == 0 ? '' : 'V'}}</td>
                            <td>{{$item->status == 0 ? 'X' : ''}}</td>
                            <th><button type="button" class="btn btn-default" data-toggle="modal" data-target="#shopEditModal">修改</button></th>
                            <td>{{$item->updated_at}}</td>
                            <td>
                                <form method="get" action="/shop/delete">
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
                {!! $shop->render() !!}
            </div>

        </div>
    </section>

    <div class="modal fade" id="shopCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">新增商家</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">

                            <div class="box-body">
                                <form id="shopCreateForm" class="form-horizontal" method="post" action="/shop/create">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">名稱</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Address" name="address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">電話</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Telephone" name="telphone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">手機</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Phone" name="phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">營業時間</label>
                                    <label class="col-sm-2 control-label"></label>
                                    <div class=" input-group">
                                        <div class='input-group date' id="timepicker_s">
                                            <input type='text' class="form-control" name="start_time" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="input-group">
                                        <div class='input-group date' id="timepicker_e">
                                            <input type='text' class="form-control"  name="end_time" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公休日</label>
                                    <div class="col-sm-10 input-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="closed_day[]" value="0"> 日
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="closed_day[]" value="1"> 一
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="closed_day[]" value="2"> 二
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="closed_day[]" value="3"> 三
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="closed_day[]" value="4"> 四
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="closed_day[]" value="5"> 五
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="closed_day[]" value="6"> 六
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label>
                                            <input name="special" type="checkbox" value="1">
                                            特約
                                        </label>
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
                                                <input name="i_pass" type="checkbox" value="1">
                                                一卡通
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10 checkbox" id="area_collection">
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">地區</label>
                                    <form class="form-inline col-sm-10 areaForm">
                                        <label class="sr-only">Amount (in dollars)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
                                            <input type="text" class="form-control" placeholder="Area" name="name">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </form>
                                </div>
                                <button type="button" class="areaBtn btn btn-info btn-sm hidden" id="area_smaple" >
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> <span class="text"></span>
                                    <input type="hidden" name="area_id">
                                </button>
                            </div>

                            <div class="box-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                <button id="shopCreateBtn" type="submit" class="btn btn-primary pull-right">送出</button>
                            </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="shopEditModal" tabindex="-1" role="dialog" aria-hidden="true">
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

                            <div class="box-body">
                                <form id="shopUpdateForm" class="form-horizontal" method="post" action="/shop/update">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Name" name="name">
                                            <input type="hidden" name="id">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">地址</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Address" name="address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">電話</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Telephone" name="telphone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">手機</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Phone" name="phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">營業時間</label>
                                        <div class="col-sm-10 input-group">
                                            <div class='input-group date' id="timepicker_s1">
                                                <input type='text' class="form-control" name="start_time" />
                                                <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10 input-group">
                                            <div class='input-group date' id="timepicker_e1">
                                                <input type='text' class="form-control"  name="end_time" />
                                                <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">公休日</label>
                                        <div class="col-sm-10 input-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox0" name="closed_day[]" value="0"> 日
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox1" name="closed_day[]" value="1"> 一
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox2" name="closed_day[]" value="2"> 二
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox3" name="closed_day[]" value="3"> 三
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox4" name="closed_day[]" value="4"> 四
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox5" name="closed_day[]" value="5"> 五
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox6" name="closed_day[]" value="6"> 六
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10 checkbox">
                                            <label>
                                                <input name="special" type="checkbox" value="1">
                                                特約
                                            </label>
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
                                                <input name="i_pass" type="checkbox" value="1">
                                                一卡通
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10 checkbox" id="area_update_collection">
                                        </div>
                                    </div>
                                </form>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">地區</label>
                                    <form class="form-inline col-sm-10 areaFormInUpdate">
                                        <label class="sr-only">Amount (in dollars)</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
                                            <input type="text" class="form-control" placeholder="Area" name="name">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </form>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                <button id="shopUpdateBtn" type="submit" class="btn btn-primary pull-right">送出</button>
                            </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#timepicker_s').datetimepicker({
                format: 'LT'
            });
            $('#timepicker_e').datetimepicker({
                format: 'LT'
            });
            $('#timepicker_s1').datetimepicker({
                format: 'LT'
            });
            $('#timepicker_e1').datetimepicker({
                format: 'LT'
            });

            $('#shopCreateBtn').click(function () {
                $('#shopCreateForm').submit();
            });
            $('#shopUpdateBtn').click(function () {
                $('#shopUpdateForm').submit();
            });

            $('#shopEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var shop = JSON.parse(button.parent().parent().attr('shop'));
                var modal = $(this);
                modal.find('.modal-body input[name="id"]').val(shop.id);
                modal.find('.modal-body input[name="name"]').val(shop.name);
                modal.find('.modal-body input[name="address"]').val(shop.address);
                modal.find('.modal-body input[name="telphone"]').val(shop.telphone);
                modal.find('.modal-body input[name="phone"]').val(shop.phone);
                $('#timepicker_s1').data("DateTimePicker").date(shop.business_hours_start_time);
                $('#timepicker_e1').data("DateTimePicker").date(shop.business_hours_end_time);
                $(':checkbox[name="special"]', modal).prop("checked", shop.special);
                $(':checkbox[name="status"]', modal).prop("checked", shop.status);
                $(':checkbox[name="i_pass"]', modal).prop("checked", shop.i_pass);
                var closedDay = JSON.parse(shop.closed_day);
                for (i = 0; i < 7; i++) {
                    $('#inlineCheckbox' + i).prop("checked", false);
                }
                if (closedDay.length > 0) {
                    $.each(closedDay, function (i, item) {
                        $('#inlineCheckbox' + item).prop("checked", true);
                    });
                }
                if (shop.area == null) {
                    $('form.areaFormInUpdate input[name="name"]', modal).val('');
                } else {
                    $('form.areaFormInUpdate input[name="name"]', modal).val(shop.area.name);
                    addAreaToTag(shop.area, '#area_update_collection');
                }
            });

            areaDynamicSearch('.areaForm', '#area_collection');
            areaDynamicSearch('.areaFormInUpdate', '#area_update_collection');

            $(document).on('click', 'button.areaBtn', function () {
                $(this).remove();
            });

            // area 搜尋框
            function areaDynamicSearch (target, collection) {
                $(target).submit(function () {
                    $.post(
                        apiDomain + '/area/search/fuzzy',
                        $(target).serializeArray(),
                        function (res) {
                            if (res.data.length > 0) {
                                clearTag(collection);
                                $.each(res.data, function (i, item) {
                                    addAreaToTag(item, collection);
                                });
                            }
                        }
                    );
                    return false;
                });
            }

            function clearTag(collection) {
                $(collection).html('');
            }

            function addAreaToTag(item, collection) {
                var parent_name = '';
                if (item.parent != null) {
                    parent_name = item.parent.name + ' > ';
                }
                var name = parent_name + item.name;
                areaTag(name, item.id, collection);
            }

            function areaTag(name, id, collection) {
                var clone = $('#area_smaple').clone();
                $('input[name="area_id"]', clone).val(id);
                $('span.text', clone).text(name);
                clone.removeAttr('id').removeClass('hidden').appendTo(collection);
            }

        });
    </script>
@endsection