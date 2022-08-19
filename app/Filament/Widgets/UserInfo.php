<?php

namespace App\Filament\Widgets;

use Auth;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Laravel\Socialite\Facades\Socialite;

class UserInfo extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    // protected static string $view = 'filament.widgets.user-info';

    protected function getCards(): array
    {
        $user = Auth::user();
        $vatsimUser = Socialite::driver('vatsimconnect')->userFromToken($user->token);

        return [
            Card::make('Rating', "{$vatsimUser->rating_short} | {$vatsimUser->rating_long}"),
            Card::make('Division/vACC', "{$vatsimUser->division}" . ($user->vacc ? "/{$user->vacc->name} ({$user->vacc->code})" : "/None")),
        ];
    }
}
