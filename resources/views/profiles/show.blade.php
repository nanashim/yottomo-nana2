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
            <div class="pull-right">
                @include('user_friend.friend_button', ['user' => $user])
            </div>
        </aside>
        <div class="col-xs-10">
            @if (Auth::id() == $user->id)
                <ul class="nav nav-tabs nav-justified">
                    <!--<li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">メモ一覧 <span class="badge">{{ $count_memos }}</span></a></li>-->
                    <li role="presentation" class="{{ Request::is('users/*/friends') ? 'active' : '' }}"><a href="{{ route('users.friends', ['id' => $user->id]) }}">ヨッ友一覧 <span class="badge">{{ $count_friends }}</span></a></li>
                    <li><a href="#">Future一覧</a></li>
                    <li><a href="#">ズッ友一覧</a></li>
                </ul>
                <!--メモ欄-->
                <!--  {!! Form::open(['route' => 'memos.store']) !!}-->
                <!--      <div class="form-group">-->
                <!--          {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}-->
                <!--          {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}-->
                <!--      </div>-->
                <!--  {!! Form::close() !!}-->
            @endif
            <!--@if (count($memos) > 0)-->
                <!--<ul class="nav nav-tabs nav-justified">-->
                <!--    <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">メモ一覧 <span class="badge">{{ $count_memos }}</span></a></li>-->
                <!--    <li role="presentation" class="{{ Request::is('users/*/friends') ? 'active' : '' }}"><a href="{{ route('users.friends', ['id' => $user->id]) }}">ヨッ友一覧 <span class="badge">{{ $count_friends }}</span></a></li>-->
                <!--    <li><a href="#">ズッ友一覧</a></li>-->
                <!--</ul>-->
            <!--    @include('memos.memos', ['memos' => $memos])-->
            <!--@endif-->
             <!--
             ここにプロフィールを表示できるようにする
             [編集]ボタンがあって、それを押すと、edit.blade.phpにとぶ
             edit.blade.phpで[更新]を押すと、更新されてこのページにかえってくる
             -->
            <div class="col-xs-10 col-xs-offset-1">
                <br>
                <div class="center jumbotron">
                    <span style="font : normal 900 10pt 'Meiryo'">
                        私は[________]生まれで、出身地は[____{{ $profile->birthplace }}____]だよ。<br>
                        性格は[________]と思っているんだけど、まわりからは[________]って言われるよ。<br>
                        そんな私の趣味は、[________]で、チャームポイントは[________]なんだ。<br>
                        将来の夢は[________]で、好きなアプリは[________]だよ。<br>
                        最後に一言、[________]。よろしくね！<br>
                    </span>
                </div>
                <div class="pull-right">
                    @if (Auth::id() == $user->id)
                        {!! link_to_route('users.edit', ' 編集する', ['id' => $user->id], ['class' => 'btn btn-primary glyphicon glyphicon-pencil']) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection