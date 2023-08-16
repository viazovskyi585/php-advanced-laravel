<?php

namespace App\Http\Controllers\Callbacks;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Azate\LaravelTelegramLoginAuth\TelegramLoginAuth;

class TelegramController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TelegramLoginAuth $validator, Request $request)
    {
        $data = $validator->validate($request);

        if (!$data) {
            return redirect()->back();
        }

        Auth::user()->update([
            'telegram_id' => $data->getId(),
        ]);

        return redirect()->route('profile.edit');
    }
}
