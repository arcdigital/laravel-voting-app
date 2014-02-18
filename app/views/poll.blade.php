@extends('layout')

@section('content')
<h2>{{$poll->name}}</h2>
<h4>{{$poll->description}}</h4>
@if ($poll->is_votable && !$poll->voted_for)
    <h5>Voting Options (Click choice to cast vote)</h5>
    <div class="list-group">
        @foreach ($poll->choices as $choice)
            <a href="/polls/{{$poll->id}}/vote/{{$choice->id}}" class="list-group-item">{{$choice->description}}<span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
        @endforeach
    </div>
@elseif ($poll->voted_for)
    <h5>Voting Results</h5>
    <div class="list-group">
        @foreach ($poll->choices as $choice)
            @if ($choice->id == $poll->voted_for->choice_id)
                <a class="list-group-item">{{$choice->description}} <span class="label label-default">Your Vote</span><span class="glyphicon glyphicon-ok-circle pull-right"></span></a>
            @else
                <a class="list-group-item">{{$choice->description}}</a>
            @endif
        @endforeach
    </div>
@else
    Voting has closed.
@endif
@endsection