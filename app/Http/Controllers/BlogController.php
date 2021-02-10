<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;//バリデーションを使う時はここにかく
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function showList()
    {
        $blogs = Blog::all();

        return view("blog.list", compact("blogs"));
    }
    /**
     * @param int $id
     * @return view
     */
    public function showDetail($id)
    {
        $blogs = Blog::find($id);
        if (is_null($blogs)) {
            session()->flash("err_msg", "データがありません");
            return redirect(route("blogs"));
        }
        return view("blog.detail", compact("blogs"));
    }
    public function showCreate()
    {
        return view("blog.form");
    }
    public function exeStore(BlogRequest $request) //useで指定したRequests/BlogRequestを引数に入れることでバリデーションを適用
    {  //ブログのデータを受け取る
        $title = $request->input("title");
        $contents = $request->input("contents");
        DB::beginTransaction(); //エラーがあったら処理を行わない
        try {
            //$inputの中身をブログを登録

            \App\Models\Blog::create(["title" => $title, "contents" => $contents]);

            DB::commit();
        } catch (\Throwable $e) {
            abort(500); //500エラーを表示させる
            DB::rollback();
        }


        return redirect(route("blogs"))->with("message", "投稿しました");
    }
    public function showEdit($id)
    {
        $blogs = Blog::find($id);
        if (is_null($blogs)) {
            session()->flash("err_msg", "データがありません");
            return redirect(route("blogs"));
        }
        return view("blog.edit", compact("blogs"));
    }
    public function exeUpdate(BlogRequest $request) //useで指定したRequests/BlogRequestを引数に入れることでバリデーションを適用
    {  //ブログのデータを受け取る
        $id = $request->input("id");
        $title = $request->input("title");
        $contents = $request->input("contents");
        DB::beginTransaction(); //エラーがあったら処理を行わない
        try {
            //$inputの中身をブログを登録

            $blog = \App\Models\Blog::find($id);
            $blog->fill(["title" => $title, "contents" => $contents]);
            $blog->save();
            DB::commit();
        } catch (\Throwable $e) {
            abort(500); //500エラーを表示させる
            DB::rollback();
        }


        return redirect(route("blogs"))->with("message", "更新しました");
    }
    public function exeDelete($id)
    {
        if (empty($id)) {
            session()->flash("err_msg", "データがありません");
            return redirect(route("blogs"));
        }

        try {

            Blog::destroy($id);
        } catch (\Throwable $e) {
            abort(500);
        }



        return redirect(route("blogs"))->with('message', '削除しました');
    }
}
