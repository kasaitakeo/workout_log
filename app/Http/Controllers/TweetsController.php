<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Event;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tweet $tweet, Follower $follower)
    {
        // それぞれのModelにデータを渡していきます
        $user = auth()->user();
        $follow_ids = $follower->followingIds($user->id);
        // followed_idだけ抜き出す following_idは自分のidでいらないから
        $following_ids = $follow_ids->pluck('followed_id')->toArray();

        $timelines = $tweet->getTimelines($user->id, $following_ids);

        return view('tweets.index', [
            'user'      => $user,
            'timelines' => $timelines
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ツイート投稿機能
    public function create()
    {
        $user = auth()->user();

        return view('tweets.create', [
            'user' => $user,
        ]);
    }

    // ツイート投稿機能
    // public function event_tweet(Request $request, Event $event)
    // {
    //     $user = auth()->user();
    //     $data = $request->all();

    //     $event_ids = $data['events'];
    //     $event_datas = $event->getEvents($event_ids);
        
    //     // dd($event_datas);
    //     return view('tweets.create', [
    //         'user' => $user,
    //         'event_datas' => compact('event_datas')
    //     ]);
    // }
    // ツイート投稿機能
    public function event_tweet(Request $request, Event $event)
    {
        $user = auth()->user();
        $data = $request->all();

        $event_ids = $data['events'];
        // dd($event_ids);
        foreach ($event_ids as $event_id) {
            $event_datas[] = $event->getEvents($event_id);
        }
        // dd($event_datas);
        return view('tweets.create', [
            'user' => $user,
            'event_datas' => $event_datas
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // リクエストから取得したデータをバリデーションしてModels/Tweet.phpのtweetStore()にデータを渡します
    public function store(Request $request, Tweet $tweet)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string', 'max:500']
        ]);

        $validator->validate();
        $tweet->tweetStore($user->id, $data);

        // $request->session()->flush();
        $request->session()->forget('event_datas');
        $request->session()->forget('play_datas');

        return redirect('tweets');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet, Comment $comment)
    {
        $user = auth()->user();
        $tweet = $tweet->getTweet($tweet->id);
        $comments = $comment->getComments($tweet->id);

        return view('tweets.show', [
            'user'     => $user,
            'tweet' => $tweet,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 編集するツイートをModels/Tweet.phpのgetEditTweetに$tweet_idを渡してその結果をViewに渡す処理をします
    public function edit(Tweet $tweet)
    {
        $user = auth()->user();
        $tweets = $tweet->getEditTweet($user->id, $tweet->id);

        if (!isset($tweets)) {
            return redirect('tweets');
        }

        return view('tweets.edit', [
            'user'   => $user,
            'tweets' => $tweets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'text' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();
        $tweet->tweetUpdate($tweet->id, $data);

        return redirect('tweets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // $user_idと$tweet_idをModels/Tweet.phpで作成したtweetDestroy()メソッドに渡しています
    public function destroy(Tweet $tweet)
    {
        $user = auth()->user();
        $tweet->tweetDestroy($user->id, $tweet->id);

        return back();
    }
}
