@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-12 text-center">
                    <a href="{{ url('events/create') }}" class="btn btn-outline-success">種目を追加する</a>
                </div>
                @if (isset($all_events))
                    <form method="POST" action="{{ route('eventtweet') }}">
                    @csrf
                    @foreach ($all_events as $event)
                        <div class="card">
                            <div class="card-haeder p-3 w-100 d-flex">
                                <div class="ml-2 d-flex flex-column">
                                    <!-- <input type="checkbox" id="{{ $event->event_name }}" name="event_name" value="{{ $event->id }}"><label class="mb-0" for="{{ $event->event_name }}">{{ $event->part }} : {{ $event->event_name }}</label> -->
                                    <input type="checkbox" name="events[]" value="{{ $event->id }}">{{ $event->part }} : {{ $event->event_name }}</label>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p class="mb-4 text-danger">140文字以内</p>
                                <button type="submit" class="btn btn-primary">
                                    ツイートする
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>        
    </div>
@endsection