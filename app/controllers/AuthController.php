<?php

class AuthController extends BaseController {

    public function getLogin()
    {
        Session::put('auth_state', str_random());
        return Redirect::to('https://github.com/login/oauth/authorize?client_id='.Config::get('github.client_id').'&scope='.Config::get('github.scope').'&state='.Session::get('auth_state'));
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    public function getGithub()
    {
        if (Input::has('code') && Input::has('state'))
        {
            $input = Input::only('code', 'state');
            if ($input['state'] == Session::get('auth_state'))
            {
                $response = Httpful::post('https://github.com/login/oauth/access_token')->body(array(
                    'client_id' => Config::get('github.client_id'),
                    'client_secret' => Config::get('github.client_secret'),
                    'code' => $input['code'],
                ))->sendsForm()->send();
                $token = $response->body['access_token'];

                $githubProfile = Httpful::get("https://api.github.com/user?access_token={$token}")->send();
                $githubOrg = Httpful::get("https://api.github.com/orgs/cwdg/members/{$githubProfile->body->login}?access_token=".Config::get('github.org_token'))->send();
                if ($githubOrg->code == 204)
                {
                    //Check if admin
                    $githubOrgOwner = Httpful::get("https://api.github.com/teams/87121/members/{$githubProfile->body->login}?access_token=".Config::get('github.org_token'))->send();
                    $isAdmin = ($githubOrgOwner->code == 204 ? true : false);
                    if ($user = User::where('github_id', '=', $githubProfile->body->id)->first())
                    {
                        $user->github_username = $githubProfile->body->login;
                        $user->github_token = $token;
                        $user->is_admin = $isAdmin;
                        $user->save();
                    }
                    else
                    {
                        $user = User::create(array(
                            'name' => $githubProfile->body->name,
                            'email' => $githubProfile->body->email,
                            'password' => str_random(16),
                            'github_id' => $githubProfile->body->id,
                            'github_username' => $githubProfile->body->login,
                            'github_token' => $token,
                            'is_admin' => $isAdmin,
                        ));
                    }
                    Auth::login($user);
                    return Redirect::to('/');
                }
                return 'Not a member of org';
            }
            return 'invalid state';
        }
        return 'invalid request';
    }

}