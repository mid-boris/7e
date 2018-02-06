@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="商家管理">
            優惠管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">優惠管理</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$shop->name}}</h3>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#discountCreateModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>優惠類型</th>
                        <th>優惠內容</th>
                        <th>開始時間</th>
                        <th>結束時間</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($discount as $key => $item)
                        <tr discount='@json($item)'>
                            <th scope="row">{{$key}}</th>
                            <td>{{trans('shop::discount.' . $item->type)}}</td>
                            <td>
                                @switch($item->type)
                                @case(1)
                                    {{$shop->menu->where('id', $item->menu_id)->first()->name}} {{$item->action}} {{$item->numeric}}
                                    @break
                                @case(2)
                                @case(5)
                                @case(8)
                                @case(9)
                                    total {{$item->action}} {{$item->numeric}}
                                    @break
                                @case(3)
                                @case(6)
                                @case(7)
                                    {{$item->custom}}
                                    @break
                                @case(4)
                                    {{$item->age}} 歲以下 {{$item->action}} {{$item->numeric}}
                                    @break
                                @endswitch
                            </td>
                            <td>{{$item->start_time ? date('Y-m-d', $item->start_time) : '無'}}</td>
                            <td>{{$item->end_time ? date('Y-m-d', $item->end_time - (24 * 60 * 60)) : '無'}}</td>
                            <th><button type="button" class="btn btn-default" data-toggle="modal" data-target="#discountEditModal">修改</button></th>
                            <td>
                                <form method="get" action="/discount/delete">
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
                {!! $discount->appends($parameter)->render() !!}
            </div>
        </div>
    </section>

    <div class="modal fade" id="discountCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="inline">
                        <h5 class="modal-title">新增優惠</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal inputValidate" method="post" action="/discount/create">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">類型</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="type">
                                            @foreach($discountType as $type)
                                                <option value="{{$type}}">{{trans('shop::discount.' . $type)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group discount-content">
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label class="checkbox-inline">
                                            <input name="status" type="checkbox" value="1" checked>
                                            啟用
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">開始日期</label>
                                    <div class="col-sm-4">
                                        <input data-provide="datepicker" name="start_time" class="validateExcept">
                                        <small class="text-muted">
                                            (選填)
                                        </small>
                                    </div>
                                    <label class="col-sm-2 control-label">結束日期</label>
                                    <div class="col-sm-4">
                                        <input data-provide="datepicker" name="end_time" class="validateExcept">
                                        <small class="text-muted">
                                            (選填)
                                        </small>
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

    <div class="modal fade" id="discountEditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">編輯優惠</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="">
                        <form class="form-horizontal" method="post" action="/discount/update">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">類型</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="type">
                                            @foreach($discountType as $type)
                                                <option value="{{$type}}">{{trans('shop::discount.' . $type)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group discount-content">
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10 checkbox">
                                        <label class="checkbox-inline">
                                            <input name="status" type="checkbox" value="1" checked>
                                            啟用
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">開始日期</label>
                                    <div class="col-sm-4">
                                        <input data-provide="datepicker" name="start_time" class="validateExcept">
                                        <small class="text-muted">
                                            (選填)
                                        </small>
                                    </div>
                                    <label class="col-sm-2 control-label">結束日期</label>
                                    <div class="col-sm-4">
                                        <input data-provide="datepicker" name="end_time" class="validateExcept">
                                        <small class="text-muted">
                                            (選填)
                                        </small>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="">
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

    <div class="hidden" id="discount-example">
        <div id="discount-1">
            <label for="inputEmail3" class="col-sm-2 control-label">菜單</label>
            <div class="discount-content inline">
                <div class="col-sm-3">
                    <select class="form-control" name="menu_id">
                        @foreach($shop->menu as $menu)
                            <option value="{{$menu->id}}">{{$menu->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="action">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="x">x</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="ex: 200, 0.8" name="numeric" step="0.01">
                </div>
            </div>
        </div>
        <div id="discount-2">
            <label for="inputEmail3" class="col-sm-2 control-label">優惠</label>
            <div class="discount-content inline">
                <div class="col-sm-3">
                    <select class="form-control" name="action">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="x">x</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="ex: 200, 0.8" name="numeric" step="0.01">
                </div>
            </div>
        </div>
        <div id="discount-3">
            <label for="inputEmail3" class="col-sm-2 control-label">文字優惠</label>
            <div class="discount-content inline">
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="ex: 衣服買三送一, 五人同行一人免費" name="custom">
                </div>
            </div>
        </div>
        <div id="discount-4">
            <label for="inputEmail3" class="col-sm-2 control-label">年紀優惠</label>
            <div class="discount-content inline">
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Age" name="age" step="0.01">
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="action">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="x">x</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="ex: 200, 0.8" name="numeric" step="0.01">
                </div>
            </div>
        </div>
        <div id="discount-5">
            <label for="inputEmail3" class="col-sm-2 control-label">折扣</label>
            <div class="discount-content inline">
                <div class="col-sm-3">
                    <select class="form-control" name="action">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="x">x</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="ex: 200, 0.8" name="numeric" step="0.01">
                </div>
            </div>
        </div>
        <div id="discount-6">
            <label for="inputEmail3" class="col-sm-2 control-label">紅利回饋</label>
            <div class="discount-content inline">
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="ex: 滿1000送500紅利" name="custom">
                </div>
            </div>
        </div>
        <div id="discount-7">
            <label for="inputEmail3" class="col-sm-2 control-label">紅利增額</label>
            <div class="discount-content inline">
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="ex: 紅利限時2倍" name="custom">
                </div>
            </div>
        </div>
        <div id="discount-8">
            <label for="inputEmail3" class="col-sm-2 control-label">優惠</label>
            <div class="discount-content inline">
                <div class="col-sm-3">
                    <select class="form-control" name="action">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="x">x</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="ex: 200, 0.8" name="numeric" step="0.01">
                </div>
            </div>
        </div>
        <div id="discount-9">
            <label for="inputEmail3" class="col-sm-2 control-label">優惠</label>
            <div class="discount-content inline">
                <div class="col-sm-3">
                    <select class="form-control" name="action">
                        <option value="+">+</option>
                        <option value="-">-</option>
                        <option value="x">x</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="ex: 200, 0.8" name="numeric" step="0.01">
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        var lastModal;
        $(document).ready(function() {
            $('#discountCreateModal').on('show.bs.modal', function (event) {
                var modal = $(this);
                lastModal = modal;
                var form = $('form', modal);
                var id = $('select[name=type] option:selected', form).val();
                discountContentChange(id);
            });
            $('#discountEditModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var discount = JSON.parse(button.parent().parent().attr('discount'));
                var modal = $(this);
                lastModal = modal;

                modal.find('.modal-body input[name="id"]').val(discount.id);
                modal.find('.modal-body select[name="type"]').children().each(function () {
                    if ($(this).val() == discount.type) {
                        $(this).attr("selected", true);
                    }
                });
                $('input[name=status]:checkbox', modal).prop("checked", discount.status);
                discountContentChange(discount.type);
                if (discount.menu_id) {
                    modal.find('.modal-body select[name="menu_id"]').children().each(function () {
                        if ($(this).val() == discount.menu_id) {
                            $(this).attr("selected", true);
                        }
                    });
                }
                if (discount.age) {
                    modal.find('.modal-body input[name="age"]').val(discount.age);
                }
                if (discount.custom) {
                    modal.find('.modal-body input[name="custom"]').val(discount.custom);
                }
                if (discount.action) {
                    modal.find('.modal-body select[name="action"]').children().each(function () {
                        if ($(this).val() == discount.action) {
                            $(this).attr("selected", true);
                        }
                    });
                }
                if (discount.numeric) {
                    modal.find('.modal-body input[name="numeric"]').val(discount.numeric);
                }

                if (discount.start_time) {
                    var dateFormat = 'mm/dd/yy';
                    var startTime = $.datepicker.formatDate(dateFormat, new Date(discount.start_time * 1000));
                    modal.find('.modal-body input[name="start_time"]').val(startTime);
                }
                if (discount.end_time) {
                    var dateFormat = 'mm/dd/yy';
                    var endTime = $.datepicker.formatDate(dateFormat, new Date((discount.end_time - 24 * 60 * 60) * 1000));
                    modal.find('.modal-body input[name="end_time"]').val(endTime);
                }
            });
            $('select[name=type]').change(function () {
                var id = $('option:selected', $(this)).val();
                discountContentChange(id);
            });
            
            // 送出前需驗證 input 欄位皆為必填
            $('form.inputValidate').submit(function () {
                var validate = true;
                $('input', $(this)).each(function () {
                    if (!$(this).hasClass('validateExcept')) {
                        if ($(this).val() == '') {
                            validate = false;
                            alert('欄位內請填入資訊');
                        }
                    }
                });
                return validate;
            });
        });

        function discountContentChange(id) {
            var target = $('div.discount-content', lastModal);
            var sample = $('#discount-' + id).html();
            target.html('');
            target.append(sample);
        }
    </script>
@endsection