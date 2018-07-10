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
            @endif
             <!--
             ここにプロフィールを表示できるようにする
             [編集]ボタンがあって、それを押すと、edit.blade.phpにとぶ
             edit.blade.phpで[更新]を押すと、更新されてこのページにかえってくる
             -->
            <div class="col-xs-10 col-xs-offset-1">
                <br>
                <div class="center jumbotron">
                    <span style="font : normal 900 10pt 'Meiryo'">
                        <!-- link_to_route('profiles.show', $profile->name, ['id' => $profile->id]) !!}-->
                        {!! Form::model($user, ['route' => ['profiles.update', 'id' => $user->id], 'method' => 'put']) !!}
                        <div class="form-group">
                            私は{!! Form::date('birthday', \Carbon\Carbon::now()) !!}生まれで、出身地は{!! Form::text('birthplace') !!}だよ。<br>
                            性格は{!! Form::text('character1') !!}と思っているんだけど、
                            まわりからは{!! Form::text('character2') !!}って言われるよ。<br>
                            そんな私の趣味は、{!! Form::text('hobby') !!}で、
                            チャームポイントは{!! Form::text('charmpoint') !!}なんだ。<br>
                            将来の夢は{!! Form::text('dream') !!}で、
                            好きなアプリは{!! Form::text('app') !!}だよ。<br>
                            最後に一言、{!! Form::text('content') !!}。よろしくね！
                        </div>
                            <div class="pull-right">
                                @if (Auth::id() == $user->id)
                                    {!! Form::submit('更新する', ['class' => 'btn btn-primary']) !!}
                                @endif
                            </div>
                        {!! Form::close() !!}
                    </span>
                </div>
                <!--{!! Form::model($user, ['route' => 'profiles.store']) !!}-->
                <!--出身地は{!! Form::text('birthplace') !!}だよ。-->
                <!--    {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}-->
                <!--{!! Form::close() !!}-->
                
                <!--<div class="pull-right">-->
                <!--    @if (Auth::id() == $user->id)-->
                <!--        {!! link_to_route('users.show', ' 更新する', ['id' => $user->id], ['class' => 'btn btn-primary glyphicon glyphicon-pencil']) !!}-->
                <!--    @endif-->
                <!--</div>-->
            </div>
        </div>
    </div>
@endsection