<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\UserSocialAccount;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
    {
        if(!request()->has('code') || request()->has('denied'))
        {
            return redirect()->route('login')->with('message', ['danger', __('Cancel login')]);
        }

        $socialUser = Socialite::driver($driver)->user();
        $user = null;
        $success = true;
        $email = $socialUser->email;
        $check = User::whereEmail($email)->first();

        if($check)
        {
            $user = $check;
        }
        else
        {
            DB::beginTransaction();
            try
            {
                $user = User::create([
                    'name' => $socialUser->name,
                    'email' => $email
                ]);

                UserSocialAccount::create([
                    'user_id' => $user->id,
                    'provider' => $driver,
                    'provider_uid' => $socialUser->id
                ]);

                Student::create([
                    'user_id' => $user->id
                ]);
            }
            catch(\Exception $ex)
            {
                DB::rollback();
                $success = $ex->getMessage();
            }
        }

        if($success === true)
        {
            DB::commit();
            Auth::loginUsingId($user->id);
            return redirect()->route('home');
        }

        return redirect()->route('login')->with('message', ['danger', $success]);
    }
}
