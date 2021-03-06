@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="文章審核">
            文章審核
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">文章審核</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">文章審核</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover trToggleCheckbox col-md-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>發文者</th>
                        <th>標題</th>
                        <th>內文</th>
                        <th>投票項目</th>
                        <th></th>
                        <th>發文時間</th>
                        <th>審核者</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($article as $key => $item)
                        <tr article='@json($item)'>
                            <td scope="row">{{$key}}</td>
                            <td>{{$item->user_account}}({{$item->user_nick_name}})</td>
                            <td>
                                @if(is_null($item->parent_id))
                                    <span>{{$item->title}}</span>
                                @else
                                    <a href="/article?parent_id={{$item->parent_id}}">{{$item->title}}</a>
                                @endif
                            </td>
                            <td><textarea id="contentId" class="form-control" rows="5" name="content" readonly>{{$item->context}}</textarea></td>
                            <td>
                                @if($item->vote_max_count == 1 && $item->voteOption->count() > 0)
                                    <h6>單選</h6>
                                @elseif($item->vote_max_count > 1 && $item->voteOption->count() > 0)
                                    <h6>複選: 一人最多{{$item->vote_max_count}}票</h6>
                                @endif
                                @foreach($item->voteOption as $option)
                                    <input type="text" class="form-control" value="{{$option->option_name}}" readonly/>
                                @endforeach
                            </td>
                            <td>
                                @if($item->audit == 1)
                                    <form method="post" action="/article_audit/auditPass">
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-danger">通過</button>
                                    </form>
                                @else
                                    <button type="submit" class="btn btn-danger" disabled>通過</button>
                                @endif
                            </td>
                            <td>
                                <h6>{{date('Y-m-d', strtotime($item->updated_at->toDateTimeString()))}}</h6>
                                <h6>{{date('H:i:s', strtotime($item->updated_at->toDateTimeString()))}}</h6>
                            </td>
                            <td>
                                @if(is_null($item->audit_user_id))
                                    Non
                                @else
                                    {{$item->audit_user_account}}
                                @endif
                            </td>
                            <td>
                                <form method="get" action="/article_audit/delete">
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
                {!! $article->appends($parameter)->render() !!}
            </div>
        </div>
    </section>

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