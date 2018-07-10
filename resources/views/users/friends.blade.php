@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3>
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->name, 500) }}" alt="">
                </div>
            </div>
            @include('user_friend.friend_button', ['user' => $user])
        </aside>
        <div class="col-xs-10">
            <ul class="nav nav-tabs nav-justified">
                <!--<li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">メモ一覧 <span class="badge">{{ $count_memos }}</span></a></li>-->
                <li role="presentation" class="{{ Request::is('users/*/friends') ? 'active' : '' }}"><a href="{{ route('users.friends', ['id' => $user->id]) }}">ヨッ友一覧 <span class="badge">{{ $count_friends }}</span></a></li>
                <li><a href="#">Future一覧</a></li>
                <li><a href="#">ズッ友一覧</a></li>
            </ul>
            @include('users.users', ['users' => $users])
        </div>
    </div>
@endsection