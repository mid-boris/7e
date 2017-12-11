@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="權限管理">
            權限管理
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">權限管理</li>
        </ol>
    </section>
    <section class="content">
        <form id="roleNodeForm">

            <div class="row">
                <div class="col-md-5 form-inline form-group">
                    <label for="role">角色 </label>
                    <select class="form-control" id="role" name="role">
                        @foreach($role as $item)
                            <option value="{{$item->id}}" nodes='@json($item->nodeP)'>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-7 text-right">
                    <button type="submit" class="btn btn-primary">送出</button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">節點</h3>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-hover trToggleCheckbox">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>　</th>
                                    <th>節點名稱</th>
                                    <th>Uri</th>
                                    <th>最後修改時間</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($node as $key => $item)
                                    <tr nodeId="{{$item->id}}">
                                        <th scope="row">{{$key}}</th>
                                        <td>
                                            <input name="node[]" type="checkbox" value="{{$item->id}}">
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->uri}}</td>
                                        <td>{{$item->updated_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            roleChange();

            $('#role').change(function () {
                roleChange();
            });

            $('#roleNodeForm').submit(function () {
                $.post(
                    apiDomain + '/system/permission/update',
                    $('#roleNodeForm').serializeArray(),
                    function (res) {
                        if (res.data == true) {
                            alert('更新成功');
                            location.reload();
                        }
                    }
                );
                return false;
            });
        });

        function roleChange() {
            roleNode = JSON.parse($('#role option:selected').attr('nodes'));
            $('input[name="node[]"]').prop("checked", false);
            $.each(roleNode, function (index, value) {
                $('table.trToggleCheckbox tbody tr').each(function (i) {
                    nodeId = $(this).attr('nodeId');
                    if (value.node_id == nodeId) {
                        $(':checkbox', this).prop("checked", true);
                    }
                });
            });
        }
    </script>
@endsection