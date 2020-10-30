@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (isset($all_events))
                    <form method="POST" action="{{ route('tweets.create') }}">
                    @foreach ($all_events as $event)
                        <div class="card">
                            <div class="card-haeder p-3 w-100 d-flex">
                                <div class="ml-2 d-flex flex-column">
                                    <!-- <label class="mb-0">{{ $event->part }} : -->
                                    <!-- <input type="checkbox" id="scales" name="event_name"><label for="scales">{{ $event->event_name }}</label> -->
                                    <input type="checkbox" id="{{ $event->event_name }}" name="{{ $event->event_name }}" value="{{ $event->event_name }}"><label class="mb-0" for="{{ $event->event_name }}">{{ $event->part }} : {{ $event->event_name }}</label>
                                    <!-- <span class="mb-0">{{ $event->event_name }}</span> -->
                                    <!-- </label> -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </form>
                @endif
            </div>
            <a href="{{ url('events/create') }}" class="btn btn-md btn-primary">種目を追加する</a>
        </div>        
    </div>
@endsection