@extends("layout")
@section("title","ブログ一覧")
@section("content")
<div class="row">
    <div class="col-md-12 col-md-offset-2">
        <h2>ブログ記事一覧</h2>
        @if (session('message'))
        <div class="text-danger">
            {{ session('message') }}
        </div>
        @endif
       
        <table class="table table-striped">
            <tr>
                <th>記事番号</th>
                <th>タイトル</th>
                <th>日付</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($blogs as $blog)
            <tr>
                <td>{{$blog->id}}</td>
                <td><a href="/blog/{{ $blog->id }}">{{$blog->title}}</a></td>
                <td>{{$blog->updated_at}}</td>

                <td><button type="btn" class="btn btn-primary" onclick="location.href='/blog/edit/{{ $blog->id }}'">編集</button></td>
                <td><button type="btn" class="btn btn-primary" onclick="location.href='/blog/delete/{{ $blog->id }}'">削除</button></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection