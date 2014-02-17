<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    $polls = Poll::where('starts_at', '<=', Carbon::now())->where('ends_at', '>=', Carbon::now())->get();
	return View::make('home')->withPolls($polls);
});

Route::get('login', array('uses' => 'AuthController@getLogin'));
Route::get('logout', array('uses' => 'AuthController@getLogout'));

Route::controller('auth', 'AuthController');

Route::model('poll', 'Poll');
Route::model('choice', 'Choice');

route::get('polls/{poll}', array('before' => 'auth', function(Poll $poll)
{
    if ($poll->starts_at > Carbon::now())
        throw new NotFoundException;

    $poll->is_votable = ($poll->ends_at > Carbon::now() ? true : false);
    $poll->voted_for = Vote::where('poll_id', '=', $poll->id)->where('user_id', '=', Auth::user()->id)->first();
    //dd($poll->voted_for);
    return View::make('poll')->withPoll($poll);
}));

route::get('polls/{poll}/vote/{choice}', array('before' => 'auth', function(Poll $poll, Choice $choice)
{
    if ($poll->starts_at > Carbon::now())
        throw new NotFoundException;

    if ($poll->id == $choice->poll_id)
    {
        if ($poll->ends_at >= Carbon::now())
        {
            $existing = Vote::where('poll_id', '=', $poll->id)->where('user_id', '=', Auth::user()->id)->first();
            if (!$existing)
            {
                $vote = Vote::create([
                    'poll_id' => $poll->id,
                    'choice_id' => $choice->id,
                    'user_id' => Auth::user()->id,
                ]);
                Session::flash('alert', array('success', 'You successfully voted.'));
                return Redirect::to("/polls/{$poll->id}");
            }
            Session::flash('alert', array('warning', 'You have already voted.'));
            return Redirect::to("/polls/{$poll->id}");
        }
        Session::flash('alert', array('danger', 'Voting has closed for this poll.'));
        return Redirect::to("/polls/{$poll->id}");
    }
    Session::flash('alert', array('danger', 'Invalid vote.'));
    return Redirect::to("/polls/{$poll->id}");
}));

Route::get('/test', function()
{
    $poll = Poll::find(2);
    dd($poll->choices);
});