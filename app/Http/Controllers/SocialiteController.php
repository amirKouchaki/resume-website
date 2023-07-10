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

        try {
            $oauthUser = Socialite::driver($provider)->user();
            $user = User::query()->updateOrCreate(['email' => $oauthUser->getEmail()],[
                'name' => $oauthUser->getName(),
                $provider.'_id' => $oauthUser->getId(),
            ]);

            Auth::login($user);

            return response()->json(['message' => 'Login successful','success' => true]);

        }
        catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage(),'success' => false],400);
        }
    }




}
