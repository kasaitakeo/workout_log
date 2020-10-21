<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// デフォルトにないので追加
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Follower;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ユーザを取得するgetAllUsers()というメソッドにログインしているユーザIDを引数で渡しています。Modelから返ってきた結果をViewに返します。
    // メソッドインジェクション -> index()の引数はどこから来たの？？って思うかもしれません。LaravelにはDI（依存性の注入）というのが内蔵されており、メソッドの引数にインジェクトしたいオブジェクトを書くだけで、そのインスタンスが使用できます $user = new User;の様にわざわざインスタンスを発行する必要がなく、Userクラスに依存されないということです。
    public function index(User $user)
    {
        // ModelにgetAllUsersメソッドを書く
        // getAllUsersメソッド使用するのに$user = new User;書かなくてオッケ DI（依存性の注入）
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.index', [
            'all_users'  => $all_users
        ]);
    }

    // フォローとフォロー解除はresourceのどのアクションにも該当しないので、独自に追加
    // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            // グローバルなbackヘルパ関数はユーザーの直前のロケーションへのリダイレクトHTTPレスポンスを生成します。
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Tweet $tweet, Follower $follower)
    {
        // $login_userはログインしている自身の情報
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        // $timelinesはユーザのツイート情報
        $timelines = $tweet->getUserTimeLine($user->id);
        // $~~countってついてるのがカウント関連
        $tweet_count = $tweet->getTweetCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);

        return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'tweet_count'    => $tweet_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    // $requestで取得したデータをValidator::makeを使ってバリデーションをかけていきます
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        // Rule::unique('users')->ignore($user->id)の部分はユニークに設定しているscreen_nameやemailを自身のIDの時だけ無効にするという設定
        $validator = Validator::make($data, [
            'screen_name'   => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name'          => ['required', 'string', 'max:255'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);
        $validator->validate();
        $user->updateProfile($data);

        return redirect('users/'.$user->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
