<?php

// Userは元々app直下にあるのでapp/Modelsに移動してください。その際namespaceを変更するのを忘れずに
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // 通知先にしたいクラスで Notifiable trait を use するだけ
    // 通知先は以下の機能を持ちます。通知送信メソッド、通知に伴う通信先情報の提供
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // screen_nameとprofile_imageを追加したので、登録/更新を許可するために$fillableの配列にカラムを指定します。
    protected $fillable = [
        // 'name', 'email', 'password',
        'screen_name',
        'name',
        'profile_image',
        'email',
        'password'
    ];

    // ユーザーは複数人のユーザをフォローするため多対多のリレーションになる。→中間テーブルとしてfollowersテーブルにユーザ間の関係をまとめる

    // 第一引数で参照するテーブルを指定するが、今回は同一テーブルなので自身のテーブルになる。第二引数には中間テーブルとなるfolloersテーブルを指定。

    // followers()はフォローされているユーザIDから、フォローしているユーザIDにアクセスする。follows()はその逆向きのアクセス。
    
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    // 引数で受け取ったログインしているユーザを除くユーザを1ページにつき5名取得
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }

     // フォローする
     public function follow(Int $user_id) 
     {
         return $this->follows()->attach($user_id);
     }
 
     // フォロー解除する
     public function unfollow(Int $user_id)
     {
         return $this->follows()->detach($user_id);
     }
 
     // フォローしているか
     public function isFollowing(Int $user_id) 
     {
         return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
        //  return $this->follows()->where('followed_id', $user_id)->first(['id']);
     }
 
     // フォローされているか
     public function isFollowed(Int $user_id) 
     {
         return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
     }

    //  
    public function updateProfile(Array $params)
    {
        // $paramsの中に画像があれば処理を分けています
        if (isset($params['profile_image'])) {
            // $file_name = $params['profile_image']->store('public/profile_image/');こうすることで画像ファイルが/storage/app/public/profile_image/に保存されます。
            $file_name = $params['profile_image']->store('public/profile_image/');

            $this::where('id', $this->id)
                ->update([
                    'screen_name'   => $params['screen_name'],
                    'name'          => $params['name'],
                    'profile_image' => basename($file_name),
                    'email'         => $params['email'],
                ]);
        } else {
            $this::where('id', $this->id)
                ->update([
                    'screen_name'   => $params['screen_name'],
                    'name'          => $params['name'],
                    'email'         => $params['email'],
                ]); 
        }

        return;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
