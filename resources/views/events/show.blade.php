<!-- routeファイルでreturn view('contact.index')でルーティングする -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $event->part }}
                    {{ $event->event_name }}

                    <form method="GET" action="{{ url('events/' .$event->id. '/edit') }}">
                    @csrf

                    <input class="btn btn-info" type="submit" value="変更する">
                    </form>

                    <form method="POST" action="{{ url('events/' .$event->id)}}" id="delete_{{ $event->id}}"> 
                    @csrf
                    @method('DELETE')

                    <a href="#" class="btn btn-danger" data-id="{{ $event->id }}" onclick="deletePost(this);" >削除する</a>
                    </form>
                    {{-- <form method="POST" action="{{ route('events.destroy', ['id' => $event->id ])}}" id="delete_{{ $contact->id}}"> 
                        @csrf
                        <a href="#" class="btn btn-danger" data-id="{{ $contact->id }}" onclick="deletePost(this);">削除する</a>
                    </form> --}}
                    {{-- <form method="POST" action="{{ url('tweets/' .$tweet->id) }}" class="mb-0">
                        @csrf
                        @method('DELETE')

                        <a href="{{ url('tweets/' .$tweet->id .'/edit') }}" class="dropdown-item">編集</a>
                        <button type="submit" class="dropdown-item del-btn">削除</button>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function deletePost(e) {
    'use strict';
    if (confirm('本当に削除していいですか?')) {
    document.getElementById('delete_' + e.dataset.id).submit();
    }
}
</script>

@endsection
