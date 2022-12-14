<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\vACC;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class VatsimConnectController
{
    public function callback()
    {
        /** @var \SocialiteProviders\Manager\OAuth2\User $vatsimUser */
        $vatsimUser = Socialite::driver('vatsimconnect')->user();

        $user = User::firstWhere('id', $vatsimUser->id);
        if (!$user) {
            if ($vatsimUser->getId() == 10000010) {
                $user = new User([
                    'id' => $vatsimUser->getId(),
                    'role_id' => Role::firstWhere('key', 'SYS')->id,
                ]);
            } else {
                $user = new User([
                    'id' => $vatsimUser->getId(),
                    'role_id' => Role::firstWhere('key', 'USER')->id,
                ]);
            }
        }

        $user->name = $vatsimUser->name;
        $user->token = $vatsimUser->token;
        $user->refresh_token = $vatsimUser->refreshToken;
        $user->refresh_token_expires_at = now()->addSeconds($vatsimUser->expiresIn);
        if ($vatsimUser->vacc_code) {
            $user->vacc_id = vACC::firstWhere('code', $vatsimUser->vacc_code)->id;
        }
        Log::debug($user->vacc_id);
        $user->save();

        Auth::login($user);

        return to_route('filament.pages.dashboard');
    }
}
