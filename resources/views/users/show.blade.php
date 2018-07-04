@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3>
                </div>
                <div class="panel-body">
                <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
            @include('user_friend.friend_button', ['user' => $user])
        </aside>
        <div class="col-xs-8">
            @if (Auth::id() != $user->id)
                <!--<ul class="nav nav-tabs nav-justified">-->
                <!--    <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">メモ一覧 <span class="badge">{{ $count_memos }}</span></a></li>-->
                <!--    <li><a href="#">ヨッ友一覧</a></li>-->
                <!--    <li><a href="#">ズッ友一覧</a></li>-->
                <!--</ul>-->
                メモ欄
                  {!! Form::open(['route' => 'memos.store']) !!}
                      <div class="form-group">
                          {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                          {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                      </div>
                  {!! Form::close() !!}
            @endif
            @if (count($memos) > 0)
                <ul class="nav nav-tabs nav-justified">
                    <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">メモ一覧 <span class="badge">{{ $count_memos }}</span></a></li>
                    <li role="presentation" class="{{ Request::is('users/*/friends') ? 'active' : '' }}"><a href="{{ route('users.friends', ['id' => $user->id]) }}">ヨッ友一覧 <span class="badge">{{ $count_friends }}</span></a></li>
                    <li><a href="#">ズッ友一覧</a></li>
                </ul>
                @include('memos.memos', ['memos' => $memos])
            @endif
        </div>
    </div>
@endsection