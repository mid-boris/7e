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
                        <th class="col-xs-1">#</th>
                        <th>名稱</th>
                        <th class="col-xs-1">電話</th>
                        <th class="col-xs-1">手機</th>
                        <th>營業時間</th>
                        <th class="col-xs-1">地區</th>
                        <th class="col-xs-1">狀態</th>
                        <th class="col-xs-1">圖檔</th>
                        <th class="col-xs-1">菜單</th>
                        <th class="col-xs-1"></th>
                        <th class="col-xs-1">最後修改時間</th>
                        <th class="col-xs-1"></th>
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
                            <td>{{$item->status == 1 ? 'V' : ''}}</td>
                            <td><a href="/shopImages?id={{$item->id}}" class="btn btn-info">Images</a></td>
                            <td><a href="#" class="btn btn-info">Menus</a></td>
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
        <div class="modal-dialog modal-lg" role="document">
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
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Address" name="address">
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-secondary mapSearch" type="button">地圖</button>
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
                                            <label class="checkbox-inline">
                                                <input name="special" type="checkbox" value="1">
                                                特約
                                            </label>
                                            <label class="checkbox-inline">
                                                <input name="status" type="checkbox" value="1">
                                                啟用
                                            </label>
                                            <label class="checkbox-inline">
                                                <input name="i_pass" type="checkbox" value="1">
                                                一卡通
                                            </label>
                                        </div>
                                    </div>
                                    <div class="hidden map-area" style="height: 500px;">
                                        <div id="google-map" style="height: 100%"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10 checkbox" id="area_collection">
                                        </div>
                                    </div>
                                    <input type="hidden" name="mapInfo" value="">
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
        <div class="modal-dialog modal-lg" role="document">
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
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Address" name="address">
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-secondary mapSearch" type="button">地圖</button>
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
                                            <label class="checkbox-inline">
                                                <input name="special" type="checkbox" value="1">
                                                特約
                                            </label>
                                            <label class="checkbox-inline">
                                                <input name="status" type="checkbox" value="1" checked>
                                                啟用
                                            </label>
                                            <label class="checkbox-inline">
                                                <input name="i_pass" type="checkbox" value="1">
                                                一卡通
                                            </label>
                                        </div>
                                    </div>
                                    <div class="hidden map-area" style="height: 500px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10 checkbox" id="area_update_collection">
                                        </div>
                                    </div>
                                    <input type="hidden" name="mapInfo" value="">
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
    <script src="https://maps.googleapis.com/maps/api/js?key={{$googleMapKey}}"
            async defer></script>
    <script>
        // google map用
        var map;

        $(document).ready(function() {
            datetimepickerInit();

            $('#shopCreateBtn').click(function () {
                $('#shopCreateForm').submit();
            });
            $('#shopUpdateBtn').click(function () {
                $('#shopUpdateForm').submit();
            });

            // 修改按鈕
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

            // 地址查詢按鈕
            $('form#shopCreateForm button.mapSearch').click(addressSearch);
            $('form#shopUpdateForm button.mapSearch').click(addressSearch);
            // 沒查詢地圖資訊前 不給新增或修改資訊
            $('#shopCreateForm').submit(submitValidate);
            $('#shopUpdateForm').submit(submitValidate);
        });

        // 時間選擇器初始化
        function datetimepickerInit()
        {
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
        }

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

        function initMap(form, mapId, data) {
            var lat = data.geometry.location.lat;
            var lng = data.geometry.location.lng;
            var area = form.find('.map-area');
            area.removeClass('hidden');
            var googleMapDiv = $('div#' + mapId);
            area.append(googleMapDiv);
            map = new google.maps.Map(document.getElementById(mapId), {
                center: {lat: lat, lng: lng},
                zoom: 15
            });
            var marker = new google.maps.Marker({
                position: data.geometry.location,
                map: map
            });
        }

        // 地址查詢事件
        function addressSearch()
        {
            var address = $(this).parent().prev().find('input[name=address]').val();
            var form = $(this).parent().parent().parent();
            var btn = $(this);
            btn.attr('disabled', true);
            $.post(
                apiDomain + '/shop/map',
                {address: address},
                function (res) {
                    if (res.data) {
                        form.children('input[name=mapInfo]').val(JSON.stringify(res.data));
                        btn.attr('disabled', false);
                        initMap(form, 'google-map', res.data);
                        alert( "地圖資訊讀取成功" );
                    } else {
                        alert( "地圖資訊獲得錯誤" );
                        btn.attr('disabled', false);
                    }
                }
            ).fail(function() {
                alert( "地圖資訊獲得錯誤" );
                btn.attr('disabled', false);
            });
        }

        // 先判斷是否查詢過地圖資訊
        function submitValidate() {
            var mapInfo = $(this).children('input[name=mapInfo]').val();
            if(mapInfo == '') {
                alert('請先搜尋地圖資訊');
                return false;
            }
        }
    </script>
@endsection