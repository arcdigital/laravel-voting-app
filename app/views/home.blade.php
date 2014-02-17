@extends('layout')

@section('content')
    @if (Auth::check())
    <h2>Polls</h2>
    @if (count($polls) > 0)
    @foreach (Poll::where('starts_at', '<=', Carbon::now())->where('ends_at', '>=', Carbon::now())->get() as $poll)
    <div class="row well">
        <div class="col-md-12">
            <h2>{{$poll->name}}</h2>
            <p>{{$poll->description}}</p>
            <p><a class="btn btn-default" href="/polls/{{$poll->id}}" role="button">Vote &raquo;</a></p>
        </div>
    </div>
    @endforeach
    @else
    <div class="row well">
        <div class="col-md-12">
            <p>There are no polls open for voting at this time. Please check back later.</p>
        </div>
    </div>
    @endif
    @else
    <div class="jumbotron">
        <h1>Welcome!</h1>
        <p class="lead">You must be a member of the CWDG organization on GitHub to use this application. If you aren't, please contact <a href="http://github.com/tarebyte">Mark</a>.</p>
        <p><a href="/login" class="btn btn-block btn-lg btn-social btn-github"><i class="fa fa-github"></i> Login with GitHub</a></p>
    </div>
    @endif
@endsection