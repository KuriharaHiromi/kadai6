<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;//ArticleのModelを使用
use App\Http\Requests\ArticleRequest;//ArticleRequestのバリデーションを使用

class ArticleController extends Controller
{
    //記事一覧部分 

    public function article_view(){
        //SELECT * FROM articles ORDER BY id DESC;
        $articles = Article::orderBy('id', 'desc')->get();//Model名Articleに紐づいたデータベースから主キーを降順で取得
        //viewsのarticleのフォルダのlistファイルを指定
        return view('article.index',
         ['articles' => $articles]);//viewsのarticleのindexのファイルに$articlesを入れたルート名'articles'を渡す
    }

    public function article_save(ArticleRequest $request) {//関数の宣言と一緒にバリデーション(ArticleRequestを$requestに入れて)の設定
        $inputs = $request->all();

        \DB::beginTransaction();
        try{
            Article::create($inputs);
            \DB::commit();
        }catch(\Throwable $e) {
            \DB::rollback();
            echo "エラー" . $e->getMessage();
        }

        return redirect(route('articles'));
        
    }



}

