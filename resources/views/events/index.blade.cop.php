@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-12 text-center">
                    <a href="{{ url('events/create') }}" class="btn btn-outline-success">種目を追加する</a>
                </div>
                
                @if (isset($all_events))
                    <form method="POST" action="{{ route('event_select') }}">
                    @csrf
                    @foreach ($all_events as $event)
                        <div class="card">
                            <div class="card-haeder p-3 w-100 d-flex">
                                <div class="ml-2 d-flex flex-column">
                                    <!-- <input type="checkbox" id="{{ $event->event_name }}" name="event_name" value="{{ $event->id }}"><label class="mb-0" for="{{ $event->event_name }}">{{ $event->part }} : {{ $event->event_name }}</label> -->
                                    <label for="enent_name">{{ $event->part }} : {{ $event->event_name }}
                                    <input type="checkbox" name="events[]" value="{{ $event->id }}" id="event_name">
                                    </label>
                                    <a href="{{ url('events/' .$event->id .'/destroy') }}" class="dropdown-item">編集</a>
                                    <!-- <form method="POST" action="{{ url('events/' .$event->id) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')

                                        <input type="hidden" value="{{ $event->id }}">
                                        <button type="submit" class="btn btn-success btn-sm">削除</button>
                                    </form>  -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    トレログ！！
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>        
    </div>
@endsection