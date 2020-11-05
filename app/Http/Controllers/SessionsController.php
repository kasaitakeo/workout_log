<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class SessionsController extends Controller
{
    //
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        return view('sessions.index',
        [
            'user' => $user
        ]);
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
        $play_datas[] = $request->all();
        // dd($play_datas);
        $datas = session()->get('play_datas');
        // dd($data);
        if (isset($datas)) {
            foreach ($datas as $data) {
                $play_datas[] = $data;
            }
        }

        // dd($play_datas);
        $request->session()->put('play_datas', $play_datas);
        $data = session()->get('play_datas');
        // dd($data);
        // $request->session()->put('play_event', $request->input('play_datas'));
        // $request->session()->put('weight', $request->input('play_datas'));
        // $request->session()->put('rep', $request->input('play_datas'));
        // $request->session()->put('set', $request->input('play_datas'));
        // $request->session()->put('play_event', $request->input('event_name'));
        // $request->session()->put('weight', $request->input('weight'));
        // $request->session()->put('rep', $request->input('rep'));
        // $request->session()->put('set', $request->input('set'));
        // $request->session()->flash('message', 'セッションにデータを保存しました！');
        // $request->session()->flash('message', 'セッションにデータを保存しました！');
        // $request->session()->flash('message', 'セッションにデータを保存しました！');
        // $request->session()->flash('message', 'セッションにデータを保存しました！');
 
        return redirect('sessions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $request->session()->flush();
        return view('users/index');
    }

}

