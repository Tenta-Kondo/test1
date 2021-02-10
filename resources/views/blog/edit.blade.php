@extends('layout')
@section('title', 'ブログ編集')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>ブログ編集フォーム</h2>
        <form method="POST" action="/blog/update/{{$blogs->id}}" onSubmit="return checkSubmit()">
            <!-- routestore => name-->
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$blogs->id}}">
            <div class="form-group">
                <label for="title">
                    タイトル
                </label>
                <input id="title" name="title" class="form-control" value="{{ $blogs->title }}" type="text">
                @if ($errors->has('title'))
                <!-- titleのバリデーションがあるか -->
                <div class="text-danger">
                    {{ $errors->first('title') }}
                    <!--最初に引っかかったもの -->
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">
                    本文
                </label>
                <textarea id="contents" name="contents" class="form-control" rows="4">{{ $blogs->contents }}</textarea>
                @if ($errors->has('contents'))
                <div class="text-danger">
                    {{ $errors->first('contents') }}
                </div>
                @endif
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('blogs') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function checkSubmit() {
        if (window.confirm('更新してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection