<html lang="ja">
<head>
<meta charset="UTF-8">
<title>edit.php</title>
</head>
<body>
<a href="http://localhost/">Laravel News</a><!--トップへのリンク-->
<section>
<article>
    <div class="article_class">
        <h2><?php echo $article_detail['title']; ?></h2><!--でview_name(タイトル)を出力-->
    </div>
    <p><?php  echo $article_detail['article']; ?></p><!--<ｐ>でmessage(記事)を出力-->
    <hr><!--下線部-->
</article> 

<form method="POST" action="{{ route('comment_save', $article_detail->id) }}" onsubmit="return ask()">
    @csrf
     <!--フォームの作成とmethodで通信方式の指定、今回はpost。onsubmit属性で送信時に関数ask()を呼び出し、ok(true)で投稿処理がされる。-->
    <div>
        <label for="comment">コメント</label><!--タイトル部分のフォーム、view_nameの部分にタイトルで入力されたデータが入る-->
        <input id="comment" type="text" name="comment" value=""><!--type属性で30字以内の1行のtextに指定、phpで受け取ったデータを引用するために名前をname属性に-->
        <input id="article_id" type="hidden" name="article_id" value="<?php echo $article_detail['id']; ?>">
    </div>
    <button type="submit" name="btn_submit">投稿</button><!--投稿ボタン--> 
</form>
<hr>
@if( !empty($comment_detail) )<!--$message_arrayの中身が空でなければ-->
    @foreach($comment_detail as $comment_list)
<!--$message_arrayから入力されたデータを取り出し$valueに入れる-->
        <comment>
            <p><?php echo nl2br($comment_list['comment']); ?></p><!--<ｐ>で$comment_listに入っている(コメント)を出力-->
            <form method ="POST" action="{{ route('destroy', $comment_list)}}"><!--削除用のルート('destroy')に$comment_listを送信。-->
                @csrf
                @method('delete')
                <button type="submit">削除</button>
            </form>
            <hr><!--下線部-->
        </comment>
    @endforeach
@endif 
</section>
</body>
</html>

