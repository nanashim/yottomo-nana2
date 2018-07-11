@if (Auth::id() != $user->id)
    @if (Auth::user()->is_zuttomoing($user->id))
        {!! Form::open(['route' => ['user.unzuttomo', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('絶縁する', ['class' => "btn btn-danger btn-xs"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.zuttomo', $user->id]]) !!}
            {!! Form::submit('ズッ友', ['class' => "btn btn-primary btn-xs"]) !!}
        {!! Form::close() !!}
    @endif
@endif