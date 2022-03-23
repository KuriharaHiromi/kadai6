<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller{
    public function show_detail($id){
        $show_detail = Article::find($id);//select * from `articles` where `articles`.`id` = 'url上のid' limit 1
        $comments = $show_detail->comments_r()->orderBy('created_at', 'desc')->get();//select * from `comments` where `comments`.`article_id` = url上のid and `comments`.`article_id` is not null order by `created_at` desc
        //↑投稿時間が時間が後のものから順に表示されるように並び替えて表示
        return view('article.detail')->with(["article_detail" => $show_detail, "comment_detail" => $comments]);
    }

    public function comment_save(CommentRequest $request) {
        $comment_inputs = $request->all();
    
        \DB::beginTransaction();
         try{
            Comment::create($comment_inputs);//insert into `comments` (`comment`, `article_id`, `updated_at`, `created_at`) values ('コメントの内容', 'urlのid', '作成時間', '作成時間')
            \DB::commit();
         }catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
    
        return redirect(route('show', [$comment_inputs['article_id']]));
            
    }    

    public function comment_destroy($comment_list){
        $back_id = Comment::find($comment_list);//select * from `comments` where `comments`.`id` = '選択したコメントのID' limit 1
        try{
            Comment::destroy($comment_list);//delete from `comments` where `id` = 選択したコメントのID
         }catch(\Throwable $e) {
            abort(500);
        }

        return redirect(route('show', [$back_id['article_id']]));

    }

}



