<?php

namespace App\Libraries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Request;

class OAuth2PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        $hash = Request::input('hash');

        $credentials = [
            'username' => $username,
            'password' => $password,
        ];

        if (presence($hash) && $hash === 'md5') {
            // prehashed, we want to skip the md5 step of OsuHasher
            $user = User::where('username', $username)->first();
            if (password_verify($password, $user->getAuthPassword())) {
                return $user->user_id;
            }
        } else {
            if (Auth::once($credentials)) {
                return Auth::user()->user_id;
            }
        }

        return false;
    }
}
