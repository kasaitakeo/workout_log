<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        //
        $user = auth()->user();
        $all_events = $event->getAllEvents(auth()->user()->id);

        return view('events.index', [
            'user' => $user,
            'all_events'  => $all_events
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
        $user = auth()->user();

        return view('events.create', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        //
        $user = auth()->user();
        $event_datas = $request->all();
        // $validator = Validator::make($data, [
        //     'text' => ['required', 'string', 'max:140']
        // ]);

        // $validator->validate();
        $event->eventStore($user->id, $event_datas);

        return redirect('events');
    }

    public function event_select(Request $request, Event $event)
    {
        $user = auth()->user();
        $data = $request->all();
        // dd($data);

        $event_ids = $data['events'];
        // dd($event_ids);
        foreach ($event_ids as $event_id) {

            $event_datas[] = $event->getEvents($event_id);

            // dd($event_datas);
            // foreach ($event_datas as $event_data) {
            //     $event_names[] = $event_data->event_name;
            //     $event_parts[] = $event_data->part;
            // }
            // 重複しないよう初期化 $event_datas[]にもともと入っていた$event_idも一緒にforeachしてしまう
            // $event_datas = null;
        }
        $request->session()->put('event_datas', $event_datas);
        // dd($event_datas);

        // $request->session()->put('event_names', $event_names);
        // $request->session()->put('event_parts', $event_parts);
        // $product = array(1,2,3,4);
        // Session::Push('cart', $product);

        return view('sessions.index', [
            'user' => $user,
            // 'event_datas' => $event_datas
        ]);
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
    public function destroy($id)
    {
        //
    }
}
