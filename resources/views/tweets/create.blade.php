@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.store') }}">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                                <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $user->name }}</p>
                                    <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                                </div>
                                <div class="ml-4 d-flex flex-column">
                                    @if (isset($event_datas))
                                        @foreach ($event_datas as $event_data)
                                            @switch($event_data->part)
                                                @case('胸')
                                                    <?php $chestday[] =  $event_data->event_name; ?>
                                                    @break
                                                
                                                @case('背中')
                                                    <?php $backday[] =  $event_data->event_name; ?>
                                                    @break

                                                @case('肩')
                                                    <?php $shoulderday[] =  $event_data->event_name; ?>
                                                    @break

                                                @case('脚')
                                                    <?php $legday[] =  $event_data->event_name; ?>
                                                    @break

                                                @case('上腕二頭筋')
                                                    <?php $bicepsday[] =  $event_data->event_name; ?>
                                                    @break

                                                @case('上腕三等筋')
                                                    <?php $tricepsday[] =  $event_data->event_name; ?>
                                                    @break

                                                @case('腹筋')
                                                    <?php $absday[] =  $event_data->event_name; ?>
                                                    @break

                                                @default
                                                    <?php $day[] =  $event_data->event_name; ?>

                                            @endswitch
                                        @endforeach
                                        @if (isset($chestday))
                                             <p><label>胸：
                                            @foreach ($chestday as $chestday_event)
                                                <input type="text" name="event_name" size="40" maxlength="20">
                                                <?php echo $chestday_event; ?>
                                                <ul>
                                                    <li>重量：
                                                    <select name="weight">
                                                    @for ($i = 0; $i < 301; $i++)
                                                    <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                    @endfor
                                                    </select>
                                                    </li>
                                                    <li>回数：
                                                    <select name="rep">
                                                    @for ($i = 0; $i < 30; $i++)
                                                    <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                    @endfor
                                                    </select>
                                                    </li>
                                                    <li>セット数：
                                                    <select name="set">
                                                    @for ($i = 0; $i < 30; $i++)
                                                    <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                    @endfor
                                                    </select>
                                                    </li>
                                                </ul>
                                                </br>
                                            @endforeach
                                            </label></p>
                                        @endif
                                        @if (isset($backday))
                                            <p>背中：</p>
                                            @foreach ($backday as $backday_event)
                                                <?php echo $backday_event; ?>
                                                <ul>
                                                    <li>重量：
                                                    <select name="weight">
                                                    @for ($i = 0; $i < 301; $i++)
                                                    <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                    @endfor
                                                    </select>
                                                    </li>
                                                    <li>回数：
                                                    <select name="rep">
                                                    @for ($i = 0; $i < 30; $i++)
                                                    <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                    @endfor
                                                    </select>
                                                    </li>
                                                    <li>セット数：
                                                    <select name="set">
                                                    @for ($i = 0; $i < 30; $i++)
                                                    <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                    @endfor
                                                    </select>
                                                    </li>
                                                </ul>
                                                </br>
                                            @endforeach
                                        @endif
                                        @if (isset($shoulderday))
                                            <p>肩：</p>
                                            @foreach ($shoulderday as $shoulderday_event)
                                                <?php echo $shoulderday_event; ?>
                                                <ul>
                                                    <li>重量：
                                                    <select name="weight">
                                                    @for ($i = 0; $i < 301; $i++)
                                                    <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                    @endfor
                                                    </select>
                                                    </li>
                                                    <li>回数：
                                                    <select name="rep">
                                                    @for ($i = 0; $i < 30; $i++)
                                                    <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                    @endfor
                                                    </select>
                                                    </li>
                                                    <li>セット数：
                                                    <select name="set">
                                                    @for ($i = 0; $i < 30; $i++)
                                                    <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                    @endfor
                                                    </select>
                                                    </li>
                                                </ul>
    ¥                                                </br>
                                            @endforeach
                                        @endif
                                        @if (isset($legday))
                                            <p>脚：</p>
                                                @foreach ($legday as $legday_event)
                                                    <?php echo $legday_event; ?>
                                                    <ul>
                                                        <li>重量：
                                                        <select name="weight">
                                                        @for ($i = 0; $i < 301; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>回数：
                                                        <select name="rep">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>セット数：
                                                        <select name="set">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                    </ul>
                                                    </br>
                                                @endforeach
                                        @endif
                                        @if (isset($bicepsday))
                                            <p>上腕二頭筋：</p>
                                                @foreach ($bicepsday as $bicepsday_event)
                                                    <?php echo $bicepsday_event; ?>
                                                    <ul>
                                                        <li>重量：
                                                        <select name="weight">
                                                        @for ($i = 0; $i < 301; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>回数：
                                                        <select name="rep">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>セット数：
                                                        <select name="set">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                    </ul>
                                                    </br>
                                                @endforeach
                                        @endif
                                        @if (isset($tricepsday))
                                            <p>上腕三頭筋：</p>
                                                @foreach ($tricepsday as $tricepsday_event)
                                                    <?php echo $tricepsday_event; ?>
                                                    <ul>
                                                        <li>重量：
                                                        <select name="weight">
                                                        @for ($i = 0; $i < 301; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>回数：
                                                        <select name="rep">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>セット数：
                                                        <select name="set">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                    </ul>

                                                    </br>
                                                @endforeach
                                        @endif
                                        @if (isset($absday))
                                            <p>腹筋：</p>
                                                @foreach ($absday as $absday_event)
                                                    <?php echo $absday_event; ?>
                                                    <ul>
                                                        <li>重量：
                                                        <select name="weight">
                                                        @for ($i = 0; $i < 301; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>回数：
                                                        <select name="rep">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>セット数：
                                                        <select name="set">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                    </ul>
                                                    </br>
                                                @endforeach
                                        @endif
                                        @if (isset($day))
                                            <p>その他：</p>
                                                @foreach ($day as $other_event)
                                                    <?php echo $other_event; ?>
                                                    <ul>
                                                        <li>重量：
                                                        <select name="weight">
                                                        @for ($i = 0; $i < 301; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}KG</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>回数：
                                                        <select name="rep">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}REP</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                        <li>セット数：
                                                        <select name="set">
                                                        @for ($i = 0; $i < 30; $i++)
                                                        <option value="{{ $i }}" selected>{{ $i }}SET</option>
                                                        @endfor
                                                        </select>
                                                        </li>
                                                    </ul>
                                                    </br>
                                                @endforeach
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}
                                </textarea>

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
