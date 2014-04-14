@extends('layout')

@section('content')
<h2>{{$poll->name}}</h2>
<h4>{{$poll->description}}</h4>
    <h5>Voting Options</h5>
    <div class="list-group">
        @foreach ($poll->choices as $choice)
            <a href="#" class="list-group-item">{{$choice->description}} <span class="label label-default">{{$choice->total_votes}}</span><span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
        @endforeach
    </div>
@endsection