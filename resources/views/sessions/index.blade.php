@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create</div>
                    <div class="card-body">
                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                                <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $user->name }}</p>
                                    <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                                </div>
                                <div class="ml-4 d-flex flex-column">
                                    @if (Session::has('event_datas'))
                                        @foreach (Session::get('event_datas') as $event_data)
                                            @switch($event_data->part)
                                                @case('胸')
                                                    {{ $chestday[] =  $event_data->event_name }}
                                                    @break
                                                
                                                @case('背中')
                                                    {{ $backday[] =  $event_data->event_name }}
                                                    @break

                                                @case('肩')
                                                    {{ $shoulderday[] =  $event_data->event_name }}
                                                    @break

                                                @case('脚')
                                                    {{ $legday[] =  $event_data->event_name }}
                                                    @break

                                                @case('上腕二頭筋')
                                                    {{ $bicepsday[] =  $event_data->event_name }}
                                                    @break

                                                @case('上腕三等筋')
                                                    {{ $tricepsday[] =  $event_data->event_name }}
                                                    @break

                                                @case('腹筋')
                                                    {{ $absday[] =  $event_data->event_name }}
                                                    @break

                                                @default
                                                    {{ $day[] =  $event_data->event_name }}

                                            @endswitch
                                        @endforeach

                                        @if (isset($chestday))
                                            <p>胸：</p>
                                            @foreach ($chestday as $chestday_event)
                                                <form action="sessions" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="event_name" value="{{ $chestday_event }}">
                                                    {{ $chestday_event }}
                                                    <ul>
                                                        <li>重量：
                                                        <select name="weight">
                                                        @for ($i = 0; $i < 201; $i = $i + 2)
                                                            @if ($i === 50) {
                                                                <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                                @continue;
                                                            @endif
                                                        <option value="{{ $i }}">{{ $i }}KG</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>回数：
                                                        <select name="rep">
                                                        @for ($i = 0; $i < 30; $i++)
                                                            @if ($i === 10) {
                                                                <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                                @continue;
                                                            @endif
                                                        <option value="{{ $i }}">{{ $i }}REP</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>セット数：
                                                        <select name="set">
                                                        @for ($i = 0; $i < 30; $i++)
                                                            @if ($i === 1) {
                                                                <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                                @continue;
                                                            @endif
                                                        <option value="{{ $i }}">{{ $i }}SET</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                    </ul>
                                                    <button type="submit" class="btn btn-primary">追加する</button>
                                                </form>
                                                </br>
                                            @endforeach
                                        @endif
                                        @if (isset($backday))
                                            <p>背中：</p>
                                            @foreach ($backday as $backday_event)
                                                <form action="sessions" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="event_name" value="{{ $backday_event }}">
                                                    {{ $backday_event }}
                                                    <ul>
                                                        <li>重量：
                                                        <select name="weight">
                                                        @for ($i = 0; $i < 201; $i = $i + 2)
                                                            @if ($i === 50) {
                                                                <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                                @continue;
                                                            @endif
                                                        <option value="{{ $i }}">{{ $i }}KG</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>回数：
                                                        <select name="rep">
                                                        @for ($i = 0; $i < 30; $i++)
                                                            @if ($i === 10) {
                                                                <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                                @continue;
                                                            @endif
                                                        <option value="{{ $i }}">{{ $i }}REP</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>セット数：
                                                        <select name="set">
                                                        @for ($i = 0; $i < 30; $i++)
                                                            @if ($i === 1) {
                                                                <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                                @continue;
                                                            @endif
                                                        <option value="{{ $i }}">{{ $i }}SET</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                    </ul>
                                                    <button type="submit" class="btn btn-primary">追加する</button>
                                                </form>
                                                </br>
                                            @endforeach
                                        @endif
                                        @if (isset($shoulderday))
                                            <p>肩：</p>
                                            @foreach ($shoulderday as $shoulderday_event)
                                                <form action="sessions" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="event_name" value="{{ $shoulderday_event }}">
                                                    {{ $shoulderday_event }}
                                                    <ul>
                                                        <li>重量：
                                                        <select name="weight">
                                                        @for ($i = 0; $i < 201; $i = $i + 2)
                                                            @if ($i === 50) {
                                                                <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                                @continue;
                                                            @endif
                                                        <option value="{{ $i }}">{{ $i }}KG</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>回数：
                                                        <select name="rep">
                                                        @for ($i = 0; $i < 30; $i++)
                                                            @if ($i === 10) {
                                                                <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                                @continue;
                                                            @endif
                                                        <option value="{{ $i }}">{{ $i }}REP</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>セット数：
                                                        <select name="set">
                                                        @for ($i = 0; $i < 30; $i++)
                                                            @if ($i === 1) {
                                                                <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                                @continue;
                                                            @endif
                                                        <option value="{{ $i }}">{{ $i }}SET</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                    </ul>
                                                    <button type="submit" class="btn btn-primary">追加する</button>
                                                </form>
                                                </br>
                                            @endforeach
                                        @endif
                                        @if (isset($legday))
                                            <p>脚：</p>
                                                @foreach ($legday as $legday_event)
                                                    <form action="sessions" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="event_name" value="{{ $legday_event }}">
                                                        {{ $legday_event }}
                                                        <ul>
                                                            <li>重量：
                                                            <select name="weight">
                                                            @for ($i = 0; $i < 201; $i = $i + 2)
                                                                @if ($i === 50) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}KG</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>回数：
                                                            <select name="rep">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 10) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}REP</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>セット数：
                                                            <select name="set">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 1) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}SET</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                        </ul>
                                                        <button type="submit" class="btn btn-primary">追加する</button>
                                                    </form>
                                                    </br>
                                                @endforeach
                                        @endif
                                        @if (isset($bicepsday))
                                            <p>上腕二頭筋：</p>
                                                @foreach ($bicepsday as $bicepsday_event)
                                                    <form action="sessions" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="event_name" value="{{ $bicepsday_event }}">
                                                        {{ $bicepsday_event }}
                                                        <ul>
                                                            <li>重量：
                                                            <select name="weight">
                                                            @for ($i = 0; $i < 201; $i = $i + 2)
                                                                @if ($i === 50) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}KG</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>回数：
                                                            <select name="rep">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 10) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}REP</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>セット数：
                                                            <select name="set">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 1) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}SET</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                        </ul>
                                                        <button type="submit" class="btn btn-primary">追加する</button>
                                                    </form>
                                                    </br>
                                                @endforeach
                                        @endif
                                        @if (isset($tricepsday))
                                            <p>上腕三頭筋：</p>
                                                @foreach ($tricepsday as $tricepsday_event)
                                                    <form action="sessions" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="event_name" value="{{ $tricepsday_event }}">
                                                        {{ $tricepsday_event }}
                                                        <ul>
                                                            <li>重量：
                                                            <select name="weight">
                                                            @for ($i = 0; $i < 201; $i = $i + 2)
                                                                @if ($i === 50) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}KG</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>回数：
                                                            <select name="rep">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 10) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}REP</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>セット数：
                                                            <select name="set">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 1) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}SET</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                        </ul>
                                                        <button type="submit" class="btn btn-primary">追加する</button>
                                                    </form>
                                                    </br>
                                                @endforeach
                                        @endif
                                        @if (isset($absday))
                                            <p>腹筋：</p>
                                                @foreach ($absday as $absday_event)
                                                    <form action="sessions" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="event_name" value="{{ $absday_event }}">
                                                        {{ $absday_event }}
                                                        <ul>
                                                            <li>重量：
                                                            <select name="weight">
                                                            @for ($i = 0; $i < 201; $i = $i + 2)
                                                                @if ($i === 50) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}KG</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>回数：
                                                            <select name="rep">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 10) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}REP</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>セット数：
                                                            <select name="set">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 1) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}SET</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                        </ul>
                                                        <button type="submit" class="btn btn-primary">追加する</button>
                                                    </form>
                                                    </br>
                                                @endforeach
                                        @endif
                                        @if (isset($day))
                                            <p>その他：</p>
                                                @foreach ($day as $other_event)
                                                     <form action="sessions" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="event_name" value="{{ $other_event }}">
                                                        {{ $other_event }}
                                                        <ul>
                                                            <li>重量：
                                                            <select name="weight">
                                                            @for ($i = 0; $i < 201; $i = $i + 2)
                                                                @if ($i === 50) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}KG</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>回数：
                                                            <select name="rep">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 10) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}REP</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                            <li>セット数：
                                                            <select name="set">
                                                            @for ($i = 0; $i < 30; $i++)
                                                                @if ($i === 1) {
                                                                    <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                                    @continue;
                                                                @endif
                                                            <option value="{{ $i }}">{{ $i }}SET</option>
                                                            @endfor
                                                            </select>
                                                            </li>
                                                        </ul>
                                                        <button type="submit" class="btn btn-primary">追加する</button>
                                                    </form>
                                                </br>
                                                @endforeach
                                        @endif
                                    @else
                                        <p>実施するトレーニングを入力してください。</p>
                                        <a href="events"class="btn btn-danger" href="#" role="button">種目選択に戻る</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if (Session::has('play_datas'))
                                    @foreach (Session::get('play_datas') as $play_data)
                                        <?php $datas[] = (string)$play_data['event_name'] . '→' .  (string)$play_data['weight'] . 'kg ' . (string)$play_data['rep'] . 'rep ' . (string)$play_data['set'] . 'set' ?>
                                    @endforeach
                                    <form method="POST" action="{{ route('tweets.store') }}">
                                        @csrf
                                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="10" cols="40">{{ old('text') }} @foreach ($datas as $data) 
    {{ nl2br($data) }} @endforeach
                                        </textarea>
                                        @error('text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <button type="submit" class="btn btn-success">トレログする</button>
                                        <!-- <p><a href="sessions/delete">破棄する</a></p> -->
                                        <a href="sessions/delete"class="btn btn-danger" href="#" role="button">追加内容を破棄する</a>
                                        <!-- <button type="submit" class="btn btn-danger"><a href="sessions/delete"class="btn btn-primary" href="#" role="button">追加内容を破棄する</a></button> -->
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
