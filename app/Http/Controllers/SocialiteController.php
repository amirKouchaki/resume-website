<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider) {
        return response()->json(['redirectUrl' => Socialite::driver($provider)->redirect()->getTargetUrl()]);
    }
    public function handleCallback($provider) {
        $oauthUser = Socialite::driver($provider)->user();
        try {


            $user = User::query()->updateOrCreate(['email' => $oauthUser->getEmail()],[
                'name' => $oauthUser->getName(),
                $provider.'_id' => $oauthUser->getId(),
            ]);

            Auth::login($user);

            return response()->json(['message' => 'Login successful']);

        }
        catch (\Throwable $e) {
            dd('something went wrong!!'. $e->getMessage());
        }
    }




}
