<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// TweetテーブルではSoftDeleteという論理削除（削除してもDBには残るがシステム上削除したとみなす機能）を使える様に設定します。ついでに登録/更新を許可するために$fillableはtextカラムだけ許可しておきます。
use Illuminate\Database\Eloquent\softDeletes;


class Tweet extends Model
{
    //
    // SoftDeleteという論理削除（削除してもDBには残るがシステム上削除したとみなす機能）を使える様に設定
    // use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // $fillableはLaravelで用意されているメンバ変数です。$fillableにカラム名を定義するとそれ以外のカラムを登録/更新でエラーを吐きます。つまりホワイトリストですね。逆に$guardedというのはブラックリストで登録/更新できないカラムを指定します。基本的にはどちらでも可です
    protected $fillable = [
        'text'
    ];

    public function user()
    {
        // Eloquentリレーション
        // hasOneと同じ１対１の関係(ユーザーと個人情報など）
        // リレーションメソッド名＋_idのサフィックスをつけたものをデフォルトの外部キーにしているため、外部キーが異なる場合はメソッドの第２引数にカスタムキー名を渡す必要がある
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        // １対多の場合
        // メソッド名が複数形(favorites())になるのがポイント
        // Eloquentのコレクションという形でアクセスできる
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 自分のタイムラインのみ？
    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    }

    public function getTweetCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

    // 一覧画面
    // app/Models/Follower.phpのfollowingIds（）で取得したフォローしているユーザIDをControllerを介して取得したと仮定してそのデータを引数で渡します
    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
        // 自身とフォローしているユーザIDを結合する
        $follow_ids[] = $user_id;
        // 降順でソートする場合には DESC
        // whereInメソッドはカラムの値('user_id')のなかに指定した配列($follow_ids)が含まれている条件を加えます→つまりユーザーがフォローしている人のツイートのみ取ってくる
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }

    // 詳細画面 取得したツイートidを引数にしてツイート情報を取得
    public function getTweet(Int $tweet_id)
    {
        return $this->with('user')->where('id', $tweet_id)->first();
    }

    // Controllerでバリデーション通った前提でDBに保存する処理
    public function tweetStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->text = $data['text'];
        $this->save();

        return;
    }

    // $user_idと$tweet_idに値に一致するツイートを取得(ツイート編集のため)
    public function getEditTweet(Int $user_id, Int $tweet_id)
    {
        return $this->where('user_id', $user_id)->where('id', $tweet_id)->first();
    }

    // ツイートの編集
    public function tweetUpdate(Int $tweet_id, Array $data)
    {
        $this->id = $tweet_id;
        $this->text = $data['text'];
        $this->update();

        return;
    }

    // $user_idと$tweet_idに一致したツイートを削除
    public function tweetDestroy(Int $user_id, Int $tweet_id)
    {
        return $this->where('user_id', $user_id)->where('id', $tweet_id)->delete();
    }

}
