<!-- routeファイルでreturn view('contact.index')でルーティングする -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('events.update', [$event->id]) }}">
                        @csrf
                        @method('put')

                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                                <div class="ml-4 d-flex flex-column">
                                    <label>部位
                                    <select name="part">
                                    <option value="胸">胸</option>
                                    <option value="背中">背中</option>
                                    <option value="肩">肩</option>
                                    <option value="脚">脚</option>
                                    <option value="上腕二頭筋">上腕二頭筋</option>
                                    <option value="上腕三頭筋">上腕三頭筋</option>
                                    <option value="腹筋">腹筋</option>
                                    </select>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p><label>種目名：<input type="text" name="event_name" size="40" maxlength="20"></label></p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p class="mb-4 text-danger">30文字以内</p>
                                <button type="submit" class="btn btn-primary">
                                    更新する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
